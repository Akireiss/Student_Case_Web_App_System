<?php

namespace App\Http\Livewire\Student;

use App\Models\Profile;
use Livewire\Component;
use App\Models\Province;
use App\Models\Students;
use App\Traits\SelectNameTrait;
use App\Traits\WireModelTraits;
use App\Traits\RewardSiblingTrait;
use App\Traits\SelectAddressTrait;
use Illuminate\Support\Facades\Auth;
use App\Traits\ProfileValidationTrait;
use Illuminate\Support\Facades\Session;

class StudentProfile extends Component
{
    use SelectAddressTrait;
    use SelectNameTrait;
    use ProfileValidationTrait;
    use WireModelTraits;

    public $disableSubmitButton = false;
    public $living_with = null;
    // public $rewards = [
    //     ['name' => '', 'year' => null],
    // ];
    protected $listeners = [
        'resetName'
    ];


    public function selectStudent($id, $name)
    {
        $this->studentId = $id;
        $this->studentName = $name;
        $this->last_name = Students::find($id)->last_name;
        $this->middle_name = Students::find($id)->middle_name;

        $existingProfile = Profile::where('student_id', $this->studentId)->exists();

        if ($existingProfile) {
            $this->addError('studentId', 'Student Already Has A Profile');
            $this->disableSubmitButton = true;
        } else {
            $this->resetErrorBag(['studentId']);
        }

        $this->disableSubmitButton = false;
    }

    public function render()
    {

        $students = [];

        if (strlen($this->studentName) >= 3) {
            $students = Students::where('status', 0)->where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->studentName . '%')
                    ->orWhere('middle_name', 'like', '%' . $this->studentName . '%')
                    ->orWhere('last_name', 'like', '%' . $this->studentName . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE ?", ['%' . $this->studentName . '%']);
            })->get();
        }

        $provinces = Province::all();

        if (Auth::check()) {
            return view('livewire.student.student-profile', compact('provinces', 'students'))
                ->extends('layouts.dashboard.index')
                ->section('content');
        } else {
            return view('livewire.student.student-profile', compact('provinces', 'students'))
            ->extends('layouts.app')
            ->section('content');
        }


        }
    public function save()
    {
        $this->validate();
        if (empty($this->studentId)) {
            $this->addError('studentId', 'Please select a student.');
            $this->showError = true;
            return;
        }

        $profile = Profile::create([
            'student_id' => $this->studentId,
            'suffix' => $this->suffix,
            'nickname' => $this->nickname,
            'age' => $this->age,
            'sex' => $this->sex,
            'birthdate' => $this->birthdate,
            'contact' => $this->contact,
            'religion' => $this->religion,
            'mother_tongue' => $this->mother_tongue,
            'four_ps' => $this->four_ps,
            'birth_order' => $this->birth_order,
            'no_of_siblings' => $this->number_of_siblings,
            'barangay_id' => $this->selectedBarangay,
            'municipal_id' => $this->selectedMunicipality,
            'province_id' => $this->selectedCity,
            'birth_place' => $this->birth_place,
            'living_with' => $this->living_with,
            'guardian_name' => $this->guardian_name,
            'guardian_address' => $this->guardian_name,
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
            'parent_type' => $this->father_type,
            'parent_name' => $this->father_name,
            'parent_age' => $this->father_age,
            'parent_occupation' => $this->father_occupation,
            'parent_contact' => $this->father_contact,
            'parent_office_contact' => $this->father_office_contact,
            'parent_birth_place' => $this->father_birth_place,
            'parent_work_address' => $this->father_work_address,
            'parent_monthly_income' => $this->father_monthly_income
        ]);

        $profile->family()->create([
            'parent_type' => $this->mother_type,
            'parent_name' => $this->mother_name,
            'parent_age' => $this->mother_age,
            'parent_occupation' => $this->mother_occupation,
            'parent_contact' => $this->mother_contact,
            'parent_office_contact' => $this->mother_office_contact,
            'parent_birth_place' => $this->mother_birth_place,
            'parent_work_address' => $this->mother_work_address,
            'parent_monthly_income' => $this->mother_monthly_income
        ]);


        foreach ($this->siblings as $sibling) {
            $profile->siblings()->create([
                'sibling_name' => $sibling['name'],
                'sibling_age' => $sibling['age'],
                'sibling_grade_section' => $sibling['gradeSection'],
            ]);
        }

        foreach ($this->rewards as $reward) {
            $profile->awards()->create([
                'award_name' => $reward['name'],
                'award_year' => $reward['year'],
            ]);
        }


        foreach ($this->parent_statuses as $status) {
            $profile->parent_status()->create(['parent_status' => $status]);
        }


        foreach ($this->education as $gradeLevel => $data) {
            $profile->education()->create([
                'grade_level' => $gradeLevel,
                'school_name' => $data['name'],
                'grade_section' => $data['section'],
                'school_year' => $data['school_year'],
            ]);
        }



        foreach ($this->vitamins as $vitamin) {
            if (empty($vitamin) || $vitamin === 'No Data') {
                $vitamin = 'No Data';
            }

            $profile->vitamins()->create([
                'vitamins' => $vitamin,
            ]);
        }

        foreach ($this->medicines as $medicine) {
            if (empty($medicine) || $medicine === 'No Data') {
                $medicine = 'No Data';
            }

            $profile->medicines()->create([
                'medicine' => $medicine,
            ]);
        }

        foreach ($this->operations as $operation) {
            if (empty($operation) || $operation === 'No Data') {
                $operation = 'No Data';
            }

            $profile->operations()->create([
                'operations' => $operation,
            ]);
        }


        foreach ($this->accidents as $accident) {
            if (empty($accident) || $accident === 'No Data') {
                $accident = 'No Data';
            }

            $profile->accidents()->create([
                'accidents' => $accident,
            ]);
        }


       if (Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2)) {
    session()->flash('message', 'Successfully Saved');
    $this->resetForm();
} else {
    $createdForm = Profile::latest()->first();
    Session::put('created_form_id', $createdForm->id);

    // Redirect with the created_form_id as a query parameter
    return redirect()->route('student.profile.data', ['form_id' => $createdForm->id]);
}

    }

    public function resetName()
    {
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
        $this->sex = '';
        $this->birthdate = '';
        $this->contact = '';
        $this->religion = '';
        $this->mother_tongue = '';
        $this->four_ps = '';
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
        $this->difficult_subject = '';
        $this->school_organization = '';
        $this->plans = '';
        $this->height = '';
        $this->weight = '';
        $this->bmi = '';
        $this->disability = '';
        $this->foodAllergy = '';
        $this->hasDisability = '';
        $this->hasFoodAllergy = '';
        $this->father_name = '';
        $this->father_age = '';
        $this->father_occupation = '';
        $this->father_contact = '';
        $this->father_contact = '';
        $this->father_office_contact = '';
        $this->father_birth_place = '';
        $this->father_work_address = '';
        $this->father_monthly_income = '';
        $this->mother_name = '';
        $this->mother_age = '';
        $this->mother_occupation = '';
        $this->mother_contact = '';
        $this->mother_contact = '';
        $this->mother_office_contact = '';
        $this->mother_birth_place = '';
        $this->mother_work_address = '';
        $this->mother_monthly_income = '';
        $this->siblings = [];
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
