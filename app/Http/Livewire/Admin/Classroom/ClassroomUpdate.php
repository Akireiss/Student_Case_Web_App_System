<?php

namespace App\Http\Livewire\Admin\Classroom;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Students;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomUpdate extends Component
{
    public $classroom;
    public $grade_level;
    public $section;
    public $employee_id;
    public $status;
    public $students = [];


    public $first_name;
    public $last_name;

    public $studentsClassroom;


    public function fetchStudents()
    {
        $this->students = $this->classroom->students; // Eager load the classroom relationship
    }
    public function getCombinedNameProperty($studentKey)
    {
        return $this->students[$studentKey]['first_name'] . ' ' . $this->students[$studentKey]['last_name'];
    }

    // public function getClassroom(){
    //      return $this->studentsClassroom = $this->classroom->stundents->classroom;
    // }


    protected function rules()
    {
        return [
            'grade_level' => 'required',
            'section' => 'required',
            'employee_id' => 'required',
            'status' => 'required',
        ];
    }

    public function updateClassroom()
    {
        $this->validate();

        $classroomModel = Classroom::findOrFail($this->classroom);
        $classroomModel->update([
            'grade_level' => $this->grade_level,
            'section' => $this->section,
            'employee_id' => $this->employee_id,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Classroom updated successfully.');
    }
    public function render()
    {
        $classrooms = Classroom::where('status', 0)->get();
        $employees = Employee::pluck('employees', 'id');

        // Find the maximum grade level among students
        $maxGradeLevel = $this->students->max('classroom.grade_level');

        // Filter classrooms based on the next grade level
        $filteredClassrooms = $classrooms->filter(function ($class) use ($maxGradeLevel) {
            return $class->grade_level == $maxGradeLevel + 1;
        });

        return view('livewire.admin.classroom.classroom-update', compact('employees', 'filteredClassrooms'))
            ->extends('layouts.dashboard.index')
            ->section('content');
    }

    public function mount($classroom)
    {
        $this->classroom = Classroom::findOrFail($classroom);
        $this->grade_level = $this->classroom->grade_level;
        $this->section = $this->classroom->section;
        $this->employee_id = $this->classroom->employee_id;
        $this->status = $this->classroom->status;
        $this->fetchStudents();
        $this->studentsClassroom = $this->classroom->students->pluck('id')->toArray();

    }
    public function update(Request $request, Classroom $classroom)
    {
        // Validate the request data as needed
        $request->validate([
            'students' => 'required|array',
        ]);

        // Get the array of students' data from the form
        $studentsData = $request->input('students');

        // Loop through the array of students' data
        foreach ($studentsData as $studentId => $data) {
            $student = Student::find($data['student_id']);

            if ($student) {
                // Update the student's classroom ID
                $student->classroom_id = $data['classroom_id'];
                $student->save();
            }
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Students have been referred to new classrooms.');
    }


}
