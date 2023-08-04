<?php

namespace App\Http\Livewire\Admin;

use App\Models\Profile;
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

    //profile
    public $m_name, $suffix, $nickname, $age, $sex, $birthdate,
    $contact, $birth_order, $number_of_siblings, $religion, $mother_tongue, $four_ps, $living_with,
    $guardian_name, $relationship, $guardian_contact, $occupation,
    $guardian_age, $favorite_subject, $difficult_subject, $school_organization, $graduation_plan,
    $height, $weight, $bmi;

    //parent
    public $type, $parent_name, $parent_age, $parent_occupation, $parent_contact, $parent_office_contact,
    $parent_monthly_income;

    //award
    public $award_name, $award_year;
    //siblings
    public $sibling_name, $sibling_age, $sibling_grade_section;
    //status
    public $parent_status;
    //medicines
    public $medicines;
    //vitamins
    public $vitamins;
    //operations
    public $operations;

    public $plans;
    public $hasDisability = 'No';
    public $disability = '';
    public $hasFoodAllergy = false;
    public $foodAllergy = '';

    public $education;
    public $accidents;

    //Birth
    public $selectedProvinceBirth;
    public $selectedMunicipalityBirth;
    public $selectedBarangayBirth;


    protected $listeners = ['birthDataUpdated' => 'handleBirthDataUpdated'];

    public function handleBirthDataUpdated($data)
    {
        $this->selectedProvinceBirth = $data['provinceId'];
        $this->selectedMunicipalityBirth = $data['municipalityId'];
        $this->selectedBarangayBirth = $data['barangayId'];
    }


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
        $student = Students::with('anecdotal')->where('first_name', $this->selectedResult)->first();

        if ($student) {
            $this->selectedName = $student->first_name . ' ' . $student->last_name;
            $this->student_id = $student->id; // Set the student_id with the ID of the selected student
            // Fetch all reports for the selected student
            $this->allReports = $student->anecdotal()->with('student')->get();
        }
    }

    public function render()
    {
        $searchResults = $this->getSearchResults();
        return view('livewire.admin.students-profile', compact('searchResults'))
            ->extends('layouts.dashboard.index')
            ->section('content');
    }

    public function save()
    {
        $combinedDisability = $this->hasDisability === 'Yes' ? 'Yes: ' . $this->disability : 'No';
        $combinedFoodAllergy = $this->hasFoodAllergy ? 'Yes: ' . $this->foodAllergy : 'No';
        $profile = Profile::create([
            'student_id' => $this->student_id,
            'm_name' => $this->m_name,
            'suffix' => $this->suffix,
            'nickname' => $this->nickname,
            'age' => $this->age,
            'sex' => $this->sex,
            'birthdate' => $this->birthdate,
            'contact' => $this->contact,
            'religions' => $this->religion,
            'mother_tongue' => $this->mother_tongue,
            '4ps' => $this->four_ps,
            'living_with' => $this->living_with,
            'guardian_name' => $this->guardian_name,
            'relationship' => $this->relationship,
            'guardian_contact' => $this->guardian_contact,
            'occupation' => $this->occupation,
            'guardian_age' => $this->guardian_age,
            'favorite_subject' => $this->favorite_subject,
            'difficult_subject' => $this->difficult_subject,
            'school_organization' => $this->school_organization,
            'graduation_plan' => $this->graduation_plan,
            'height' => $this->height,
            'weight' => $this->weight,
            'bmi' => $this->bmi,
            'disability' => $combinedDisability,
            'food_allergy' => $combinedFoodAllergy,
        ]);

        $profile->parents()->create([
            'type' => $this->type,
            'parent_name' => $this->parent_name,
            'parent_age' => $this->parent_age,
            'parent_occupation' => $this->parent_occupation,
            'parent_contact' => $this->parent_contact,
            'parent_office_contact' => $this->parent_office_contact,
            'parent_monthly_income' => $this->parent_monthly_income
        ]);

        $profile->siblings()->create([
            'sibling_name' => $this->sibling_name,
            'sibling_age' => $this->sibling_age,
            'sibling_grade_section' => $this->sibling_grade_section
        ]);

        $profile->parent_status()->create([
            'parent_status' => $this->parent_status
        ]);

        $profile->awards()->create([
            'award_name' => $this->award_name,
            'award_year' => $this->award_year
        ]);

        $profile->vitamins()->create([
            'vitamins' => $this->vitamins
        ]);
        $profile->medicines()->create([
            'medicines' => $this->medicines
        ]);
        $profile->operations()->create([
            'operations' => $this->operations
        ]);

        if ($this->type === 'birth') {
            $profile->birth_address()->create([
                'barangay_id' => $this->selectedBarangayBirth,
                'municipality_id' => $this->selectedMunicipalityBirth,
                'province_id' => $this->selectedProvinceBirth,
            ]);
        } elseif ($this->type === 'address') {
            $profile->address()->create([
                'barangay_id' => $this->selectedBarangayBirth,
                'municipality_id' => $this->selectedMunicipalityBirth,
                'province_id' => $this->selectedProvinceBirth,
            ]);
        } elseif ($this->type === 'work_address') {
            $profile->work_address()->create([
                'barangay_id' => $this->selectedBarangayBirth,
                'municipality_id' => $this->selectedMunicipalityBirth,
                'province_id' => $this->selectedProvinceBirth,
            ]);
        }



    }

}
