<?php

namespace App\Models;

use App\Models\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActionsTaken extends Model
{
    use HasFactory;

    protected $table = 'action_taken';

    protected $fillable = [
      'anectodal_id',
      'actions',
    ];

    public function action()
    {
        return $this->belongsTo(Action::class, 'actions_id');
    }



}
