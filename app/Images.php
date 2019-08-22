<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use File;

    protected $fillable = ['title', 'category_id', 'image', 'active', 'on_main', 'route'];

    protected $imageField = 'images';

    public function scopeOrder($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeOnMain($query)
    {
        return $query->where('on_main', 1);
    }

    public function parent()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
