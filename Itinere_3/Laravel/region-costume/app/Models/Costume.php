<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costume extends Model
{
    use HasFactory;

    protected $fillable = ["name", "job", "img", "price", "region_id"];

    public function region(){
        return $this->belongsTo(Region::class);
    }
}
