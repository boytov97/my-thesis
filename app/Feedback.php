<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['zoom', 'lat', 'lng', 'address'];

    public function scopeOrder($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
