<?php

namespace App\Models;

use App\Models\Award;
use App\Models\EducBg;
use App\Models\Sibling;
use App\Models\Vitamin;
use App\Models\Accident;
use App\Models\Medicine;
use App\Models\Students;
use App\Models\Operation;
use App\Models\ParentStatus;
use App\Http\Livewire\BirthPlace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $fillable = [
        'student_id',
        'm_name',
        'suffix',
        'nickname',
        'age',
        'sex',
        'birthdate',
        'contact',
        'barangay_id',
        'municipal_id',
        'province_id',
        'birth_place',
        'religion',
        'mother_tongue',
        '4ps',
        'birth_order',
        'no_of_siblings',
        'living_with',
        'guardian_name',
        'guardian_relationship',
        'guardian_contact',
        'guardian_occupation',
        'guardian_age',
        'guardian_address',
        'favorite_subject',
        'difficult_subject',
        'school_organization',
        'graduation_plan',
        'height',
        'weight',
        'bmi',
        'disability',
        'food_allergy',
        'status'
    ];


    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }



    public function family() {
        return $this->hasMany(Family::class);
    }

    public function siblings() {
        return $this->hasMany(Sibling::class);
    }
    public function parent_status() {
        return $this->hasMany(ParentStatus::class);
    }
    public function awards() {
        return $this->hasMany(Award::class);
    }

    public function vitamins() {
        return $this->hasMany(Vitamin::class);
    }

    public function medicines() {
        return $this->hasMany(Medicine::class);
    }

    public function operations() {
        return $this->hasMany(Operation::class);
    }

    public function education() {
        return $this->hasMany(EducBg::class);
    }

    public function accidents() {
        return $this->hasMany(Accident::class);
    }

    // public function address() {
    //     return $this->hasMany(Address::class);
    // }


}
