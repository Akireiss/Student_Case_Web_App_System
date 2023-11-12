<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\Students;
use App\Traits\StatusTrait;
use App\Models\Admin\Student;
use Spatie\Activitylog\LogOptions;
use App\Http\Livewire\Admin\Teacher;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory;
    use StatusTrait;
    use LogsActivity;


protected $table = 'classrooms';

    protected $fillable = [
        'employee_id',
        'section',
        'grade_level',
        'status'
    ];
    public function getClassroomAttribute()
    {
        return "{$this->section} {$this->grade_level}";
    }

    public function student()
     {
         return $this->hasMany(Students::class, 'classroom_id', 'id');
     }
     public function countStudentsAnecdotals()
     {
         return $this->students()->withCount('anecdotal')->get()->sum('anecdotal_count');
     }

    public function employee()
    {
    return $this->belongsTo(Employee::class);
    }


    public function countStudentsAnecdotal()
    {
        return $this->students()->withCount('anecdotal')->get()->sum('anecdotal_count');
    }


//adviser
    public function students() {
        return $this->hasMany(Students::class);
    }


    public static function codes()
    {
        return collect(
            [
                ['class_status' => 0,  'label' => 'Active'],
                ['class_status' => 1,  'label' => 'Inactive'],
            ]
        );
    }


    //Student Count High School
    //1 active: high school
    public function totalHsFemale()
    {
        return $this->students->where('gender', 0)->where('status', 0)->count();
    }

    public function totalHsMale()
    {
        return $this->students->where('gender', 1)->where('status', 0)->count();
    }

    public function totalHighSchool()
    {
        return $this->students->where('status', 0)->count();
    }
    //Senior High
    //2 Becuse Complter = Still active
    public function totalShFemale()
    {
        return $this->students->where('gender', 0)->where('status', 2)->count();
    }

    public function totalShMale()
    {
        return $this->students->where('gender', 1)->where('status', 2)->count();
    }

    public function totalSeniorHigh()
    {
        return $this->students->where('status', 2)->count();
    }

    //Log Activity

    protected static $logAttributes = ['employee_id', 'section', 'grade_level', 'status'];

    protected static $logName = 'user';
    protected static $logOnlyDirty = true;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['employee_id', 'section', 'grade_level', 'status'])
            ->useLogName('User')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "A classroom has been {$eventName}";
    }

}
