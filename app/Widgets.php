<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{
    protected $fillable = ['title', 'slug', 'active', 'content'];

    public function scopeOrder($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
