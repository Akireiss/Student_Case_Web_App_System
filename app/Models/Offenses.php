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

        public static function categories()
        {
            return collect([
                ['category' => 0, 'label' => 'Minor'],
                ['category' => 1, 'label' => 'Grave'],
            ]);
        }


}
