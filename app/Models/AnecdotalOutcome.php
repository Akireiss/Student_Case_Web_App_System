<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnecdotalOutcome extends Model
{
    use HasFactory;

    protected $table = 'anecdotal_outcome';
    protected $fillable = [
        'anecdotal_id',
        'actions_id',
        'outcome',
        'outcome_remarks'
    ];


}
