<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::with(['employee'])->get();
        return view('admin.settings.classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::pluck('employees', 'id');
        return view('admin.settings.classrooms.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $classroom = Classroom::create([
            'grade_level' => $request->input('grade_level'),
            'section' => $request->input('section'),
            'employee_id' => $request->input('employee_id'),
        ]);

        return redirect('admin/settings/classrooms')->with('success', 'Classroom added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);
        $employees = Employee::pluck('employees', 'id');
      return view('admin.settings.classrooms.view', compact('classroom', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);
        $employees = Employee::pluck('employees', 'id');

        return view('admin.settings.classrooms.edit', compact('classroom', 'employees'));
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


}
