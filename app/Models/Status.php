<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';

    protected $fillable = [
        'status'
    ];
    public static function status()
    {
        return [
            0 => 'Active',
            1 => 'Inactive',
            2 => 'Pending',
            3 => 'Resolved',
        ];
    }
}
