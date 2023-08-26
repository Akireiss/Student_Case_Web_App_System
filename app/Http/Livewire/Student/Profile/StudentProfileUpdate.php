<?php

namespace App\Http\Livewire\Student\Profile;

use App\Models\Profile;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Students;
use App\Models\Municipal;
use App\Models\ParentStatus;
use App\Traits\SelectNameTrait;
use App\Traits\WireModelTraits;
use App\Traits\RewardSiblingTrait;
use App\Traits\UpdateAddressTrait;

class StudentProfileUpdate extends Component
{
    use UpdateAddressTrait;
    use SelectNameTrait;
    use WireModelTraits;
    use RewardSiblingTrait;
    public $parent_statuses = [];

    public $profileId;
    public $profile;


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
        $this->studentName = $this->profile->student->first_name;
        $this->last_name = $this->profile->student->last_name;
        $this->middle_name = $this->profile->student->middle_name;
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
        $this->living_with = $this->profile->living_with;
        $this->favorite_subject = $this->profile->favorite_subject;
        $this->difficult_subject = $this->profile->difficult_subject;
        $this->school_organization = $this->profile->school_organization;
        $this->plans = $this->profile->graduation_plan;
        $this->height = $this->profile->height;
        $this->weight = $this->profile->weight;
        $this->bmi = $this->profile->bmi;
        $this->hasDisability = $this->profile->disability;
        $this->hasFoodAllergy = $this->profile->food_allergy;

        //Guardian
        $this->guardian_name = $this->profile->guardian_name;
        $this->relationship = $this->profile->guardian_relationship;
        $this->guardian_contact = $this->profile->guardian_contact;
        $this->guardian_age = $this->profile->guardian_age;
        $this->guardian_address = $this->profile->guardian_address;

        //Family Background: Father
        if ($this->profile->family->count() > 0) {
            $familyMember = $this->profile->family->where('parent_type', 0)->first();
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
            $familyMember = $this->profile->family->where('parent_type', 1)->first();
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

        $profileData = Profile::findOrFail($profile);
        $parentStatus = $profileData->parent_status;
        if ($parentStatus->count() > 0) {
            $this->parent_statuses = $parentStatus->pluck('parent_status')->toArray();
        }

        foreach ($this->profile->education as $education) {
            $this->education[] = [
                'grade_level' => $education->grade_level,
                'school_name' => $education->school_name,
                'grade_section' => $education->grade_section,
                'school_year' => $education->school_year,
            ];
        }



        $medicineData = $this->profile?->medicines;
        $this->medicines = $medicineData->isEmpty() ? ['No Data'] : $medicineData->pluck('medicine')->toArray();

        $vitamintData = $this->profile->vitamins;
        $this->vitamins = $vitamintData->isEmpty() ? ['No Data'] : $vitamintData->pluck('vitamins')->toArray();


        $accidentData = $this->profile?->accidents;
        $this->accidents = $accidentData->isEmpty() ? ['No Data'] : $accidentData->pluck('accidents')->toArray();

        $operationData = $this->profile->operations;
        $this->operations = $operationData->isEmpty() ? ['No Data'] : $operationData->pluck('operations')->toArray();

        $siblingsData = $this->profile->siblings;
        foreach ($siblingsData as $sibling) {
            $this->siblings[] = [
                'name' => $sibling->sibling_name,
                'age' => $sibling->sibling_age,
                'gradeSection' => $sibling->sibling_grade_section,
            ];

        }

        $awardsData = $this->profile->awards;
        foreach ($awardsData as $award) {
            $this->rewards[] = [
                'name' => $award->award_name,
                'year' => $award->award_year,
            ];
        }


    }


    public function updateProfile()
    {
        $this->profile->update([
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

        $fatherFamilyMember = $this->profile->family->where('parent_type', 0)->first();
        if ($fatherFamilyMember) {
            $fatherFamilyMember->update([
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
        }

        $motherFamilyMember = $this->profile->family->where('parent_type', 1)->first();
        if ($motherFamilyMember) {
            $motherFamilyMember->update([
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
        }

        foreach ($this->profile->education as $index => $educModel) {
            if (isset($this->education[$index])) {
                $educationData = $this->education[$index];
                $educModel->update([
                    'school_name' => $educationData['school_name'],
                    'grade_section' => $educationData['grade_section'],
                    'school_year' => $educationData['school_year']
                ]);
            }
        }

        foreach ($this->profile->parent_status as $index => $parentModel) {
            if (!isset($this->parent_statuses[$index]) && $parentModel) {
                $parentModel->delete();
            }
        }

        foreach ($this->parent_statuses as $index => $parentStatus) {
            $parentModel = $this->profile->parent_status[$index] ?? null;

            if ($parentModel) {
                $parentModel->update([
                    'parent_status' => $parentStatus,
                ]);
            } elseif ($parentStatus) {
                ParentStatus::create([
                    'profile_id' => $this->profileId,
                    'parent_status' => $parentStatus,
                ]);
            }
        }



        foreach ($this->profile->medicines as $index => $medicineModel) {
            if (isset($this->medicines[$index])) {
                $medicineModel->update([
                    'medicine' => $this->medicines[$index],
                ]);
            }
        }


        foreach ($this->profile->vitamins as $index => $vitaminModel) {
            if (isset($this->vitamins[$index])) {
                $vitaminModel->update([
                    'vitamins' => $this->vitamins[$index],
                ]);
            }
        }

        foreach ($this->profile->accidents as $index => $accidentModel) {
            if (isset($this->accidents[$index])) {
                $accidentModel->update([
                    'accidents' => $this->accidents[$index],
                ]);
            }
        }

        // Update operations
        foreach ($this->profile->operations as $index => $operationModel) {
            if (isset($this->operations[$index])) {
                $operationModel->update([
                    'operations' => $this->operations[$index],
                ]);
            }
        }

        session()->flash('message', 'Profile data updated successfully.');
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
            'students' => $students,

        ])
            ->extends('layouts.dashboard.index', )
            ->section('content');
    }



}
