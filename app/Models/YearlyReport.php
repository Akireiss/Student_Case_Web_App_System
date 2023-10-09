<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearlyReport extends Model
{
    use HasFactory;

        protected $table = 'yearly_report';
        protected $fillable = [
            'data',//json format
            'category',
             'school_year',
            'type'
        ];

        public function getTypeTextAttribute()
        {
            $value = $this->attributes['type']; // Retrieve the attribute value from the model

            switch ($value) {
                case 0:
                    return 'No Data';
                case 1:
                    return 'Completion Rate';
                case 2:
                    return 'Promotion Rate';
                case 3:
                    return 'Drop Out Rate';
                default:
                    return 'Unknown';
            }
        }
}
