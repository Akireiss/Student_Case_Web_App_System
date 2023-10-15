<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledNotification extends Model
{
    use HasFactory;

    protected $table = 'scheduled_notification';

    protected $fillable = [
        'user_id',
        'data',//json
        'read_at'
    ];
}
