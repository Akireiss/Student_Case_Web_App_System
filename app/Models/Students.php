<?php

namespace App\Models;

use App\Models\Profile;
use App\Models\Anecdotal;
use App\Models\Classroom;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Students extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'students';


    protected $fillable = [
        'classroom_id',
        'first_name',
        'middle_name',
        'last_name',
        'lrn',
        'gender',
        'status',
        'department'
    ];
    public function classroom()
{
    return $this->belongsTo(Classroom::class, 'classroom_id');
}
public function grade_level()
{
    return $this->belongsTo(Classroom::class, 'classroom_id');
}

    public function anecdotal()
    {
        return $this->hasMany(Anecdotal::class, 'student_id');
    }



    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
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
                ['status' => 2, 'label' => 'Graduate'],
            ]
        );
    }


    public function getStatusTextAttribute()
    {
        $statusCodes = [
            0 => 'Active',
            1 => 'Inactive',
            2 => 'Graduate',
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



    public function getDepartmentTextAttribute()
    {
        $statusCodes = [
            0 => 'High School',
            1 => 'Senior High School',
        ];

        return $statusCodes[$this->attributes['department']] ?? '';
    }

    public static function codesDepartment()
    {
        return collect(
            [
                ['department' => 0, 'label' => 'High School'],
                ['department' => 1, 'label' => 'Senior High School'],
            ]
        );
    }

    // public function yearlyReport() {
    //     return $this->hasMany(YearlyReport::class);
    // }


    protected static $logAttributes = ['first_name', 'last_name', 'lrn', 'gender'
    , 'gender', 'status', 'department'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['first_name', 'last_name', 'lrn', 'gender'
            , 'gender', 'status', 'department'])
            ->useLogName('User')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return "An student has been {$eventName}";
    }

    //Test
    protected $appends = ['full_name'];

    //important function for the table -joshua
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
