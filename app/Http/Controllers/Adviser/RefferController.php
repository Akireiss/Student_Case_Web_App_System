<?php

namespace App\Http\Controllers\Adviser;

use App\Models\Students;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RefferController extends Controller
{
    public function index() {
        $user = auth()->user(); // Get the authenticated user
        $classroomId = $user->classroom_id;

        $userClassroom = Classroom::find($classroomId);
        $nextGradeLevel = $userClassroom->grade_level + 1;

        $classroom = Classroom::whereIn('grade_level', [$userClassroom->grade_level, $nextGradeLevel])
            ->get();

        $students = Students::where('classroom_id', $classroomId)
                            ->where('status', 0)
                            ->get(); // Use get() to retrieve the results

        return view('staff.students.reffer', compact('students', 'classroom', 'classroomId'));
    }


    public function update(Request $request) {
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
        return redirect()->back()->with('message', 'Students have been referred to new classrooms.');
    }


}



