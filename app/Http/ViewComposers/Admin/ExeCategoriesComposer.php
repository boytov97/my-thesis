<?php

namespace App\Http\ViewComposers\Admin;

use App\ExeCategories;
use Illuminate\View\View;

class ExeCategoriesComposer
{
    public function compose(View $view)
    {
        $view->with('exe_categories', ExeCategories::order()->pluck('title', 'id'));
    }
}