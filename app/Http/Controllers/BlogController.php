<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Request;

class BlogController extends Controller
{
    protected $perPage = 6;

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getModel()
    {
        return new Blogs();
    }

    public function index($slug = false)
    {
        $query = $this->getModel()->newQuery();

        if($slug) {
            $category = $this->categoryRepository->getCategoryBySlug($slug);

            $query->where('category_id', $category->id);
        }

        return view('blog.index', [
            'entities' => $query->active()->order()->paginate($this->perPage)
        ]);
    }

    public function show($slug, $id)
    {
        return view('blog.inner', [
            'entity' => $this->getModel()->findOrFail($id),
            'back_url' => Request::url()
        ]);
    }
}
