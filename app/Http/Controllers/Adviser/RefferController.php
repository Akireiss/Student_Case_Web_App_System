<?php

namespace App\Http\Controllers\Adviser;

use App\Models\User;
use App\Models\Students;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\RefferNotification;
use Illuminate\Support\Facades\Notification;

class RefferController extends Controller
{


    public function index(Classroom $classroom) {
        $classrooms = Classroom::all()->where('status', 0)->get();

        $maxGradeLevel = $classroom->grade_level; // Assuming you have the current classroom's grade level
        $higherClass = Classroom::where('grade_level', $maxGradeLevel + 1)
            ->orWhere('grade_level', $maxGradeLevel)
            ->get();

        return view('staff.students.reffer', compact('classroom', 'classrooms', 'higherClass'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'students' => 'required|array',
        ]);

        $studentsData = $request->input('students');
        $successMessages = [];

        foreach ($studentsData as $studentId => $data) {
            $student = Students::find($studentId);

            if ($student) {
                $student->classroom_id = $data['classroom_id'];
                $student->save();

                $successMessages[] = 'Student ' . $student->first_name . ' has been referred to the new classroom.';
            } else {
                $successMessages[] = 'Student with ID ' . $studentId . ' not found.';
            }
        }

        $adminUsers = User::where('role', 1)->get();

        foreach ($adminUsers as $adminUser) {
            $adminUser->notify(new RefferNotification($student, $classroom));
        }

        return response()->json(['success' => $successMessages]);
    }

}



