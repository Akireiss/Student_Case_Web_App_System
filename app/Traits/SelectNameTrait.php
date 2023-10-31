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
        $this->updatedOffenseId();

    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function updatedStudentName($value)
    {
        if (empty($value)) {
            $this->resetName();
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

    public function resetForm()
    {
        $this->studentName = '';
        $this->middle_name = '';
        $this->last_name = '';
        $this->studentId = null;
        $this->cases = [];
        $this->resetErrorBag(['studentId']);
    }

    public function resetName()
    {
        $this->studentName = '';
        $this->studentId = '';
        $this->middle_name= '';
        $this->last_name = '';
    }
}
