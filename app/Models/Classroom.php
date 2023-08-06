<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\Students;
use App\Models\Admin\Student;
use App\Http\Livewire\Admin\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classrooms';

    protected $fillable = [
        'employee_id',
        'section',
        'grade_level',
        'status'
    ];
   public function student()
    {
        return $this->hasMany(Students::class, 'classroom_id', 'id');
    }


//adviser
    public function students() {
        return $this->hasMany(Students::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
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



}
