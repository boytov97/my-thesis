<?php

namespace App\Http\Controllers\Nimda;

use App\ExeCategories;

class ExeCategoryController extends Admin
{
    protected $title = 'Көнүгүү бөлүмдөрү';

    public function getModel()
    {
        return new ExeCategories();
    }

    public function getRules($request, $id = false)
    {
        return [
            'title' => 'sometimes|required|max:255',
            'description' => 'sometimes|required|max:255'
        ];
    }

    public function destroy($id)
    {
        $entity = $this->getModel()->find($id);

        if(count($entity->exercises)) {
            return redirect()->back()->withErrors(trans($this->messages['unable_delete']));
        }

        $entity->delete();

        if($this->config_path) {
            $this->deleteUploads($entity, $this->config_path);
        }

        return redirect()->back()->with('message', trans($this->messages['destroy']));
    }

    public function getFormViewName()
    {
        return $this->viewPrefix . 'exe_category.form';
    }

    public function getIndexViewName()
    {
        return $this->viewPrefix . 'exe_category.list';
    }

    protected function setRoutePrefix()
    {
        if (!$this->routePrefix) {
            $this->routePrefix = 'admin_exe_category_';
        }
    }
}
