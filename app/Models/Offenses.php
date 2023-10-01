<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Offenses extends Model
{
    use HasFactory;
    use StatusTrait;
    use LogsActivity;

    protected $table = 'offenses';

    protected $fillable = [
        'offenses',
        'description',
        'status',
        'category'
    ];


    public static function categories()
    {
        return collect([
            ['category' => 0, 'label' => 'Minor'],
            ['category' => 1, 'label' => 'Grave'],
        ]);
    }

    protected static $logAttributes = [
        'offenses',
        'description',
        'status',
        'category'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'offenses',
                'description',
                'status',
                'category'
            ])
            ->useLogName('User')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return "An offense has been {$eventName}";
    }

}
