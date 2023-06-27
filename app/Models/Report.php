<?php

namespace App\Models;

use App\Models\Admin\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $table = 'classrooms';

    protected $fillable = [
        'user_id',
        'anecdotal_id',
        'employee_id',
        'students_id',
        'status'
    ];

    public function student()
{
    return $this->belongsTo(Student::class);
}

}
