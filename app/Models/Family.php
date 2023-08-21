<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $table = 'parents';

    protected $fillable = [
        'profile_id',
        'parent_type',
        'parent_name',
        'parent_age',
        'parent_occupation',
        'parent_contact',
        'parent_office_contact',
        'parent_birth_place',
        'parent_work_address',
        'parent_monthly_income',

    ];
}
