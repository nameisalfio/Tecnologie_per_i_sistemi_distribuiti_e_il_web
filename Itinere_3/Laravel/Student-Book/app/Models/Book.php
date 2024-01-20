<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ["title", "student", "price"];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
