<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class River extends Model
{
    use HasFactory;

    protected $fillable = ["name", "length", "continent_id"];

    public function continent(){
        return $this->belongsTo("continent", Continent::class);
    }
}
