<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sibling extends Model
{
    use HasFactory;

    protected $table = 'siblings';

    protected $fillable = [
        'profile_id',
        'sibling_name',
        'sibling_age',
        'sibling_grade_section'
    ];
}
