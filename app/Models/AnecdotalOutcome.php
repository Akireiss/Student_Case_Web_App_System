<?php

namespace App\Models;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function actionTaken()
    {
        return $this->belongsTo(Actions::class, 'actions_id');
    }

}
