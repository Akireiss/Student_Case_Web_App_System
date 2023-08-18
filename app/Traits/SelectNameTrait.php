<?php
namespace App\Traits;

use App\Models\Profile;
use App\Models\Students;

trait SelectNameTrait
{
    public $studentName = '';
    public $studentId = null;
    public $isOpen = false;
    public $showError = false;
    public $cases = [];
    //
    public $selectedActions = [];
    public $minor_offenses_id;
    public $grave_offenses_id;
    public $gravity;
    public $short_description;
    public $observation;
    public $desired;
    public $outcome;
    public $letter;
    public $user_id;
    public $classroom;

    protected $messages = [
        'studentId' => 'Please select student',
        'minor_offenses_id.required_without_all' => 'Please select at least one minor offense or provide a grave offense.',
        'grave_offenses_id.required_without_all' => 'Please select at least one grave offense or provide a minor offense.',
        'selectedActions.required' => 'Please select at least one action.',
    ];

    public function mount()
    {
        $this->showError = false;
        $this->loadCases();
        if (empty($this->rewards)) {
            $this->rewards = [['award' => '', 'year' => '']];
        }
        if (empty($this->siblings)) {
            $this->siblings = [['name' => '', 'age' => '', 'gradeSection' => '']];
        }
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function updatedStudentName($value)
    {
        if (empty($value)) {
            $this->resetForm();
        }
    }

    public function updatedStudentId()
    {
        $this->loadCases();
    }

    public function updated()
    {
        $this->showError = false;
    }

    public function resetForm()
    {
        $this->studentName = '';
        $this->studentId = null;
        $this->cases = [];
        $this->resetErrorBag(['studentId']);  // Clear the error for studentId field
    }

    public function selectStudent($id, $name)
    {
        $this->studentName = $name;
        $this->studentId = $id;
        $this->isOpen = false;
        //*load case for the case during reporting
        $this->loadCases();
        $student = Students::find($id);
        if ($student) {
            $this->cases = $student->anecdotal;
            $this->classroom = $student->classroom;
        } else {
            $this->cases = [];
        };

    }

    public function loadCases()
    {
        if ($this->studentId) {
            $student = Students::find($this->studentId);
            if ($student) {
                $this->cases = $student->anecdotal;
            } else {
                $this->cases = [];
            }
        } else {
            $this->cases = [];
        }
    }
    public function resetSelect($selectedField)
    {
        if ($selectedField === 'minor') {
            if ($this->minor_offenses_id === '') {
                $this->minor_offenses_id = null;
                return;
            }
        } elseif ($selectedField === 'grave') {
            if ($this->grave_offenses_id === '') {
                $this->grave_offenses_id = null;
                return;
            }
        }
    }

}
