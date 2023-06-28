<?php

namespace App\Models;

use App\Models\User;
use App\Models\Anecdotal;
use App\Models\Admin\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'user_id',
        'anecdotal_id',
        'employee_id',
        'students_id',
        'status'
    ];

    // public function students()
    // {
    //     return $this->belongsTo(Student::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function anecdotal()
     {
         return $this->belongsTo(Anecdotal::class);
     }






}
