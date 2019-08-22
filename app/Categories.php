<?php

namespace App;

class Categories extends \Baum\Node
{
    protected $table = 'categories';

    protected $parentColumn = 'parent_id';

    protected $leftColumn = 'lft';

    protected $rightColumn = 'rgt';

    protected $depthColumn = 'depth';

    protected $guarded = ['id', 'parent_id', 'depth'];

    public function scopeOrder($query)
    {
        return $query->orderBy($this->leftColumn);
    }

    public function scopeGrammar($query)
    {
        return $query->where('grammar', 1);
    }

    public function scopeTest($query)
    {
        return $query->where('test', 1);
    }

    public function scopeBlog($query)
    {
        return $query->where('blog', 1);
    }

    public function images()
    {
        return $this->hasMany(Images::class, 'category_id');
    }

    public function grammars()
    {
        return $this->hasMany(Grammar::class, 'category_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blogs::class, 'category_id');
    }

    public function tests()
    {
        return $this->hasMany(Tests::class, 'category_id');
    }
}
