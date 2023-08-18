<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use StatusTrait;


    protected $table = 'employees';

    protected $fillable = [
        'employees',
        'refference_number',
        'status'
    ];
}
