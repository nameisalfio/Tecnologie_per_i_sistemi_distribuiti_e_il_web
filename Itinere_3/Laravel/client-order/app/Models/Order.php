<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ["object", "client_id"];

    public function client()
    {
        return $this->belongTo(Client::class);
    }
}
