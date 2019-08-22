<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ['exe_category_id', 'priority', 'part_one', 'answer', 'part_two', 'transition', 'active'];

    public function scopeOrder($query)
    {
        return $query->orderBy('priority', 'desc')->orderBy('created_at', 'desc');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function getExerciseByCategoryId($id)
    {
        return $this->where('exe_category_id', $id)->active()->order()->get();
    }

    public function parent()
    {
        return $this->belongsTo(ExeCategories::class, 'exe_category_id');
    }
}
