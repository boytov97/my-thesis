<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function getModel()
    {
        return new Feedback();
    }

    public function index()
    {
        $entity = $this->getModel()->first()->toArray();

        return view('feedback.index', ['entity' => $entity]);
    }
}
