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

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

//adviser
    public function students() {
        return $this->hasMany(Students::class);
    }


}
