<?php

namespace App\Models;

use App\Models\Award;
use App\Models\EducBg;
use App\Models\Family;
use App\Models\Sibling;
use App\Models\Vitamin;
use App\Models\Accident;
use App\Models\Barangay;
use App\Models\Medicine;
use App\Models\Students;
use App\Models\Municipal;
use App\Models\Operation;
use App\Traits\StatusTrait;
use App\Models\ParentStatus;
use App\Http\Livewire\BirthPlace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    use StatusTrait;


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
        'four_ps',
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
    public function siblings()
    {
        return $this->hasMany(Sibling::class);
    }


    public function parent_status()
    {
        return $this->hasMany(ParentStatus::class);
    }

// public function parents()
// {
//     return $this->hasMany(Family::class, 'profile_id');
// }


    public function family()
    {
        return $this->hasMany(Family::class);
    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }



    public function awards()
    {
        return $this->hasMany(Award::class);
    }

    public function vitamins()
    {
        return $this->hasMany(Vitamin::class);
    }

    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function education()
    {
        return $this->hasMany(EducBg::class, 'profile_id');
    }

    public function accidents()
    {
        return $this->hasMany(Accident::class);
    }

    //Address
    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
    public function municipal()
    {
        return $this->belongsTo(Municipal::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function disability()
    {
        return $this->belongsTo(Dissa::class);
    }

    public static function codes()
    {
        return collect([
            ['status' => 0, 'label' => 'Pending'],
            ['status' => 1, 'label' => 'Process'],
            ['status' => 2, 'label' => 'Ongoing'],
            ['status' => 3, 'label' => 'Resolved'],
        ]);
    }

}
