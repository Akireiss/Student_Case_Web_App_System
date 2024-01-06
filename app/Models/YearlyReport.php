<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class YearlyReport extends Model
{
    use HasFactory, Notifiable;
    use LogsActivity;

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


    protected static $logAttributes = ['data', 'category', 'school_year'];
    protected static $logName = 'user';
    protected static $logOnlyDirty = true;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['data', 'category', 'school_year'])
            ->useLogName('User')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Yearly report has been {$eventName}";
    }

}

