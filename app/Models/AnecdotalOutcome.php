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
        'action',
        'outcome',//integer
        'outcome_remarks'
    ];

    public function getActionTextAttribute()
    {
        $value = $this->attributes['outcome']; // Retrieve the attribute value from the model

        switch ($value) {
            case 2:
                return 'Succesfull';
            case 3:
                return 'Follow-up';
            case 4:
                return 'Refferal';
            default:
                return 'Unknown';
        }
    }

    public function actionTaken()
    {
        return $this->belongsTo(Actions::class, 'actions_id');
    }

    public function anecdotal() {
        return $this->belongsTo(Anecdotal::class, 'anecdotal_id');
    }



}
