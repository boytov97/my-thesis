<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use File;

    protected $fileField = 'audio';

    protected $fillable = ['title', 'category_id', 'author', 'content', 'unf_words', 'audio', 'active'];

    public function scopeOrder($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function parent()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
