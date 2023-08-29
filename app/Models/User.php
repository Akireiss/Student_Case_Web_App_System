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


    protected static $logAttributes = ['name', 'email', 'password'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

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


    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.

     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function reports()
    {
        return $this->hasMany(Report::class);
    }

//    Logs Activities

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'password']);
    }

    // public function student() {
    //     return $this->hasMany(Students::class, 'classroom_id', 'classroom_id');
    // }

//for adviser
    public function students() {
        return $this->hasMany(Students::class, 'classroom_id', 'classroom_id');
    }




}
