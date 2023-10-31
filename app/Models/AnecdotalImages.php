<?php

namespace App\Models;

use App\Models\Anecdotal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnecdotalImages extends Model
{
    use HasFactory;
    protected $table = 'anecdotal_images';

    protected $fillable = [
        'anecdotal_id',
        'images'
    ];

    public function anecdotal()
    {
        return $this->belongsTo(Anecdotal::class);
    }


}
