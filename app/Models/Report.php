<?php

namespace App\Models;

use App\Models\User;
use App\Models\Anecdotal;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;
    use StatusTrait;


    protected $table = 'reports';

    protected $fillable = [
        'user_id',
        'anecdotal_id',
        'status',
    ];

    //! Powergrid
    public function anecdotal()
    {
        return $this->belongsTo(Anecdotal::class, 'anecdotal_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function users()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
    public function students()
    {
        return $this->hasMany(Students::class, 'student_id');
    }

    public function getCaseStatusAttribute($value)
    {
        switch ($value) {
            case 0:
                return 'Pending';
            case 1:
                return 'Active';
            case 2:
                return 'InProgress';
            case 3:
                return 'Closed';
            default:
                return 'unknown';
        }
    }

}
