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
        return view('admin.settings.classrooms.index');
    }

    public function create()
    {
        $employees = Employee::pluck('employees', 'id');
        return view('admin.settings.classrooms.create', compact('employees'));
    }


    public function store(Request $request)
    {
        $classroom = Classroom::create([
            'grade_level' => $request->input('grade_level'),
            'section' => $request->input('section'),
            'employee_id' => $request->input('employee_id'),
        ]);

        return redirect()->back()->with('success', 'Successfully Added');
    }

    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);
        $employees = Employee::pluck('employees', 'id');
      return view('admin.settings.classrooms.view', compact('classroom', 'employees'));
    }

    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);
        $employees = Employee::pluck('employees', 'id');

        return view('admin.settings.classrooms.edit', compact('classroom', 'employees'));
    }


    public function update(Request $request, Classroom $classroom)
    {
        $validatedData = $request->validate([
            'grade_level' => 'required',
            'section' => 'required',
            'employee_id' => 'required',
            'status' => 'required',
        ]);

        $classroom->update($validatedData);

        return redirect('admin/settings/classrooms')->with('message', 'Classroom updated successfully.');
    }


}
