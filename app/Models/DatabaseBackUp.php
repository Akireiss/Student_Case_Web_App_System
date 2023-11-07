<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabaseBackUp extends Model
{
    use HasFactory;

    protected $table = 'db_back_up';
    protected $fillable = [
        'database_name'
    ];
}
