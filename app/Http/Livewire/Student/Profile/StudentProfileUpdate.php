<?php

namespace App\Http\Livewire\Student\Profile;

use App\Models\Barangay;
use App\Models\Family;
use App\Models\Municipal;
use App\Models\Profile;
use App\Traits\UpdateAddressTrait;
use Livewire\Component;
use App\Models\Province;
use App\Models\Students;
use App\Traits\SelectNameTrait;
use App\Traits\WireModelTraits;

class StudentProfileUpdate extends Component
{
    use UpdateAddressTrait;
    use SelectNameTrait;
    use WireModelTraits;

    public $profileId;
    public $profile;

    public $rewards = [
        ['name' => '', 'year' => null],
    ];
    public $siblings = [
        ['name' => '', 'age' => '', 'gradeSection' => null],
    ];

    public function selectStudent($id, $name)
    {
        $this->studentId = $id;
        $this->studentName = $name;
        $this->last_name = Students::find($id)->last_name;

        $existingProfile = Profile::where('student_id', $this->studentId)->exists();

        if ($existingProfile) {
            $this->addError('studentId', 'Student Already Has A Profile');
            $this->disableSubmitButton = true;
        } else {
            $this->resetErrorBag(['studentId']);
        }

        $this->disableSubmitButton = false;
    }
    public function mount($profile)
    {
        $this->profileId = $profile;
        $this->profile = Profile::findOrFail($profile);
        $this->parentStatuses = $this->profile->parent_status->pluck('parent_status')->toArray();
        $this->studentName = $this->profile->student->first_name;
        $this->last_name = $this->profile->student->last_name;
        $this->studentId = $this->profile->student->id;
        $this->selectedCity = $this->profile->province_id;
        $this->selectedMunicipality = $this->profile->municipal_id;
        $this->selectedBarangay = $this->profile->barangay_id;
        $this->m_name = $this->profile->m_name;
        $this->suffix = $this->profile->suffix;
        $this->nickname = $this->profile->nickname;
        $this->age = $this->profile->age;
        $this->sex = $this->profile->sex;
        $this->birthdate = \Carbon\Carbon::createFromFormat('Y-m-d', $this->profile->birthdate)->format('Y-m-d');
        $this->contact = $this->profile->contact;
        $this->birth_order = $this->profile->birth_order;
        $this->number_of_siblings = $this->profile->no_of_siblings;
        $this->religion = $this->profile->religion;
        $this->four_ps = $this->profile->four_ps;
        $this->contact = $this->profile->contact;
        $this->mother_tongue = $this->profile->mother_tongue;
        $this->birth_place = $this->profile->birth_place;
        //Family Background: Father
        if ($this->profile->family->count() > 0) {
            $familyMember = $this->profile->family->where('type', 0)->first();
            if ($familyMember) {
                $this->father_name = $familyMember->parent_name;
                $this->father_age = $familyMember->parent_age;
                $this->father_occupation = $familyMember->parent_occupation;
                $this->father_contact = $familyMember->parent_contact;
                $this->father_office_contact = $familyMember->parent_office_contact;
                $this->father_monthly_income = $familyMember->parent_monthly_income;
                $this->father_birth_place = $familyMember->parent_birth_place;
                $this->father_work_address = $familyMember->parent_work_address;
            }
        }
          //Family Background: Mother
          if ($this->profile->family->count() > 0) {
            $familyMember = $this->profile->family->where('type', 1)->first();
            if ($familyMember) {
                $this->mother_name = $familyMember->parent_name;
                $this->mother_age = $familyMember->parent_age;
                $this->mother_occupation = $familyMember->parent_occupation;
                $this->mother_contact = $familyMember->parent_contact;
                $this->mother_office_contact = $familyMember->parent_office_contact;
                $this->mother_monthly_income = $familyMember->parent_monthly_income;
                $this->mother_birth_place = $familyMember->parent_birth_place;
                $this->mother_work_address = $familyMember->parent_work_address;
            }
        }






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
        $municipalities = Municipal::all();
        $barangays = Barangay::all();

        return view('livewire.student.profile.student-profile-update', [
            'profile' => $this->profile,
            'provinces' => $provinces,
            'municipalities' => $municipalities,
            'barangays' => $barangays,
            'students' => $students
        ])
            ->extends('layouts.dashboard.index', )
            ->section('content');
    }

}
