<?php

namespace App\Models;

use App\Models\Admin\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anecdotal extends Model
{
    use HasFactory;

    protected $table = 'anecdotal';

    protected $fillable = [
        'student_id',
        'grave_offense_id',
        'minor_offense_id',
        'gravity',
        'short_description',
        'observation',
        'desired',
        'outcome',
        'letter',
        'status'
    ];


    public function student() {
        return $this->belongsTo(Student::class);
    }

}
