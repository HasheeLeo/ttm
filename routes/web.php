<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('api/courses', 'CourseController@index');

Route::get('api/faculty', 'FacultyController@index');
Route::get('api/faculty/{id}', 'FacultyController@show');
Route::post('api/faculty', 'FacultyController@store');

Route::get('api/rooms', 'RoomController@index');

Route::get('api/schedules', 'ScheduleController@index');
Route::post('api/schedules', 'ScheduleController@store');

Route::get('api/sections', 'SectionController@index');

Route::get('api/timetables', 'TimeTableController@getCoursesAndSchedule');
Route::get('api/timetables/courses', 'TimeTableController@getCourses');
Route::get('api/timetables/schedule', 'TimeTableController@getSchedule');

Route::view('{any}', 'app')->where('any', '.*');
