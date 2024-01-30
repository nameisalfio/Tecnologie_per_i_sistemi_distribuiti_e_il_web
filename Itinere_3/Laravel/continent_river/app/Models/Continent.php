<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function rivers(){
        return $this->hasMany("rivers", River::class);
    }
}
