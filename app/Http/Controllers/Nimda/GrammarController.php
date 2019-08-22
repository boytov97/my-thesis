<?php

namespace App\Http\Controllers\Nimda;

use App\Categories;
use App\Grammar;
use App\Http\Controllers\File;
use Illuminate\Validation\Rule;

class GrammarController extends Admin
{
    use File;

    protected $title = 'Грамматика';

    protected $config_path = 'grammar';

    public function getModel()
    {
        return new Grammar();
    }

    public function getCategoryModel()
    {
        return new Categories();
    }

    public function getRules($request, $id = false)
    {
        $rules = [
            'content'     => 'sometimes|required|max:65000',
            'image'       => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => ['unique:grammars,category_id']
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
        return $this->viewPrefix . 'grammar.form';
    }

    public function getIndexViewName()
    {
        return $this->viewPrefix . 'grammar.list';
    }

    public function destroy($id)
    {
        $entity = $this->getModel()->find($id);

        if (count($entity->exeCategories) > 0) {
            return redirect()->back()->withErrors(trans($this->messages['unable_delete']));
        }

        $entity->delete();

        if ($this->config_path) {
            $this->deleteUploads($entity, $this->config_path);
        }

        return redirect()->back()->with('message', trans($this->messages['destroy']));
    }

    protected function setRoutePrefix()
    {
        if (!$this->routePrefix) {
            $this->routePrefix = 'admin_grammar_';
        }
    }

    protected function after($entity, $parentId)
    {
        if ($entity->parent->parent && !$item = $this->getModel()->where('category_id', $entity->parent->parent->id)->first()) {
            $this->getModel()->create([
                'category_id' => $entity->parent->parent->id,
                'active'      => 0,
                'content'     => 'content'
            ]);
        }
    }
}