<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Images;

class CardsComposer
{
    public function compose(View $view)
    {
        $view->with('cards', Images::onMain()->active()->order()->get());
    }
}