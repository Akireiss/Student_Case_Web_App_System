<?php

namespace App\Http\Livewire\Admin;

use App\Models\Students;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;

class StudentsProfile extends Component
{
    public $student_id;
    public $last_name;
    public $selectedResult;
    public $recentReports;
    public $selectedProvince;
    public $selectedMunicipality;
    public $selectedBarangay;
    public $municipalities = [];
    public $barangays = [];

    public $m_name, $suffix, $nickname, $age, $sex, $birthdate,
    $contact, $birth_order, $number_of_siblings, $religion, $mother_tongue, $four_ps,
    $parent_name, $parent_age, $parent_occupation, $parent_contact, $parent_office_contact, $parent_monthly_income,
    $sibling_name, $sibling_age, $sibling_grade_section,
    $living_with, $parent_status, $guardian_name, $relationship, $guardian_contact,
    $guardian_age, $favorite_subject, $difficult_subject, $school_organization, $graduation_plan,
    $height, $weight, $bmi, $disability, $foodAllergy;

    public $medicines, $vitamins, $operatins;



    public function getSearchResults()
    {
        if (strlen($this->student_id) >= 3) {
            $searchTerm = '%' . strtolower($this->student_id) . '%';
            return Students::whereRaw('LOWER(CONCAT(first_name, " ", last_name)) LIKE ?', [$searchTerm])
                ->get(['id', 'first_name', 'last_name']);
        }

        return collect([]);
    }


    public function selectResult($result)
    {
        $this->selectedResult = $result;
        // Fetch the student record based on the selected first name
        $student = Students::where('first_name', $this->selectedResult)->first();
        if ($student) {
            $this->selectedName = $student->first_name . ' ' . $student->last_name;
            $this->student_id = $student->id;
            $this->last_name = $student->last_name;
            // Fetch all reports for the selected student
            $this->allReports = $student->anecdotal()->with('student')->get();
        }
    }

    public function render()
    {
        $provinces = Province::all();
        $searchResults = $this->getSearchResults();
        return view('livewire.admin.students-profile', compact('provinces', 'searchResults'))
            ->extends('layouts.dashboard.index')
            ->section('content');
    }

    public function updatedSelectedProvince($provinceId)
    {
        $this->municipalities = Municipal::where('province_id', $provinceId)->get();
        $this->selectedMunicipality = null;
        $this->selectedBarangay = null;
        $this->barangays = [];
    }

    public function updatedSelectedMunicipality($municipalityId)
    {
        $this->barangays = Barangay::where('municipal_id', $municipalityId)->get();
        $this->selectedBarangay = null;
    }

}
