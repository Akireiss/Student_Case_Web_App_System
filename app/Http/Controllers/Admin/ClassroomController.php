<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Classroom;
use App\Models\GradeLevel;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $classrooms = Classroom::with(['employee', 'section', 'gradeLevel'])->get();
        return view('admin.settings.classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::pluck('employees', 'id');
        $grade_levels = GradeLevel::pluck('grade_level', 'id');
        $sections = Section::pluck('name', 'id');
        return view('admin.settings.classrooms.create', compact('employees', 'grade_levels', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'grade_level_id' => 'required',
            'section_id' => 'required',
            'employee_id' => 'required',
            'status' => 'required',
        ]);

        Classroom::create($validatedData);

        return redirect('admin/settings/classrooms')->with('message', 'Classroom created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);
        $employees = Employee::pluck('employees', 'id');
        $grade_levels = GradeLevel::pluck('grade_level', 'id');
        $sections = Section::pluck('name', 'id');

        return view('admin.settings.classrooms.edit', compact('classroom', 'employees', 'grade_levels', 'sections'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $validatedData = $request->validate([
            'grade_level_id' => 'required',
            'section_id' => 'required',
            'employee_id' => 'required',
            'status' => 'required',
        ]);

        $classroom->update($validatedData);

        return redirect('admin/settings/classrooms')->with('message', 'Classroom updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
