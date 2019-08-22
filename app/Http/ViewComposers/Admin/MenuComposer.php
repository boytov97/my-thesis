<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;

class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $collection = collect(config('admin_menu.items'));
        $view->with('items', $collection->all());
    }
}