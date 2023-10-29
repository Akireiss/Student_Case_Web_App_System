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
        // Validate the request data as needed
        $request->validate([
            'students' => 'required|array',
        ]);

        // Get the array of students' data from the form
        $studentsData = $request->input('students');

        // Loop through the array of students' data
        foreach ($studentsData as $studentId => $data) {
            // Find the student by their ID
            $student = Students::find($studentId);

            if ($student) {
                // Update the student's classroom ID
                $student->classroom_id = $data['classroom_id'];
                $student->save();
            }
        }

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Students have been referred to new classroom');
    }

}
