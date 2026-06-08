<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show(Product $product): View
    {
        $product->load(['images', 'variants', 'reviews.user', 'category']);

        $relatedProducts = Product::published()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('images')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function addReview(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $product->reviews()->create([
            'user_id' => $request->user()?->id,
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
            'approved' => true,
        ]);

        return back()->with('success', 'Your review has been posted.');
    }
}
