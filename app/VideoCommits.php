<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoCommits extends Model
{
    protected $table = 'video_commits';

    protected $fillable = ['parent_id', 'video_id', 'user_id', 'text', 'getter_name'];

    public function scopeOrder($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function getCommits($id)
    {
        return $this->where('video_id', $id)->where('parent_id', null)->with(['children' => function($query) {
                $query->orderBy('created_at', 'asc');
            }])->order()->get();
    }

    public function getCommitsCount($id)
    {
        return $this->where('video_id', $id)->count();
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function children()
    {
        return $this->hasMany(VideoCommits::class, 'parent_id');
    }
}
