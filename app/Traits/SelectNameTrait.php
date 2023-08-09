<?php
namespace App\Traits;

trait SelectNameTrait {
    public $studentName = '';
    public $studentId = null;
    public $isOpen = false;
    public $showError = false;
    public function selectStudent($id, $name)
    {
        $this->studentId = $id;
        $this->studentName = $name;
        $this->isOpen = false;
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
    public function mount()
    {
        $this->showError = false;
    }

}
