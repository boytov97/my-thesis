<?php

namespace App\Http\Controllers\Nimda;

use App\Categories;
use App\Tests;
use Illuminate\Validation\Rule;

class TestsController extends Admin
{
    protected $title = 'Тесттер';

    public function getModel()
    {
        return new Tests();
    }

    public function getCategoryModel()
    {
        return new Categories();
    }

    public function getRules($request, $id = false)
    {
        $rules = [
            'question'    => 'required|max:255',
            'options'     => 'required|max:255',
            'answer'      => 'required|max:255',
            'priority'    => 'required|numeric|max:11',
            'category_id' => ['unique:tests,category_id']
        ];

        if ($id) {
            array_pop($rules);
        }

        if ($parentCategoriesId = $this->getCategoryModel()->where('depth', 0)->pluck('id')->toArray()) {
            $rules['category_id'][] = Rule::notIn($parentCategoriesId);
        }

        return $rules;
    }

    public function getFormViewName()
    {
        return $this->viewPrefix . 'tests.form';
    }

    public function getIndexViewName()
    {
        return $this->viewPrefix . 'tests.list';
    }

    protected function setRoutePrefix()
    {
        if (!$this->routePrefix) {
            $this->routePrefix = 'admin_tests_';
        }
    }

    protected function after($entity, $parentId)
    {
        if ($entity->parent->parent && !$this->getModel()->where('category_id', $entity->parent->parent->id)->first()) {
            $this->getModel()->create([
                'category_id' => $entity->parent->parent->id,
                'question'    => 'question',
                'options'     => 'options',
                'answer'      => 'answer',
                'priority'    => 0
            ]);
        }
    }
}