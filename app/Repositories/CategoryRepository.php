<?php

namespace App\Repositories;

use App\Categories as Model;

class CategoryRepository
{
    /**
     * Получение записей по указанному полю.
     *
     * @param string $column
     * @param bool $connection
     * @return mixed
     */
    public function getCategoriesByColumn($column, $connection = false)
    {
        $query = $this->getModel()->where($column, 1);

        if($connection) {
            $query->whereHas($connection);
        }

        return $query->order()->get();
    }

    public function getSelectByColumn($column)
    {
        $keyed = collect();
        $categories = Model::where($column, 1)->get();

        foreach ($categories as $category) {
            $keyed[$category->id] = str_repeat('- ', $category->depth) . $category->title;
        }

        return $keyed;
    }

    public function getSelect()
    {
        $keyed = collect();

        $categories = Model::get();

        foreach ($categories as $category) {
            $keyed[$category->id] = str_repeat('- ', $category->depth) . $category->title;
        }

        return $keyed;
    }

    public function getLastOne()
    {
        return Model::where('depth', 1)->order()->take(1)->get();
    }

    public function getCategoryBySlug($slug)
    {
        return Model::where('slug', $slug)->order()->firstOrFail();
    }

    private function getModel()
    {
        return new Model();
    }
}
