<?php

namespace App\Models;

use App\Models\Profile;
use App\Models\Anecdotal;
use App\Models\Classroom;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Students extends Model
{
    use HasFactory;
    use StatusTrait;



    protected $table = 'students';


    protected $fillable = [
        'classroom_id',
        'first_name',
        'middle_name',
        'last_name',
        'lrn',
        'status'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function profile()
    {
        return $this->hasMany(Profile::class, 'student_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'anecdotal_id');
    }





    public function anecdotal()
    {
        return $this->hasMany(Anecdotal::class, 'student_id');
    }

    public static function codes()
    {
        return collect(
            [
                ['status' => 0, 'label' => 'Active'],
                ['status' => 1, 'label' => 'Inactive'],
            ]
        );
    }

}
