<?php

namespace App\Http\Controllers\Nimda;

use App\Blogs;
use App\Categories;
use App\Http\Controllers\Files;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogController extends Admin
{
    use Files;

    protected $title = 'Блог';

    protected $config_path = 'audio';

    public function getModel()
    {
        return new Blogs();
    }

    public function getCategoryModel()
    {
        return new Categories();
    }

    public function getRules($request, $id = false)
    {
        $rules = [
            'title'       => 'sometimes|required|max:255',
            'author'      => 'sometimes|required|max:255',
            'unf_words'   => 'max:65535',
            'file'        => 'file',
            'content'     => 'sometimes|required|max:65535',
            'category_id' => ['unique:blogs,category_id']

        ];

        if($id) {
            array_pop($rules);
        }

        if ($parentCategoriesId = $this->getCategoryModel()->where('depth', 0)->pluck('id')->toArray()) {
            $rules['category_id'][] = Rule::notIn($parentCategoriesId);
        }

        return $rules;
    }

    public function getFormViewName()
    {
        return $this->viewPrefix . 'blog.form';
    }

    public function getIndexViewName()
    {
        return $this->viewPrefix . 'blog.list';
    }

    public function store(Request $request)
    {
        $request->flash();

        $this->validate($request, $this->getRules($request), [], $this->getAttributes());
        $entity = $this->getModel()->create($request->all());

        if ($request->hasFile('file')) {
            $this->upload($request, $entity, $this->config_path);
        }

        $this->after($entity, $request->parent_id);

        return redirect()
            ->route($this->routePrefix . 'edit', ['id' => $entity->id])
            ->with('message', trans($this->messages['store']));
    }

    public function update(Request $request, $id)
    {
        $request->flash();

        $this->validate($request, $this->getRules($request, $id), [], $this->getAttributes());
        $entity = $this->getModel()->findOrFail($id);
        $entity->update($request->all());

        if ($request->hasFile('file')) {
            $this->upload($request, $entity, $this->config_path);
        }

        $this->after($entity, $request->parent_id);

        return redirect()->back()->with('message', trans($this->messages['update']));
    }

    protected function setRoutePrefix()
    {
        if (!$this->routePrefix) {
            $this->routePrefix = 'admin_blog_';
        }
    }

    protected function after($entity, $parentId)
    {
        if($entity->parent->parent && !$this->getModel()->where('category_id', $entity->parent->parent->id)->first()) {
            $this->getModel()->create([
                'title' => 'Text',
                'category_id' => $entity->parent->parent->id,
                'author' => 'Admin',
                'content' => 'content'
            ]);
        }
    }
}