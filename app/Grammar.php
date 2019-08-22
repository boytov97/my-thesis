<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grammar extends Model
{
    use File;

    protected $fillable = ['category_id', 'content', 'image', 'active'];

    protected $imageField = 'grammar';

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

    public function exeCategories()
    {
        return $this->hasMany(ExeCategories::class, 'grammar_id');
    }
}
