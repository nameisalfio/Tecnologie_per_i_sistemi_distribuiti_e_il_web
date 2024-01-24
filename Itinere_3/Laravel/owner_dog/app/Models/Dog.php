<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = ["name", "breed", "owner"];

    public function owner() {
        return $this->belongsTo(Owner::class);
    }
}
