<?php

namespace App\Http\Controllers;

use App\Services\TimeTable;
use Illuminate\Http\Request;

class TimeTableController extends Controller
{
    public function getCoursesAndSchedule(Request $request)
    {
        return TimeTable::getTimeTableAndCourses($request->dept, $request->batch,
            $request->section, $request->dayNo);
    }

    public function getCourses(Request $request)
    {
        return TimeTable::getCoursesWithFaculties($request->dept, $request->batch, $request->section);
    }

    public function getSchedule(Request $request)
    {
        return TimeTable::getTimeTable($request->dept, $request->batch, $request->section,
            $request->dayNo);
    }
}
