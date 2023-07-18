<?php

namespace App\Models;

use App\Models\Admin\Student;
use App\Models\Employee;
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

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class, 'classroom_id', 'id');
    }


}
