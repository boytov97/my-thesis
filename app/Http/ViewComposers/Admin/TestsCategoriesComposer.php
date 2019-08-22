<?php

namespace App\Http\ViewComposers\Admin;

use App\Repositories\CategoryRepository;
use Illuminate\View\View;

class TestsCategoriesComposer
{
    protected $categoryRepository;

    public function compose(View $view)
    {
        $this->categoryRepository = new CategoryRepository();

        $view->with('categories', $this->categoryRepository->getSelectByColumn('test'));
    }
}