<?php

namespace App\Http\Controllers;

use App\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Faculty::orderBy('name')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|string|max:71'
        ]);

        $faculty = new Faculty;
        $faculty->name = $request->name;
        $faculty->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // TODO ensure id type is int
        $facultyData = DB::table('faculties')
            ->join('allocations', 'faculties.id', 'allocations.faculty_id')
            ->join('courses', 'courses.code', 'allocations.course_code')
            ->leftJoin('labs', 'labs.course_code', 'courses.code')
            ->join('sections', 'sections.id', 'allocations.section_id')
            ->select('faculties.name', 'courses.code', 'courses.name AS course_name',
                'courses.credit', 'labs.course_code AS lab', 'sections.department',
                'sections.batch_name', 'sections.name AS section_name')
            ->where('faculties.id', $id)
            ->get();

        return $facultyData;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
