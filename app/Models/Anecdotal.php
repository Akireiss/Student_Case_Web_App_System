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
        'case_status'
    ];

    public function Minoroffenses()
    {
        return $this->belongsTo(Offenses::class, 'minor_offense_id');
    }
    public function Graveoffenses()
    {
        return $this->belongsTo(Offenses::class, 'grave_offense_id');
    }

    public function report()
    {
        return $this->hasMany(Report::class, 'anecdotal_id');
    }

    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    // TODO: for anecdotal table (still need some adjustment)
    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
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

    // !Table
    public static function codes()
    {
        return collect([
            ['case_status' => 0, 'label' => 'Pending'],
            ['case_status' => 1, 'label' => 'Process'],
            ['case_status' => 2, 'label' => 'Ongoing'],
            ['case_status' => 3, 'label' => 'Resolved'],
        ]);
    }

    public function getCaseStatusAttribute()
    {
        $value = $this->attributes['case_status']; // Retrieve the attribute value from the model

        switch ($value) {
            case 0:
                return 'Pending';
            case 1:
                return 'Process';
            case 2:
                return 'Ongoing';
            case 3:
                return 'Resolved';
            default:
                return 'Unknown';
        }
    }

}
