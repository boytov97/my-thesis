<?php

namespace App\Http\Controllers\Nimda;

use App\Exercise;

class ExerciseController extends Admin
{
    protected $title = 'Көнүгүүлөр (GMR)';

    public function getModel()
    {
        return new Exercise();
    }

    public function getRules($request, $id = false)
    {
        return [
            'part_one' => 'max:255',
            'answer' => 'sometimes|required|max:255',
            'part_two' => 'sometimes|required|max:255',
            'priority' => 'sometimes|required|numeric|max:11',
        ];
    }

    public function getFormViewName()
    {
        return $this->viewPrefix . 'exercise.form';
    }

    public function getIndexViewName()
    {
        return $this->viewPrefix . 'exercise.list';
    }

    protected function setRoutePrefix()
    {
        if (!$this->routePrefix) {
            $this->routePrefix = 'admin_exercise_';
        }
    }
}