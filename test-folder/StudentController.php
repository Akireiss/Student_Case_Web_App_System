<?php

namespace App\Http\Controllers\Admin;

use App\Models\Action;
use App\Models\Offenses;
use App\Models\Anecdotal;
use App\Models\Classroom;
use App\Models\ActionsTaken;
use Illuminate\Http\Request;
use App\Models\Admin\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentFormRequest;
use PowerComponents\LivewirePowerGrid\Helpers\Actions;

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
        $actionsTaken = ActionsTaken::where('anecdotal_id', $id)->get();

        // Get the actions IDs from actions_taken table
        $actionsIds = $actionsTaken->pluck('actions_id');

        // Fetch the actions based on the IDs
        $actions = Action::whereIn('id', $actionsIds)->get();

        return view('staff.reports.view', compact('anecdotal', 'actions'));
    }


}
    // public $rewards = [
    //     ['name' => '', 'year' => null],
    // ];

    // public $siblings = [
    //     ['sibling_name' => '', 'sibling_age' => '', 'sibling_grade_section' => ''],
    // ];
