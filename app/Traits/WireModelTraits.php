<?php
namespace App\Traits;
trait WireModelTraits
{


    // Personal Information
    public $suffix, $nickname, $age, $sex, $birthdate, $birth_place,
           $contact, $birth_order, $number_of_siblings, $religion, $mother_tongue, $four_ps,
           $height, $weight, $bmi;

    // Guardian Information
    public $guardian_name, $relationship, $guardian_contact, $occupation, $guardian_address,
           $guardian_age;

    // Father Information
    public $father_type = "0",
           $father_name, $father_age, $father_occupation, $father_contact, $father_office_contact,
           $father_monthly_income, $father_birth_place, $father_work_address;

    // Mother Information
    public $mother_type = "1",
           $mother_name, $mother_age, $mother_occupation, $mother_contact, $mother_office_contact,
           $mother_monthly_income, $mother_birth_place, $mother_work_address;

    // Medical Information
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

    // Plans and Living Situation
    public $plans = [];
    public $living_with = null;
    //Preferences
    public $favorite_subject;
    public $difficult_subject;
    public $school_organization;
    // Controls
    public $disableSubmitButton = false;
    public $formSubmitted = false;
}

