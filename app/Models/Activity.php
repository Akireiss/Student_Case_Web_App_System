<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    use StatusTrait;

    protected $table = 'activity_log';

    protected $fillable = [
        'log_name',
        'description',
        'event'
    ];


}
