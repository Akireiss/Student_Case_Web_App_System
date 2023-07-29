<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentStatus extends Model
{
    use HasFactory;
    protected $table = 'parent_status';

    protected $fillable = [
        'profile_id',
        'parent_status'

    ];
}
