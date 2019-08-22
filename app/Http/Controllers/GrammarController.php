<?php

namespace App\Http\Controllers;

use App\Grammar;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class GrammarController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getModel()
    {
        return new Grammar();
    }

    public function index($slug = false)
    {
        $entities = null;

        if($slug) {
            $category = $this->categoryRepository->getCategoryBySlug($slug);
            $entities = $this->getModel()->where('category_id', $category->id)->active()->order()->get();
        }

        return view('grammar.index', [
            'entities' => $entities
        ]);
    }
}
