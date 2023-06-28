<?php

namespace App\Models\Admin;

use App\Models\Classroom;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';


    protected $fillable = [
        'classroom_id',
        'first_name',
        'last_name',
        'lrn',
        'status'
    ];

    public function classrooom()
    {
        return $this->belongsTo(Classroom::class);
    }


    public function reports()
    {
        return $this->hasMany(Report::class, 'anecdotal_id');
    }


}
