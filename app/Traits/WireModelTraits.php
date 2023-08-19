<?php
namespace App\Traits;

trait WireModelTraits
{
    public $formSubmitted = false;

    public $m_name, $suffix, $nickname, $age, $sex, $birthdate, $birth_place,
    $contact, $birth_order, $number_of_siblings, $religion, $mother_tongue, $four_ps,
    $guardian_name, $relationship, $guardian_contact, $occupation, $guardian_address,
    $guardian_age, $favorite_subject, $difficult_subject, $school_organization, $graduation_plan,
    $height, $weight, $bmi;
    //father
    public $father_type = 0,
    $father_name, $father_age, $father_occupation, $father_contact, $father_office_contact,
    $father_monthly_income, $father_birth_place, $father_work_address;
    //mother
    public $mother_type = 1,
    $mother_name, $mother_age, $mother_occupation, $mother_contact, $mother_office_contact,
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
    public $living_with = null;


}
