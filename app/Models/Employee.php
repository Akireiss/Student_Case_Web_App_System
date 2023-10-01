<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use LogsActivity;
    use StatusTrait;

    protected $table = 'employees';

    protected $fillable = [
        'employees',
        'refference_number',
        'status'
    ];

    protected static $logAttributes = ['employees', 'refference_number', 'status'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly( ['employees', 'refference_number', 'status'])
            ->useLogName('User')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return "An employee has been {$eventName}";
    }

}



