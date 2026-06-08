<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'categories' => Category::orderBy('name')->get(),
            'featuredProducts' => Product::published()->where('featured', true)->with('images')->take(8)->get(),
            'newArrivals' => Product::published()->with('images')->latest()->take(8)->get(),
        ]);
    }
}
