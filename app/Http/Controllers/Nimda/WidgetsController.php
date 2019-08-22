<?php

namespace App\Http\Controllers\Nimda;

use App\Widgets;

class WidgetsController extends Admin
{
    protected $title = 'Виджеттер';

    public function getModel()
    {
        return new Widgets();
    }

    public function getRules($request, $id = false)
    {
        return [
            'title' => 'sometimes|required|max:255',
            'slug' => ['sometimes', 'required', 'regex:/(^[A-Za-z0-9_\-]+$)+/', 'max:60'],
            'content' => 'sometimes|required|max:65000'
        ];
    }

    public function getFormViewName()
    {
        return $this->viewPrefix . 'widgets.form';
    }

    public function getIndexViewName()
    {
        return $this->viewPrefix . 'widgets.list';
    }

    protected function setRoutePrefix()
    {
        if (!$this->routePrefix) {
            $this->routePrefix = 'admin_widgets_';
        }
    }
}