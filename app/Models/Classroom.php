<?php

namespace App\Models;

use App\Models\Admin\Student;
use App\Models\Section;
use App\Models\Employee;
use App\Models\GradeLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classrooms';

    protected $fillable = [
        'employee_id',
        'section_id',
        'grade_level_id',
        'status'
    ];

    // Relationships
    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function student(){
        return $this->hasMany(Student::class, 'classroom_id', 'id');
        }


}
