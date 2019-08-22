<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    protected $fillable = ['category_id', 'question', 'options', 'answer', 'priority'];

    public function scopeOrder($query)
    {
        return $query->orderBy('priority', 'desc')->orderBy('created_at', 'desc');
    }

    public function parent()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
