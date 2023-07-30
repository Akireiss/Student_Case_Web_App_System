<?php

namespace App\Models;

use App\Models\User;
use App\Models\Offenses;
use App\Models\Students;
use App\Models\ActionsTaken;
use Spatie\Activitylog\LogOptions;
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


    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

    public function report()
    {
        return $this->hasMany(Report::class, 'anecdotal_id');
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
            0 => 'Active',
            1 => 'Inactive',
            2 => 'Pending',
            3 => 'Resolved',
        ];

        return $statusCodes[$this->attributes['case_status']] ?? '';
    }


    public static function status()
    {
        return collect(
            [
                ['code' => 0,  'label' => 'Active'],
                ['code' => 1,  'label' => 'Inactive'],
                ['code' => 2,  'label' => 'Pending'],
                ['code' => 3,  'label' => 'Resolved'],
            ]
        );
    }

}
