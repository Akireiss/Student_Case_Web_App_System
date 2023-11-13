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
        'offense_id',
        'grade_level',
        'gravity',
        'short_description',
        'observation',
        'desired',
        'outcome',
        'letter',
        'case_status',
        'story',

    ];
    public function getAcademicYearAttribute()
{
    // Calculate the academic year based on a June-to-May cycle
    $year = $this->created_at->format('Y');
    $month = $this->created_at->format('m');

    if ($month < 6) {
        $year--;
    }

    return $year . '-' . ($year + 1);
}
    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    public function outcomes() {
        return $this->hasOne(AnecdotalOutcome::class)->latest('updated_at');
    }


    public function report()
    {
        return $this->hasMany(Report::class, 'anecdotal_id');
    }
    public function images()
    {
        return $this->hasMany(AnecdotalImages::class, 'anecdotal_id');
    }



    public function actionsTaken()
    {
        return $this->hasMany(ActionsTaken::class, 'anecdotal_id');
    }
    public function actions()
    {
        return $this->hasOne(AnecdotalOutcome::class, 'anecdotal_id');
    }

    public function offenses()
    {
        return $this->belongsTo(Offenses::class, 'offense_id');
    }


    // TODO: for anecdotal table (still need some adjustment)
    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    public function outcome()
    {
        return $this->hasMany(AnecdotalOutcome::class, 'anecdotal_id');
    }


    // !Table
    public static function codes()
    {
        return collect([
            ['case_status' => 0, 'label' => 'Pending'],
            ['case_status' => 1, 'label' => 'Ongoing'],
            ['case_status' => 2, 'label' => 'Resolved'],
            ['case_status' => 3, 'label' => 'Follow-up'],
            ['case_status' => 4, 'label' => 'Refferral'],
        ]);
    }

    public static function gravityCodes()
    {
        return collect([
            ['gravity' => 0, 'label' => 'Low Severity'],
            ['gravity' => 1, 'label' => 'Moderate Severity'],
            ['gravity' => 2, 'label' => 'Medium Severity'],
            ['gravity' => 3, 'label' => 'High Severity'],
            ['gravity' => 4, 'label' => 'Critical Severity'],
        ]);
    }



    public function getStatusTextAttribute()
    {
        $value = $this->attributes['case_status']; // Retrieve the attribute value from the model

        switch ($value) {
            case 0:
                return 'Pending';
            case 1:
                return 'Ongoing';
            case 2:
                return 'Resolved';
            case 3:
                return 'Follow-up';
            case 4:
                return 'Refferral';
            default:
                return 'Unknown';
        }
    }

    public function getGravityTextAttribute()
    {
        $value = $this->attributes['gravity'];

        switch ($value) {
            case 0:
                return 'Low Severity';
            case 1:
                return 'Moderate Severity';
            case 2:
                return 'Medium Severity';
            case 3:
                return 'High Severity';
            case 4:
                return 'Critical Severity';
            default:
                return 'Unknown';
        }
    }


    //Log Activity
    protected static $logAttributes = [
        'student_id',
        'offense_id',
        'gravity',
        'short_description',
        'observation',
        'desired',
        'outcome',
        'letter',
        'case_status',
        'grade_level',
        'story',
        'status'
    ];
    protected static $logName = 'user';
    protected static $logOnlyDirty = true;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'student_id',
                'offense_id',
                'gravity',
                'short_description',
                'observation',
                'desired',
                'outcome',
                'letter',
                'case_status',
                'grade_level',
                'story',
                'status'
            ])
            ->useLogName('User')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "A report has been {$eventName}";
    }

}
