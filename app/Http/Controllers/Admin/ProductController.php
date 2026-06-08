<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::with('category')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'benefits' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'featured' => 'nullable|boolean',
            'active' => 'nullable|boolean',
        ]);

        $product = Product::create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'ingredients' => array_filter(array_map('trim', explode("\n", $request->input('ingredients', '')))),
            'benefits' => array_filter(array_map('trim', explode("\n", $request->input('benefits', '')))),
            'base_price' => $request->input('base_price'),
            'featured' => $request->boolean('featured'),
            'active' => $request->boolean('active'),
        ]);

        foreach ($request->input('variants', []) as $variantData) {
            if (! empty($variantData['name'])) {
                $product->variants()->create([
                    'name' => $variantData['name'],
                    'sku' => $variantData['sku'] ?? null,
                    'price' => $variantData['price'] ?? $product->base_price,
                    'stock' => $variantData['stock'] ?? 0,
                    'size' => $variantData['size'] ?? null,
                    'color' => $variantData['color'] ?? null,
                    'shade' => $variantData['shade'] ?? null,
                    'available' => true,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product->load('variants'),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'benefits' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'featured' => 'nullable|boolean',
            'active' => 'nullable|boolean',
        ]);

        $product->update([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'ingredients' => array_filter(array_map('trim', explode("\n", $request->input('ingredients', '')))),
            'benefits' => array_filter(array_map('trim', explode("\n", $request->input('benefits', '')))),
            'base_price' => $request->input('base_price'),
            'featured' => $request->boolean('featured'),
            'active' => $request->boolean('active'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
