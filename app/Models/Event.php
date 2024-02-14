<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function event()
    {
        return $this->belongsTo(Price::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function latest_price()
    {
        return $this->hasOne(Price::class)->orderBy('effdate','desc');
    }
}
