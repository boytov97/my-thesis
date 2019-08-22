<?php

namespace App\Http\Controllers\Nimda;

use App\Feedback;

class FeedbackController extends Admin
{
    protected $title = 'Дареги';

    public function getModel()
    {
        return new Feedback();
    }

    public function getRules($request, $id = false)
    {
        return [
            'zoom' => 'sometimes|required|numeric',
            'lat' => 'sometimes|required|numeric',
            'lng' => 'sometimes|required|numeric',
            'address' => 'sometimes|required|max:65535',
        ];
    }

    public function getFormViewName()
    {
        return $this->viewPrefix . 'feedback.form';
    }

    public function getIndexViewName()
    {
        return $this->viewPrefix . 'feedback.list';
    }

    protected function setRoutePrefix()
    {
        if (!$this->routePrefix) {
            $this->routePrefix = 'admin_address_';
        }
    }
}
