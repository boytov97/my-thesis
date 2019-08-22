<?php

namespace App\Http\Controllers\Nimda;

use App\Categories;
use Illuminate\Validation\Rule;

class CategoryController extends Admin
{
    protected $title = 'Жалпы бөлүмдөр';

    public function getModel()
    {
        return new Categories();
    }

    public function getRules($request, $id = false)
    {
        return [
            'title' => 'sometimes|required|max:255',
            'slug' => ['sometimes', 'required', Rule::unique('categories')->ignore($id), 'regex:/(^[A-Za-z0-9_\-]+$)+/', 'max:60']
        ];
    }

    public function getFormViewName()
    {
        return $this->viewPrefix . 'category.form';
    }

    public function getIndexViewName()
    {
        return $this->viewPrefix . 'category.list';
    }

    protected function setRoutePrefix()
    {
        if (!$this->routePrefix) {
            $this->routePrefix = 'admin_category_';
        }
    }

    public function destroy($id)
    {
        $entity = $this->getModel()->find($id);

        if(count($entity->images) || count($entity->grammars) || count($entity->blogs) || count($entity->tests)) {
            return redirect()->back()->withErrors(trans($this->messages['unable_delete']));
        }

        $entity->delete();

        if($this->config_path) {
            $this->deleteUploads($entity, $this->config_path);
        }

        return redirect()->back()->with('message', trans($this->messages['destroy']));
    }

    protected function after($entity, $parentId)
    {
        if ($parentId && $parentId != $entity->parent_id) {
            $parent = $this->getModel()->findOrFail((int)$parentId);

            try {
                $entity->makeChildOf($parent);
            } catch (\Baum\MoveNotPossibleException $e) {
                redirect()->back()->withErrors([trans('admin.unable_to_move')]);
            }
        }
    }
}
