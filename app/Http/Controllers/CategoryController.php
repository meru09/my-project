<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('categories.index', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function show(Category $category): View
    {
        return view('categories.show', [
            'category' => $category->load(['products' => function ($query) {
                $query->published()->with('images', 'variants');
            }]),
        ]);
    }
}
