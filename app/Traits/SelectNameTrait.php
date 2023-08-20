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



    public function mount()
    {
        $this->showError = false;
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

    public function updated()
    {
        $this->showError = false;
    }

    public function selectStudent($id, $name)
    {
        $this->studentName = $name;
        $this->studentId = $id;
        $this->isOpen = false;

        $student = Students::find($id);
        if ($student) {
            $this->cases = $student->anecdotal;
            $this->classroom = $student->classroom;
        } else {
            $this->cases = [];
        };

    }
}
