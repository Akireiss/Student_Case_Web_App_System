<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offenses extends Model
{
    use HasFactory;
    use StatusTrait;

    protected $table = 'offenses';

    protected $fillable = [
        'offenses',
        'description',
        'status',
        'category'
        ];

        public static function categories()
        {
            return collect([
                ['category' => 0, 'label' => 'Minor'],
                ['category' => 1, 'label' => 'Grave'],
            ]);
        }


}
