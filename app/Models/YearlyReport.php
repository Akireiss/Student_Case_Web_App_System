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


}
