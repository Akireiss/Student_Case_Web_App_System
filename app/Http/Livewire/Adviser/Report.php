<?php

namespace App\Http\Livewire\Adviser;

use App\Models\Offenses;
use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Student;

class Report extends Component
{
    public $search;
    public $selectedResult;
    public $last_name;
    public $recentReports; // Holds the recent reports for the selected student

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
        $offenses = Offenses::pluck('offenses', 'id')->all();

        return view('livewire.adviser.report', [
            'searchResults' => $searchResults,
            'offenses' => $offenses,
        ]);
    }


    public function selectResult($result)
    {
        $this->selectedResult = $result;

        // Fetch the student record based on the selected first name
        $student = Student::where('first_name', $this->selectedResult)->first();

        if ($student) {
            // Update the last_name property with the retrieved last name
            $this->last_name = $student->last_name;
            $this->emit('lastNameUpdated', $this->last_name);

            // Fetch the recent reports for the selected student
            $this->recentReports = $student->reports()->orderByDesc('created_at')->get();
        }
    }




}
