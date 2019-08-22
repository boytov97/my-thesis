<?php

namespace App\Http\Controllers;

use App\Images;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    protected $perPage = 16;

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getModel()
    {
        return new Images();
    }

    public function index($slug = false)
    {
        $query = $this->getModel()->where('on_main', 0);

        if($slug) {
            $category = $this->categoryRepository->getCategoryBySlug($slug);

            $query->where('category_id', $category->id);
        }

        return view('images.index', [
            'entities' => $query->active()->order()->paginate($this->perPage)
        ]);
    }
}
