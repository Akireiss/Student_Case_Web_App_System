<?php

namespace App\Http\Livewire\Student;

use App\Models\EducBg;
use App\Models\Profile;
use App\Traits\SelectAddressTrait;
use Livewire\Component;
use App\Models\Students;
use App\Traits\SelectNameTrait;

class StudentForm extends Component
{
    use SelectNameTrait;
    use SelectAddressTrait;
    public function selectStudent($id, $name)
    {
        $this->studentId = $id;
        $this->studentName = $name;
        $this->isOpen = false;
        //*last name for the profile

        $profile = Profile::where('student_id', $id)->first();
        if ($profile) {
            $this->last_name = $profile->student->first_name;
            $this->last_name = $profile->student->last_name;
            $this->m_name = $profile->m_name;
            $this->suffix = $profile->suffix;
            $this->nickname = $profile->nickname;
            $this->age = $profile->age;
            $this->sex       = $profile->sex;
            $this->birthdate = $profile->birthdate;
            $this->contact = $profile->contact;
            $this->religion = $profile->religion;
            $this->mother_tongue = $profile->mother_tongue;
            //Four 4ps here
            $this->birth_order = $profile->birth_order;
            $this->number_of_siblings = $profile->no_of_siblings;
            //address here
            $this->birth_place  = $profile->birth_place;
            $this->living_with  = $profile->living_with;
            $this->guardian_name  = $profile->guardian_name;
            $this->relationship  = $profile->guardian_relationship;
            $this->guardian_contact  = $profile->guardian_contact;
            $this->guardian_address	 = $profile->guardian_address;
            $this->occupation  =  $profile->guardian_occupation;
            $this->guardian_age  =  $profile->guardian_age;
            $this->favorite_subject  =  $profile->favorite_subject;
            $this->difficult_subject   =  $profile->difficult_subject;
            $this->school_organization  =  $profile->school_organization;
            $this->plans =  $profile->graduation_plan;
            $this->height =  $profile->height;
            $this->weight =  $profile->weight;
            $this->bmi =  $profile->bmi;

            $this->disability =  $profile->disability;
            $this->foodAllergy  =  $profile->food_allergy;


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




        } else {
            $this->resetForm();
            $this->addError('studentId', 'This student has no profile. You can create a profile for this student.');
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

        return view('livewire.student.student-form', [
            'students' => $students,
        ])->extends('layouts.app')
            ->section('content');
    }

}
