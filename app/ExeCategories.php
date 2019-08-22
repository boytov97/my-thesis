<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExeCategories extends Model
{
    protected $table = 'exe_categories';

    protected $fillable = ['title', 'description', 'grammar_id'];

    public function scopeOrder($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function parent()
    {
        return $this->belongsTo(Grammar::class, 'grammar_id');
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class, 'exe_category_id');
    }
}
