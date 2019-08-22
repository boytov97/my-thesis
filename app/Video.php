<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use File;

    protected $fileField = 'video';
    protected $imageField = 'video_image';

    protected $fillable = ['title', 'author', 'description', 'file', 'image', 'active'];

    public function scopeOrder($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function videoCommits()
    {
        return $this->hasMany(VideoCommits::class, 'video_id');
    }
}
