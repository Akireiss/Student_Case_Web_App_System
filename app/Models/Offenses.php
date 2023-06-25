<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offenses extends Model
{
    use HasFactory;

    protected $table = 'offenses';

    protected $fillable = [
        'offenses',
        'description',
        'status'
        ];
        public static function codes()
        {
            return collect(
                [
                    ['code' => 0,  'label' => 'Active'],
                    ['code' => 1,  'label' => 'Inactive'],

                ]
            );
        }
}
