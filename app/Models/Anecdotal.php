<?php

namespace App\Models;

use App\Models\User;
use App\Models\Offenses;
use App\Models\Students;
use App\Models\ActionsTaken;
use Spatie\Activitylog\LogOptions;
use App\Http\Livewire\Admin\Student;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anecdotal extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'anecdotal';

    protected $fillable = [
        'student_id',
        'grave_offense_id',
        'minor_offense_id',
        'gravity',
        'short_description',
        'observation',
        'desired',
        'outcome',
        'letter',
        'status'
    ];


    public function report()
    {
        return $this->hasMany(Report::class, 'anecdotal_id');
    }


    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

    public function Minoroffenses()
    {
        return $this->belongsTo(Offenses::class, 'minor_offense_id');
    }
    public function Graveoffenses()
    {
        return $this->belongsTo(Offenses::class, 'grave_offense_id');
    }
    public function actionsTaken()
    {
        return $this->hasMany(ActionsTaken::class, 'anecdotal_id');
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['student_id', 'short_description', 'outcome']);
    }

    public function getStatusTextAttribute()
    {
        $statusCodes = [
            0 => 'Pending',
            1 => 'In Process',
            2 => 'Pending',
            3 => 'Resolved',
        ];

        return $statusCodes[$this->attributes['case_status']] ?? '';
    }


}
