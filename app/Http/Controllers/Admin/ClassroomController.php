<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Students;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassroomController extends Controller
{
    public function edit(Classroom $classroom)
    {
        $employees = Employee::all();
        $classrooms = Classroom::all();

        $maxGradeLevel = $classroom->grade_level; // Assuming you have the current classroom's grade level
        $higherClass = Classroom::where('grade_level', $maxGradeLevel + 1)
            ->orWhere('grade_level', $maxGradeLevel)
            ->get();


        return view('admin.classroom.edit', compact('classroom', 'employees', 'classrooms', 'higherClass'));

    }

    public function update(Request $request, Classroom $classroom)
    {
        $data = $request->validate([
            'classroom' => 'required',
            // Add any other validation rules for other fields
            'employee_id' => 'required',
            'status' => 'required',
        ]);

        $classroom->update($data);

        return redirect()->back()
            ->with('success', 'Classroom updated successfully');
    }


    public function updateStudents(Request $request, Classroom $classroom)
{
    $request->validate([
        'students' => 'required|array',
    ]);

    $studentsData = $request->input('students');

    foreach ($studentsData as $studentId => $data) {
        $student = Students::find($studentId);

        if ($student) {
            $student->classroom_id = $data['classroom_id'];
            $student->save();
        }
    }

    return response()->json(['message' => 'Students have been referred to the new classroom']);
}



}
