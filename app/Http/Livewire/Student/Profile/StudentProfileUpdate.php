<?php

namespace App\Http\Livewire\Student\Profile;

use App\Models\Barangay;
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
    public $disableSubmitButton = false;


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
