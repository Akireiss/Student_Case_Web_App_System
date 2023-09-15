<?php

namespace App\Models;

use App\Models\Profile;
use App\Models\Anecdotal;
use App\Models\Classroom;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students';


    protected $fillable = [
        'classroom_id',
        'first_name',
        'middle_name',
        'last_name',
        'lrn',
        'gender',
        'status',

    ];

    public function anecdotal()
    {
        return $this->hasMany(Anecdotal::class, 'student_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }


    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function profile()
    {
        return $this->hasMany(Profile::class, 'student_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'anecdotal_id');
    }

    public static function codes()
    {
        return collect(
            [
                ['status' => 0, 'label' => 'Active'],
                ['status' => 1, 'label' => 'Inactive'],
                ['status' => 2, 'label' => 'Completter'],
                ['status' => 3, 'label' => 'Graduate'],
            ]
        );
    }


    public function getStatusTextAttribute()
    {
        $statusCodes = [
            0 => 'Active',
            1 => 'Inactive',
            2 => 'Completter',
            3 => 'Graduate',
        ];

        return $statusCodes[$this->attributes['status']] ?? '';
    }




    public function getGenderTextAttribute()
    {
        $statusCodes = [
            0 => 'Male',
            1 => 'Female',
        ];

        return $statusCodes[$this->attributes['gender']] ?? '';
    }

    public static function codesGender()
    {
        return collect(
            [
                ['gender' => 0, 'label' => 'Male'],
                ['gender' => 1, 'label' => 'Female'],
            ]
        );
    }


}
