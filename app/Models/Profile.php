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
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    use StatusTrait;
    use LogsActivity;


    protected $table = 'profile';

    protected $fillable = [
        'student_id',
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
        'status',
        'token'
    ];
    protected static $logAttributes = [
        'student_id',
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
        'status',
        'token'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly( [
                'student_id',
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
                'status',
                'token'
            ]);
    }

    public function education()
    {
        return $this->hasMany(EducBg::class);
    }
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


    public function accidents()
    {
        return $this->hasMany(Accident::class);
    }

    //Address
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function municipal()
    {
        return $this->belongsTo(Municipal::class, 'municipal_id');
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }

    // public function disability()
    // {
    //     return $this->belongsTo(Diss::class);
    // }

    public static function codes()
    {
        return collect([
            ['status' => 0, 'label' => 'Active'],
            ['status' => 1, 'label' => 'Inactive'],
        ]);
    }

}
