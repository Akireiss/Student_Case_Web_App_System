<?php

namespace App\Http\Livewire\Adviser;

use App\Models\Students;
use App\Models\User;
use App\Models\Action;
use Livewire\Component;
use App\Models\Offenses;
use App\Http\Livewire\Admin\Student;

class Report extends Component
{
    public $search;
    public $selectedResult;
    public $last_name;
    public $recentReports; // Holds the recent reports for the selected student

    public $selectedActions = [];

    public function getSearchResults()
    {
        if (strlen($this->search) >= 3) {
            return Student::where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->get(['first_name', 'last_name']);
        }

        return collect([]);
    }

    public function render()
    {
        $searchResults = $this->getSearchResults();

        $actions = Action::pluck('actions', 'id');
        $offenses = Offenses::whereIn('category', [0, 1])
            ->pluck('offenses', 'id')
            ->groupBy('category');

        $minorOffenses = $offenses->pluck(0); // Fetch offenses from category 0 (minor offenses)
        $graveOffenses = $offenses->pluck(1); // Fetch offenses from category 1 (grave offenses)

        return view('livewire.adviser.report', [
            'searchResults' => $searchResults,
            'minorOffenses' => $minorOffenses,
            'graveOffenses' => $graveOffenses,
            'actions' => $actions
        ]);
    }



    public function selectResult($result)
    {
        $this->selectedResult = $result;

        // Fetch the student record based on the selected first name
        $student = Students::where('first_name', $this->selectedResult)->first();

        if ($student) {
            // Update the last_name property with the retrieved last name
            $this->last_name = $student->last_name;
            $this->emit('lastNameUpdated', $this->last_name);

            // Fetch the recent reports for the selected student
            $this->recentReports = $student->reports()->orderByDesc('created_at')->get();
        }
    }


}
