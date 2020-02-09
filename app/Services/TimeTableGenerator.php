<?php

namespace App\Services;

use \App\Room;

use \Carbon\Carbon;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TimeTableGenerator
{
	private const FRESHMAN_BATCH = 2017;
	private const SOPHOMORE_BATCH = 2016;
	private const JUNIOR_BATCH = 2015;
	private const SENIOR_BATCH = 2014;

	// 3 classes per day
	private const MAX_CLASSES_PER_WEEK = 15;

	// If true, the median slot will be used
	private $hasHighCreditHours;

	private $reservations = [];

	private $classrooms;
	private $labs;

	private $sectionClasses;
	private $sectionLabs;

	private $batchId;
	private $classroomId;
	private $labId;
	private $dayNo = 1;
	private $startTime;

	// This array will store all the faculties' reserved times associated with days
	private $facultyReservedTimes = [];

	// This array will store the free slots as missed due to clashes
	private $missedSlots = [];

	// This array will store all the rooms' reserved times associated with days
	private $roomReservedTimes = [];

	// This array will store the reserved times of a section for the current day
	private $sectionReservedTimes = [];

	private $scheduleId;

	public function __construct(int $scheduleId)
	{
		$this->scheduleId = $scheduleId;
		
		$this->classrooms = Room::where('name', 'not like', '%'.'Lab'.'%')->get();
		$this->labs = Room::where('name', 'like', '%'.'Lab'.'%')->get();

		$this->sectionClasses = DB::table('sections')
			->join('allocations', 'sections.id', '=', 'allocations.section_id')
			->join('courses', 'allocations.course_code', '=', 'courses.code')
			->join('faculties', 'allocations.faculty_id', '=', 'faculties.id')
			->select('sections.id as section_id', 'sections.batch_id', 'faculties.id as faculty_id',
				'courses.code as course_code', 'courses.credit', 'allocations.id as allocation_id')
			->whereNotIn('faculties.id', function($query) {
				$query->select('faculty_id')
					->from('lab_assistants');
			})
			->orderBy('sections.id')
			->orderBy('faculties.id')
			->get();

		$this->sectionLabs = DB::table('sections')
			->join('allocations', 'sections.id', '=', 'allocations.section_id')
			->join('courses', 'allocations.course_code', '=', 'courses.code')
			->join('faculties', 'allocations.faculty_id', '=', 'faculties.id')
			->join('labs', 'courses.code', '=', 'labs.course_code')
			->join('lab_assistants', 'faculties.id', '=', 'lab_assistants.faculty_id')
			->select('sections.id as section_id', 'sections.batch_id', 'faculties.id as faculty_id',
				'courses.code as course_code', 'allocations.id as allocation_id')
			->orderBy('sections.id')
			->orderBy('faculties.id')
			->get();

		$this->batchId = $this->sectionClasses->first()->batch_id;
		$this->classroomId = $this->classrooms->pluck('id')->first();
		$this->labId = $this->labs->pluck('id')->first();
		$this->startTime = Carbon::createFromTime(TimeTable::$jsStartHour);

		// TODO remove this call
		TimeTable::setTimeSlots();
	}

	public function generate()
	{
		$curSection = $this->sectionClasses->first()->section_id;
		while(true) {
			// Loop through chunk of records, section by section
			$facultiesAndCourses = $this->sectionClasses->where('section_id', $curSection);
			if($facultiesAndCourses->isEmpty())
				break;

			$this->batchId = $facultiesAndCourses->first()->batch_id;

			// Start checking classrooms from the start after we get to the sophomore batch
			// because now we will allocate classes in the morning slots
			if($this->batchId == TimeTableGenerator::SOPHOMORE_BATCH) {
				$this->classroomId = $this->classrooms->pluck('id')->first();
				$this->labId = $this->labs->pluck('id')->first();
			}

			$totalCredits = $facultiesAndCourses->sum('credit');
			if($totalCredits > TimeTableGenerator::MAX_CLASSES_PER_WEEK)
				$this->hasHighCreditHours = true;
			else
				$this->hasHighCreditHours = false;

			$this->setDayNo(Carbon::MONDAY);
			$this->allocateSectionClasses($facultiesAndCourses, $totalCredits);

			$assistantsAndLabs = $this->sectionLabs->where('section_id', $curSection);
			if(!$assistantsAndLabs->isEmpty()) {
				$this->setDayNo(Carbon::MONDAY, true);
				$this->allocateSectionLabs($assistantsAndLabs);
			}

			$curSection++;
		}

		// TODO remove this
		//DB::table('reservations')->delete();

		DB::table('reservations')->insert($this->reservations);
	}

	private function allocateSectionClasses(Collection $facultiesAndCourses, int $totalCredits)
	{
		// TODO fix the floor bug
		// Using floor() glitches
		// More classes end up on Friday, and there are only four slots there, so
		// we fall in an infinite loop trying to fix clashes
		$classesPerDay = (int)ceil($totalCredits / TimeTable::$weekdays);
		$classesAllocated = 0;
		while($totalCredits > 0) {
			// Friday will always get all the remaining classes of the week
			if($classesAllocated >= $classesPerDay && $this->dayNo != Carbon::FRIDAY) {
				$this->setDayNo($this->dayNo + 1);
				$classesAllocated = 0;
			}

			$faculty = $this->getNextFaculty($facultiesAndCourses);

			$this->setNextFreeSlot();
			$this->fixClashes($faculty->faculty_id);
			$this->makeReservation($faculty, $this->classroomId);

			$classesAllocated++;
			$totalCredits--;
		}
	}

	private function allocateSectionLabs(Collection $assistantsAndLabs)
	{
		$assistantAndLab = $assistantsAndLabs->shift();
		while($assistantAndLab) {
			$slotsFree = true;

			while(!$this->isLabFree())
				// TODO throw exception when out of labs
				$this->labId++;

			// Check if three consecutive slots are free
			for($i = 0; $i < 3; $i++) {
				if(!$this->isSectionFree() || !$this->isFacultyFree($assistantAndLab->faculty_id)) {
					$slotsFree = false;
					break;
				}
				$this->incrementStartTime();
			}

			if($slotsFree) {
				$this->resetStartTime(true);
				for($i = 0; $i < 3; $i++) {
					$this->makeReservation($assistantAndLab, $this->labId);
					$this->incrementStartTime();
				}
				$assistantAndLab = $assistantsAndLabs->shift();
			}
			$this->setDayNo($this->dayNo + 1, true);
		}
	}

	private function fixClashes(int $facultyId)
	{
		while(!$this->isSectionFree() || !$this->isFacultyFree($facultyId)
			|| !$this->isRoomFree($this->classroomId))
		{
			$this->missedSlots[$this->classroomId][$this->dayNo][] = $this->startTime->toTimeString();
			$this->incrementSlotParams();
		}
	}

	private function getNextFaculty(Collection $facultiesAndCourses)
	{
		static $index = 0;
		// This variable contains a copy of $facultiesAndCourses with fixed indexes
		$fixedIndexFNC = $facultiesAndCourses->values();
		// If this particular course has been completely allocated
		if($fixedIndexFNC[$index]->credit == 0) {
			$facultiesAndCourses->forget($index);
			$fixedIndexFNC = $facultiesAndCourses->values();

			if($facultiesAndCourses->isEmpty()) {
				// TODO throw an exception
				return;
			}
		}
		$index++;
		$facultiesCount = $facultiesAndCourses->pluck('facultyId')->count();
		if($index >= $facultiesCount)
			$index = 0;

		$faculty = $fixedIndexFNC[$index];
		$faculty->credit--;
		return $faculty;
	}

	private function incrementStartTime()
	{
		$this->startTime->addMinutes(TimeTable::$classMinutes + TimeTable::$intervalMinutes);
		if($this->startTime->hour == TimeTable::$breakHour)
			$this->startTime->addMinutes(TimeTable::$breakMinutes);
	}

	private function incrementSlotParams()
	{
		$this->incrementStartTime();
		$endTime = 0;
		if($this->batchId == TimeTableGenerator::FRESHMAN_BATCH ||
			$this->batchId == TimeTableGenerator::SOPHOMORE_BATCH)
		{
			$endTime = Carbon::createFromTime(TimeTable::$fsEndHour);
			if($this->hasHighCreditHours)
				$endTime->addMinutes(TimeTable::$classMinutes + TimeTable::$intervalMinutes);
		}
		else
		{
			$endTime = Carbon::createFromTime(TimeTable::$jsEndHour);
		}

		if($this->startTime->hour >= $endTime->hour) {
			// TODO throw exception when out of rooms
			$this->classroomId++;
			$this->resetStartTime();
		}
	}

	private function isFacultyFree(int $facultyId)
	{
		if(empty($this->facultyReservedTimes) ||
			!isset($this->facultyReservedTimes[$facultyId]) ||
			!isset($this->facultyReservedTimes[$facultyId][$this->dayNo]))
		{
			return true;
		}

		if(in_array($this->startTime->toTimeString(), 
			$this->facultyReservedTimes[$facultyId][$this->dayNo]))
		{
			return false;
		}
		else {
			return true;
		}
	}

	private function isLabFree()
	{
		for($i = 0; $i < 3; $i++) {
			if(!$this->isRoomFree($this->labId))
				return false;

			$this->incrementStartTime();
		}

		$this->resetStartTime(true);
		return true;
	}

	private function isRoomFree(int $roomId)
	{
		if(empty($this->roomReservedTimes) ||
			!isset($this->roomReservedTimes[$roomId]) ||
			!isset($this->roomReservedTimes[$roomId][$this->dayNo]))
		{
			return true;
		}

		if(in_array($this->startTime->toTimeString(),
			$this->roomReservedTimes[$roomId][$this->dayNo]))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	private function isSectionFree()
	{
		if(empty($this->sectionReservedTimes))
			return true;

		if(in_array($this->startTime->toTimeString(), 
			$this->sectionReservedTimes))
		{
			return false;
		}
		else {
			return true;
		}
	}

	private function makeReservation(\stdClass $faculty, int $roomId)
	{
		$endTime = $this->startTime->copy();
		$endTime->addMinutes(TimeTable::$classMinutes);

		$startTimeString = $this->startTime->toTimeString();
		$this->reservations[] = [
			'day_no' => $this->dayNo,
			'start_time' => $startTimeString,
			'end_time' => $endTime->toTimeString(),
			'room_id' => $roomId,
			'allocation_id' => $faculty->allocation_id,
			'schedule_id' => $this->scheduleId
		];

		$this->facultyReservedTimes[$faculty->faculty_id][$this->dayNo][] = $startTimeString;
		$this->roomReservedTimes[$roomId][$this->dayNo][] = $startTimeString;
		$this->sectionReservedTimes[] = $startTimeString;
	}

	// isLabs = true if we are allocating labs
	private function resetStartTime(bool $isLabs = false)
	{
		if($this->batchId == TimeTableGenerator::FRESHMAN_BATCH ||
			$this->batchId == TimeTableGenerator::SOPHOMORE_BATCH)
		{
			if($isLabs)
				$this->startTime->hour = TimeTable::$jsStartHour;
			else
				$this->startTime->hour = TimeTable::$fsStartHour;
		}
		else
		{
			if($isLabs) {
				$this->startTime->hour = TimeTable::$fsStartHour;
			}
			else {
				$this->startTime->hour = TimeTable::$jsStartHour;
				if($this->hasHighCreditHours)
					$this->startTime->hour = TimeTable::$fsEndHour;
			}
		}

		$this->startTime->minute = 0;
	}

	private function setDayNo(int $dayNo, bool $isLabs = false)
	{
		//if($dayNo > Carbon::FRIDAY)
			// TODO throw an exception

		$this->dayNo = $dayNo;
		$this->resetStartTime($isLabs);
		// Empty the last day's array
		$this->sectionReservedTimes = [];
	}

	private function setNextFreeSlot()
	{
		while(!$this->isRoomFree($this->classroomId))
			$this->incrementSlotParams();
	}
}
