<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Slider;

class SliderComposer
{
    public function compose(View $view)
    {
        $view->with('slider', Slider::active()->order()->get());
    }
}