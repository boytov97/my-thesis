<?php

namespace App\Http\Controllers\Nimda;

use App\Http\Controllers\File;
use App\Slider;

class SliderController extends Admin
{
    use File;

    protected $title = 'Слайдер';

    protected $config_path = 'slider';

    public function getModel()
    {
        return new Slider();
    }

    public function getRules($request, $id = false)
    {
        $rules = [
            'text' => 'sometimes|required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        if($id) {
            array_pop($rules);
        }

        return $rules;
    }

    public function getFormViewName()
    {
        return $this->viewPrefix . 'slider.form';
    }

    public function getIndexViewName()
    {
        return $this->viewPrefix . 'slider.list';
    }

    protected function setRoutePrefix()
    {
        if (!$this->routePrefix) {
            $this->routePrefix = 'admin_slider_';
        }
    }
}