<?php

namespace App\Http\Controllers\Nimda;

use App\Http\Controllers\File;
use App\Images;

class ImagesController extends Admin
{
    use File;

    protected $title = 'Сүрөттөр';

    protected $config_path = 'images';

    public function getModel()
    {
        return new Images();
    }

    public function getRules($request, $id = false)
    {
        return [
            'title' => 'sometimes|required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function getFormViewName()
    {
        return $this->viewPrefix . 'images.form';
    }

    public function getIndexViewName()
    {
        return $this->viewPrefix . 'images.list';
    }

    protected function setRoutePrefix()
    {
        if (!$this->routePrefix) {
            $this->routePrefix = 'admin_images_';
        }
    }
}