<?php

namespace App\Models;

use App\Models\Award;
use App\Models\Parent;
use App\Models\Sibling;
use App\Models\Vitamin;
use App\Models\Medicine;
use App\Models\Operation;
use App\Models\ParentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $fillable = [];


    public function parents() {
        return $this->hasMany(Parent::class);
    }

    public function siblings() {
        return $this->hasMany(Sibling::class);
    }
    public function parent_status() {
        return $this->hasMany(ParentStatus::class);
    }
    public function awards() {
        return $this->hasMany(Award::class);
    }

    public function vitamins() {
        return $this->hasMany(Vitamin::class);
    }

    public function medicines() {
        return $this->hasMany(Medicine::class);
    }

    public function operations() {
        return $this->hasMany(Operation::class);
    }

}
