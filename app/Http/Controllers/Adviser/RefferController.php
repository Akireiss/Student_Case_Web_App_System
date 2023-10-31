<?php

namespace App\Http\Controllers\Adviser;

use App\Models\Students;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RefferController extends Controller
{
    public function index(Classroom $classroom) {
        $classrooms = Classroom::all();

        $maxGradeLevel = $classroom->grade_level; // Assuming you have the current classroom's grade level
        $higherClass = Classroom::where('grade_level', $maxGradeLevel + 1)
            ->orWhere('grade_level', $maxGradeLevel)
            ->get();

        return view('staff.students.reffer', compact('classroom', 'classrooms', 'higherClass'));
    }


    public function update(Request $request, Classroom $classroom)
{
    // Validate the request data as needed
    $request->validate([
        'students' => 'required|array',
    ]);

    // Get the array of students' data from the form
    $studentsData = $request->input('students');
    $successMessages = [];

    // Loop through the array of students' data
    foreach ($studentsData as $studentId => $data) {
        // Find the student by their ID
        $student = Students::find($studentId);

        if ($student) {
            // Update the student's classroom ID
            $student->classroom_id = $data['classroom_id'];
            $student->save();

            // Append success message for each student
            $successMessages[] = 'Student ' . $student->first_name . ' has been referred to the new classroom.';
        }
    }

    // Redirect back with success messages
    return redirect()->back()->with('success', $successMessages);
}


}



