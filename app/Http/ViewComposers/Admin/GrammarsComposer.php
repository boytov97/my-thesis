<?php

namespace App\Http\ViewComposers\Admin;

use App\Grammar;
use Illuminate\View\View;

class GrammarsComposer
{
    public function compose(View $view)
    {
        $entities = Grammar::active()->order()->get();
        $grammars = [];

        foreach ($entities as $entity) {
            $grammars[$entity->id] = str_repeat('- ', $entity->parent->depth) . $entity->parent->title;
        }

        $view->with('grammars', $grammars);
    }
}