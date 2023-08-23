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
////









$this->last_name = $profile->student->first_name;
$this->last_name = $profile->student->last_name;
$this->m_name = $profile->m_name;
$this->suffix = $profile->suffix;
$this->nickname = $profile->nickname;
$this->age = $profile->age;
$this->sex = $profile->sex;
$this->birthdate = $profile->birthdate;
$this->contact = $profile->contact;
$this->religion = $profile->religion;
$this->mother_tongue = $profile->mother_tongue;
//Four 4ps here
$this->birth_order = $profile->birth_order;
$this->number_of_siblings = $profile->no_of_siblings;
//address here
$this->birth_place = $profile->birth_place;
$this->living_with = $profile->living_with;
$this->guardian_name = $profile->guardian_name;
$this->relationship = $profile->guardian_relationship;
$this->guardian_contact = $profile->guardian_contact;
$this->guardian_address = $profile->guardian_address;
$this->occupation = $profile->guardian_occupation;
$this->guardian_age = $profile->guardian_age;
$this->favorite_subject = $profile->favorite_subject;
$this->difficult_subject = $profile->difficult_subject;
$this->school_organization = $profile->school_organization;
$this->plans = $profile->graduation_plan;
$this->height = $profile->height;
$this->weight = $profile->weight;
$this->bmi = $profile->bmi;

$this->disability = $profile->disability;
$this->foodAllergy = $profile->food_allergy;


if ($profile->parents) {
    $parents = $profile->parents;

    if ($parents->type == 'father') {
        $this->father_name = $parents->parent_name;
        $this->father_age = $parents->parent_age;
        $this->father_occupation = $parents->parent_occupation;
        $this->father_contact = $parents->parent_contact;
        $this->father_office_contact = $parents->parent_office_contact;
        $this->father_birth_place = $parents->parent_birth_place;
        $this->father_work_address = $parents->parent_work_address;
        $this->father_monthly_income = $parents->parent_monthly_income;
    } elseif ($parents->type == 'mother') {
        $this->mother_name = $parents->parent_name;
        $this->mother_age = $parents->parent_age;
        $this->mother_occupation = $parents->parent_occupation;
        $this->mother_contact = $parents->parent_contact;
        $this->mother_office_contact = $parents->parent_office_contact;
        $this->mother_birth_place = $parents->parent_birth_place;
        $this->mother_work_address = $parents->parent_work_address;
        $this->mother_monthly_income = $parents->parent_monthly_income;
    }
}

$educationBackgrounds = EducBg::where('profile_id', $profile->id)->get();
// Prepare the education data for form fields
$this->education = [];
foreach ($educationBackgrounds as $background) {
    $this->education[$background->grade_level] = [
        'name' => $background->school_name,
        'section' => $background->grade_section,
        'school_year' => $background->school_year,
    ];
}


//Anecdotal Table
  // public function resetForm()
    // {
    //     $this->studentName = '';
    //     $this->studentId = null;
    //     $this->cases = [];
    //     $this->resetErrorBag(['studentId']);
    // }










    public function update()
    {
        $letterPath = null;

        if ($this->letter) {
            $letterPath = $this->letter->store('uploads', 'public');
        }

        $anecdotal = Anecdotal::update([
            'student_id' => $this->studentId,
            'minor_offense_id' => $this->minor_offenses_id,
            'grave_offense_id' => $this->grave_offenses_id,
            'gravity' => $this->gravity,
            'short_description' => $this->short_description,
            'observation' => $this->observation,
            'desired' => $this->desired,
            'outcome' => $this->outcome,
            'letter' => $letterPath,
        ]);

        foreach ($this->selectedActions as $selectedAction) {
            $anecdotal->actionsTaken()->update([
                'actions' => $selectedAction
            ]);
        }

        $userId = Auth::id();
        if (!is_null($userId)) {
            $anecdotal->report()->update([
                'user_id' => $userId,
            ]);
        }

        $this->resetForm();
        session()->flash('message', 'Updated Successfully');
    }
