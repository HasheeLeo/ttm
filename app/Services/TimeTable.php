<?php

namespace App\Services;

use \Carbon\Carbon;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TimeTable
{
	public static $breakMinutes    = 60;
	public static $classMinutes    = 50;
	public static $intervalMinutes = 10;

	public static $weekdays = 5;

	public static $breakHour = 13;
	// Freshmen and Sophomores
	public static $fsStartHour = 9;
	public static $fsEndHour   = 12;
	// Juniors and Seniors
	public static $jsStartHour = 14;
	public static $jsEndHour   = 17;

	public static $timeSlots = [];

	public static function getTimeTableAndCourses(string $dept, int $batch, string $section, int $dayNo)
	{
		$timeTable = TimeTable::getTimeTable($dept, $batch, $section, $dayNo);
        $courses = TimeTable::getCoursesWithFaculties($dept, $batch, $section);
        return compact('timeTable', 'courses');
	}

	public static function getCoursesWithFaculties(string $dept, int $batch, string $section)
	{
		$coursesWithFaculties = DB::table('courses')
			->join('allocations', 'allocations.course_code', '=', 'courses.code')
			->join('sections', 'allocations.section_id', '=', 'sections.id')
			->join('faculties', 'faculties.id', '=', 'allocations.faculty_id')
			->leftJoin('labs', 'labs.course_code', '=', 'courses.code')
			->select('courses.code as course_code', 'courses.name as course_name',
				'faculties.name as faculty_name', 'courses.credit', 'labs.course_code as lab')
			->where([
                ['sections.department', $dept],
                ['sections.batch_id', $batch],
                ['sections.name', $section]
            ])
            ->whereNotIn('faculties.id', function($query) {
				$query->select('faculty_id')
					->from('lab_assistants');
			})
			->orderBy('courses.name')
			->get();

		return $coursesWithFaculties;
	}

	public static function getTimeTable(string $dept, int $batch, string $section, int $dayNo)
	{
		if(empty($timeSlots))
			// TODO remove this call
			TimeTable::setTimeSlots();

		$schedule = DB::table('reservations')
			->join('selected_schedules', 'reservations.schedule_id', '=', 'selected_schedules.schedule_id')
            ->join('allocations', 'reservations.allocation_id', '=', 'allocations.id')
            ->join('courses', 'allocations.course_code', '=', 'courses.code')
            ->join('faculties', 'allocations.faculty_id', '=', 'faculties.id')
            ->join('sections', 'allocations.section_id', '=', 'sections.id')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->select('reservations.start_time', 'reservations.end_time', 'courses.name as course_name',
            	'faculties.name as faculty_name', 'rooms.name as room_name', 'rooms.location')
            ->where([
                ['sections.department', $dept],
                ['sections.batch_id', $batch],
                ['sections.name', $section],
                ['reservations.day_no', $dayNo]
            ])
            ->get();

        return TimeTable::buildTimeTable($schedule);
	}

	public static function setTimeSlots()
	{
		$timeBegin = Carbon::createFromTime(TimeTable::$fsStartHour);
		while($timeBegin->hour < TimeTable::$jsEndHour) {
			TimeTable::$timeSlots[] = $timeBegin->toTimeString();
			$timeBegin->addMinutes(TimeTable::$classMinutes + TimeTable::$intervalMinutes);
		}
	}

	// This function adds the missing slots to the $schedule and marks them as Library Period or Break
	private static function buildTimeTable(Collection $schedule)
	{
		$requiredTimes = [];
		foreach($schedule as $entry) {
			$requiredTimes[] = $entry->start_time;
			// remove the seconds portion (looks ugly on frontend)
			$entry->start_time = Carbon::createFromTimeString($entry->start_time)->format('H:i');
			$entry->end_time = Carbon::createFromTimeString($entry->end_time)->format('H:i');
		}

		$requiredTimes = array_diff(TimeTable::$timeSlots, $requiredTimes);
		$requiredTimes = array_values($requiredTimes);

		foreach($requiredTimes as $time) {
			if($time == TimeTable::$breakHour) {
				$courseName = 'Break';
				$endTime = Carbon::createFromTimeString($time)->addHour();
			}
			else {
				$courseName = 'Free Slot';
				$endTime = Carbon::createFromTimeString($time)->addMinutes(TimeTable::$classMinutes);
			}
			$time = Carbon::createFromTimeString($time);
			$schedule->push((object)[
				'start_time' => $time->format('H:i'),
				'end_time' => $endTime->format('H:i'),
				'course_name' => $courseName,
				'faculty_name' => null,
				'room_name' => null,
				'location' => null
			]);
		}
		$schedule = $schedule->sortBy('start_time');
		return $schedule->values();
	}
}
