<?php

namespace App\Http\Controllers\Admin;

use App\Models\Anecdotal;
use App\Models\Classroom;
use App\Models\Offenses;
use Illuminate\Http\Request;
use App\Models\Admin\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentFormRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.settings.students.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::all();
        return view('admin.settings.students.index', compact('classrooms'));
    }



    public function store(StudentFormRequest $request)
    {
        $validatedData = $request->validated();
        $classroom = Classroom::findOrFail($validatedData['classroom_id']);
        $student = $classroom->student()->create([
            'classroom_id' => $validatedData['classroom_id'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'status' => $request === true ? '1' : '0',
        ]);

        return redirect('admin/settings/students')->with('message', 'Student Added Successfully');
    }





    public function show($id)
    {
        $anecdotal = Anecdotal::findOrFail($id);
        $offenses = Offenses::all();
        return view('staff.reports.view', ['anecdotal' => $anecdotal,
            'offenses' => $offenses]);
    }

}
