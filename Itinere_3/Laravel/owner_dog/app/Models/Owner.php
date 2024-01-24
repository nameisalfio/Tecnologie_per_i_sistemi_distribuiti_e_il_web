<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = ["name", "lastname", "age", "city"];

    public function dogs() {
        return $this->hasMany(Dog::class);
    }
}
