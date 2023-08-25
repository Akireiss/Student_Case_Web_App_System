<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducBg extends Model
{
    use HasFactory;
    protected $table = 'education_background';

    protected $fillable = [
        'profile_id',
        'grade_level',
        'school_name',
        'school_year',
        'grade_section'
    ];

    public function calculateGradeLevel()
{

    return 'Grade ' . $this->school_year;
}

}
