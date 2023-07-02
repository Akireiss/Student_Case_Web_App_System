<?php

namespace App\Models;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Students extends Model
{
    use HasFactory;


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
