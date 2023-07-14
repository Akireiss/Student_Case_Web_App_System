<?php

namespace App\Models;

use App\Models\City;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipal extends Model
{
    use HasFactory;
    protected $table = 'municipal';

    protected $fillable = [
        'city_id',
        'municipality'
    ];
    public function address()
    {
        return $this->hasMany(Address::class, 'municipal_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
