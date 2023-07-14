<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Municipal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barangay extends Model
{
    use HasFactory;
    protected $table = 'barangay';

    protected $fillable = [
        'municipal_id',
        'barangay'
    ];
    public function address(){
        return $this->hasMany(Address::class, 'barangay_id', 'id');
    }
    public function municipal()
    {
        return $this->belongsTo(Municipal::class, 'municipal_id', 'id');
    }
}
