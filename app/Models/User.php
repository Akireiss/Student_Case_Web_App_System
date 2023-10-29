<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Report;
use App\Models\Classroom;
use App\Traits\StatusTrait;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use LogsActivity;
    use StatusTrait;
    protected $table = 'users';

protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'classroom_id'
];
const ROLE_USER = 0;
const ROLE_ADMIN = 1;
const ROLE_STAFF = 2;


public function classroom()
{
    return $this->belongsTo(Classroom::class);
}
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    //for adviser
    public function students()
    {
        return $this->hasMany(Students::class, 'classroom_id', 'classroom_id');
    }


    public function getRoleTextAttribute()
    {
        $value = $this->attributes['role']; // Retrieve the attribute value from the model

        switch ($value) {
            case 0:
                return 'Adviser W/O advisee';
            case 1:
                return 'Administrator';
            case 2:
                return 'Adviser';
            default:
                return 'Unknown';
        }
    }


    public static function codes()
    {
        return collect([
            ['role' => 0, 'label' => 'Adviser W/O advisee'],
            ['role' => 1, 'label' => 'Administrator'],
            ['role' => 2, 'label' => 'Adviser'],
        ]);
    }


    //Log Activity

    protected static $logAttributes = ['name', 'email'];
    protected static $logName = 'user';
    protected static $logOnlyDirty = true;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email'])
            ->useLogName('User')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "A user has been {$eventName}";
    }



}
