<?php

namespace App\Http\ViewComposers;

use App\Repositories\CategoryRepository;
use Illuminate\View\View;

class TestCategoriesComposer
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function compose(View $view)
    {
        $view->with('categories', $this->categoryRepository->getCategoriesByColumn('test', 'tests'));
    }
}