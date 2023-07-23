<?php

namespace App\Http\Livewire\Adviser;

use App\Http\Requests\StudentFormRequest;
use App\Models\ActionsTaken;
use App\Models\Anecdotal;
use App\Models\Students;
use App\Models\User;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Offenses;
use App\Http\Livewire\Admin\Student;
use Livewire\WithFileUploads;

class Report extends Component
{
    public $student_id; //full name
    public $selectedResult;
    public $recentReports; // Holds the recent reports for the selected student

    public $actions;
    // Test Here
    use WithFileUploads;

    public $minor_offenses_id;
    public $grave_offenses_id;
    public $gravity;
    public $short_description;
    public $observation;
    public $desired;
    public $outcome;
    public $letter;

    public $user_id;
    public function getSearchResults()
    {
        if (strlen($this->student_id) >= 3) {
            $searchTerm = '%' . strtolower($this->student_id) . '%';
            return Students::whereRaw('LOWER(CONCAT(first_name, " ", last_name)) LIKE ?', [$searchTerm])
                ->get(['id', 'first_name', 'last_name']);
        }

        return collect([]);
    }


    public function render()
    {
        $searchResults = $this->getSearchResults();
        $offenses = Offenses::whereIn('category', [0, 1])->get();

        $minorOffenses = $offenses->where('category', 0)->pluck('offenses', 'id');
        $graveOffenses = $offenses->where('category', 1)->pluck('offenses', 'id');

        return view('livewire.adviser.report', [
            'searchResults' => $searchResults,
            'minorOffenses' => $minorOffenses,
            'graveOffenses' => $graveOffenses
        ]);
    }

    public function selectResult($result)
    {
        $this->selectedResult = $result;

        // Fetch the student record based on the selected first name
        $student = Students::with('anecdotal')->where('first_name', $this->selectedResult)->first();

        if ($student) {
            $this->selectedName = $student->first_name . ' ' . $student->last_name;
            $this->student_id = $student->id; // Set the student_id with the ID of the selected student
            // Fetch all reports for the selected student
            $this->allReports = $student->anecdotal()->with('student')->get();
        }
    }
    public function store()
    {
        $this->validate([
            'student_id' => 'required',
            'minor_offenses_id' => 'nullable',
            'grave_offenses_id' => 'nullable',
            'gravity' => 'required',
            'short_description' => 'required',
            'observation' => 'required',
            'desired' => 'required',
            'outcome' => 'required',
            'letter' => 'nullable|file|max:2048'
        ], [
            'student_id.required' => 'Please select a student.',
        ]);

        if (!$this->student_id) {
            session()->flash('error', 'Please select a student.');
        }
        $letterPath = null;

        if ($this->letter) {
            $letterPath = $this->letter->store('letter');
        }
        $anecdotal = Anecdotal::create([
            'student_id' => $this->student_id,
            'minor_offense_id' => $this->minor_offenses_id,
            'grave_offense_id' => $this->grave_offenses_id,
            'gravity' => $this->gravity,
            'short_description' => $this->short_description,
            'observation' => $this->observation,
            'desired' => $this->desired,
            'outcome' => $this->outcome,
            'letter' => $letterPath,
        ]);


        $anecdotal->actionsTaken()->create([
            'actions' => $this->actions
        ]);


        $loggedInUserId = Auth::id();

        if (!is_null($loggedInUserId)) {
            $anecdotal->report()->create([
                'user_id' => $loggedInUserId,
            ]);
        }

        $this->resetForm();
        session()->flash('message', 'Successfully Added');
    }

    public function resetForm()
    {
        $this->student_id = '';
        $this->selectResult = null;
    }

}
