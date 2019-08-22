<?php

namespace App\Http\Controllers\Nimda;

use App\User;

class AdminsController extends Admin
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    public function getModel()
    {
        return new User();
    }

    public function getRules($request, $id = false)
    {
        return [
            'position' => 'required|max:255'
        ];
    }

    public function getFormViewName()
    {
        return $this->viewPrefix . 'admins.form';
    }

    public function getIndexViewName()
    {
        return $this->viewPrefix . 'admins.list';
    }

    protected function setRoutePrefix()
    {
        if (!$this->routePrefix) {
            $this->routePrefix = 'admins_';
        }
    }
}