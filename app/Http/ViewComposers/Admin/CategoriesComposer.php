<?php

namespace App\Http\ViewComposers\Admin;

use App\Repositories\CategoryRepository;
use Illuminate\View\View;

class CategoriesComposer
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function compose(View $view)
    {
        $view->with('categories', $this->categoryRepository->getSelect()->prepend('', ''));
    }
}