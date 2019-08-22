<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use File;

    protected $fillable = ['text', 'priority', 'image', 'active'];

    protected $imageField = 'slider';

    public function scopeOrder($query)
    {
        return $query->orderBy('priority', 'desc')->orderBy('created_at', 'desc');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
