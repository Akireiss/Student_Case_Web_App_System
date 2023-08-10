<?php

namespace App\Http\Livewire\Admin;

use App\Models\Profile;
use App\Traits\SelectAddressTrait;
use App\Traits\SelectNameTrait;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Students;
use App\Models\Municipal;

class StudentsProfile extends Component
{
    use SelectAddressTrait;
    use SelectNameTrait;
    public $showError = false;
    //!

    //!

    public $m_name, $suffix, $nickname, $age, $sex, $birthdate, $birth_place,
    $contact, $birth_order, $number_of_siblings, $religion, $mother_tongue, $four_ps,
    $guardian_name, $relationship, $guardian_contact, $occupation, $guardian_address,
    $guardian_age, $favorite_subject, $difficult_subject, $school_organization, $graduation_plan,
    $height, $weight, $bmi;
    //father
    public $father_type, $father_name, $father_age, $father_occupation, $father_contact, $father_office_contact,
    $father_monthly_income, $father_birth_place, $father_work_address;
    //mother
    public $mother_type, $mother_name, $mother_age, $mother_occupation, $mother_contact, $mother_office_contact,
    $mother_monthly_income, $mother_birth_place, $mother_work_address;
    public $medicines = [];
    public $parent_statuses = [];
    public $vitamins = [];
    public $education = [];
    public $operations = [];
    public $accidents = [];
    public $hasDisability;
    public $disability;
    public $hasFoodAllergy;
    public $foodAllergy;
    public $plans = [];

    public $rewards = [];
    public $siblings = [
        ['name' => '', 'age' => '', 'gradeSection' => ''],
    ];
    public $living_with = null;

    protected $listeners = [
        'resetName'
    ];

    public function updatedLivingWith($value)
    {
        // Set the other checkboxes to null when one is selected
        if ($value === 'both-parents') {
            $this->living_with = 'both-parents';
        } elseif ($value === 'father-only') {
            $this->living_with = 'father-only';
        } elseif ($value === 'mother-only') {
            $this->living_with = 'mother-only';
        } elseif ($value === 'na') {
            $this->living_with = 'na';
        }
    }

    public function mount()
    {

        $this->showError = false;

        if (empty($this->rewards)) {
            $this->rewards = [['award' => '', 'year' => '']];
        }
        // Check if there are existing siblings, if not, add an initial empty sibling
        if (empty($this->siblings)) {
            $this->siblings = [['name' => '', 'age' => '', 'gradeSection' => '']];
        }
    }

    public function addSibling()
    {
        $this->siblings[] = ['name' => '', 'age' => '', 'gradeSection' => ''];
    }

    public function removeSibling($index)
    {
        unset($this->siblings[$index]);
        $this->siblings = array_values($this->siblings); // Re-index the array after removing a sibling
    }


    public function render()
    {

        $students = [];

        if (strlen($this->studentName) >= 3) {
            $students = Students::where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->studentName . '%')
                    ->orWhere('last_name', 'like', '%' . $this->studentName . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $this->studentName . '%']);
            })->get();
        }

        $provinces = Province::all();
        return view('livewire.admin.students-profile', compact( 'provinces', 'students'))
            ->extends('layouts.dashboard.index')
            ->section('content');
    }
    public function save()
    {
        if (empty($this->studentId)) {
            $this->addError('studentId', 'Please select a student.');
            $this->showError = true; // Set the showError variable to true to show the error message.
            return;
        }

        $selectedStudent = Students::find($this->studentId);

        if (!$selectedStudent) {
            $this->addError('studentId', 'Invalid student selected.');
            $this->showError = true; // Set the showError variable to true to show the error message.
            return;
        }

        $profile = Profile::create([
            'student_id' => $this->studentId,
            'm_name' => $this->m_name,
            'suffix' => $this->suffix,
            'nickname' => $this->nickname,
            'age' => $this->age,
            'sex' => $this->sex,
            'birthdate' => $this->birthdate,
            'contact' => $this->contact,
            'religion' => $this->religion,
            'mother_tongue' => $this->mother_tongue,
            '4ps' => $this->four_ps,
            'birth_order' => $this->birth_order,
            'no_of_siblings' => $this->number_of_siblings,
            'barangay_id' => $this->selectedBarangay,
            'municipal_id' => $this->selectedMunicipality,
            'province_id' => $this->selectedCity,
            'birth_place' => $this->birth_place,
            'living_with' => $this->living_with,
            'guardian_name' => $this->guardian_name,
            'guardian_relationship' => $this->relationship,
            'guardian_contact' => $this->guardian_contact,
            'guardian_occupation' => $this->occupation,
            'guardian_age' => $this->guardian_age,
            'favorite_subject' => $this->favorite_subject,
            'difficult_subject' => $this->difficult_subject,
            'school_organization' => $this->school_organization,
            'graduation_plan' => $this->plans,
            'height' => $this->height,
            'weight' => $this->weight,
            'bmi' => $this->bmi,
            'disability' => $this->hasDisability === 'Yes' ? $this->disability : 'No',
            'food_allergy' => $this->hasFoodAllergy === 'Yes' ? $this->foodAllergy : 'No',
        ]);

            $profile->family()->create([
                'type' => $this->mother_type,
                'parent_name' => $this->mother_name,
                'parent_age' => $this->mother_age,
                'parent_occupation' => $this->mother_occupation,
                'parent_contact' => $this->mother_contact,
                'parent_office_contact' => $this->mother_office_contact,
                'parent_birth_place' => $this->mother_birth_place,
                'parent_work_address' => $this->mother_work_address,
                'parent_monthly_income' => $this->mother_monthly_income
            ]);

            $profile->family()->create([
                'type' => $this->father_type,
                'parent_name' => $this->father_name,
                'parent_age' => $this->father_age,
                'parent_occupation' => $this->father_occupation,
                'parent_contact' => $this->father_contact,
                'parent_office_contact' => $this->father_office_contact,
                'parent_birth_place' => $this->father_birth_place,
                'parent_work_address' => $this->father_work_address,
                'parent_monthly_income' => $this->father_monthly_income
            ]);

        foreach ($this->siblings as $sibling) {
            $profile->siblings()->create([
                'sibling_name' => $sibling['name'],
                'sibling_age' => $sibling['age'],
                'sibling_grade_section' => $sibling['gradeSection'],
            ]);
        }

        foreach ($this->parent_statuses as $parent_status) {
            $profile->parentstatus()->create([
                'parent_status' => $parent_status
            ]);
        }


        foreach ($this->education as $gradeLevel => $data) {
            $profile->education()->create([
                'grade_level' => $gradeLevel,
                'school_name' => $data['name'],
                'grade_section' => $data['section'],
                'school_year' => $data['school_year'],
            ]);
        }

        foreach ($this->rewards as $reward) {
            $profile->awards()->create([
                'award_name' => $reward['name'],
                'award_year' => $reward['year'],
            ]);
        }

        foreach ($this->vitamins as $vitamin) {
            $profile->vitamins()->create([
                'vitamins' => $vitamin,
            ]);
        }

        foreach ($this->medicines as $medicine) {
            $profile->medicines()->create([
                'medicine' => $medicine,
            ]);
        }

        foreach ($this->operations as $operation) {
            $profile->operations()->create([
                'operations' => $operation,
            ]);
        }

        foreach ($this->accidents as $accident) {
            $profile->accidents()->create([
                'accidents' => $accident,
            ]);
        }
        $this->resetForm();

        session()->flash('message', 'Succesfully Save');

    }

    public function resetName() {
        $this->studentName = '';
        $this->studentId = '';
    }

    private function resetForm()
    {
        $this->studentName = '';
        $this->studentId = '';
        $this->last_name = '';
        $this->suffix = '';
        $this->nickname = '';
        $this->age = '';
        $this->sex       = '';
        $this->birthdate = '';
        $this->contact = '';
        $this->religion = '';
        $this->mother_tongue = '';
        $this->four_ps  = '';
        $this->birth_order = '';
        $this->number_of_siblings = '';
        $this->selectedBarangay = '';
        $this->selectedCity = '';
        $this->selectedMunicipality = '';
        $this->selectedBarangay = '';
        $this->birth_place = '';
        $this->living_with = '';
        $this->guardian_name = '';
        $this->relationship = '';
        $this->guardian_contact = '';
        $this->occupation = '';
        $this->guardian_age = '';
        $this->favorite_subject = '';
        $this->difficult_subject  = '';
        $this->school_organization = '';
        $this->plans = '';
        $this->height = '';
        $this->weight = '';
        $this->bmi = '';
        $this->disability = '';
        $this->foodAllergy  = '';
        $this->hasDisability = '';
        $this->hasFoodAllergy = '';
        $this->father_type = '';
        $this->father_name = '';
        $this->father_age = '';
        $this->father_occupation = '';
        $this->father_contact = '';
        $this->father_contact = '';
        $this->father_office_contact = '';
        $this->father_birth_place  = '';
        $this->father_work_address = '';
        $this->father_monthly_income = '';
        $this->mother_type = '';
        $this->mother_name = '';
        $this->mother_age = '';
        $this->mother_occupation = '';
        $this->mother_contact = '';
        $this->mother_contact = '';
        $this->mother_office_contact = '';
        $this->mother_birth_place  = '';
        $this->mother_work_address = '';
        $this->mother_monthly_income = '';
        $this->siblings= '';
        $this->parent_statuses = [];
        $this->medicines = [];
        $this->vitamins = [];
        $this->education = [];
        $this->operations = [];
        $this->accidents = [];
        $this->plans = [];
        $this->municipalities = [];
        $this->barangays = [];
        $this->rewards = [];


    }

}
