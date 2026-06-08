<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);
        $totals = $this->calculateTotals($cart);

        return view('cart.index', compact('cart', 'totals'));
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $variant = ProductVariant::with('product.images')->findOrFail($request->input('variant_id'));
        $cart = $request->session()->get('cart', []);
        $key = $variant->id;

        $item = $cart[$key] ?? [
            'variant_id' => $variant->id,
            'product_id' => $variant->product_id,
            'name' => $variant->product->name,
            'variant_name' => $variant->name,
            'price' => $variant->price,
            'quantity' => 0,
            'sku' => $variant->sku,
            'image_url' => $variant->product->images->first()?->url,
            'available_stock' => $variant->stock,
        ];

        $item['quantity'] += $request->input('quantity');
        $item['quantity'] = min($item['quantity'], $variant->stock);
        $cart[$key] = $item;

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = $request->session()->get('cart', []);
        $key = $request->input('variant_id');

        if (! isset($cart[$key])) {
            return back()->with('error', 'Cart item not found.');
        }

        if ($request->input('quantity') === 0) {
            unset($cart[$key]);
        } else {
            $cart[$key]['quantity'] = min($request->input('quantity'), $cart[$key]['available_stock']);
        }

        $request->session()->put('cart', $cart);

        return back()->with('success', 'Cart updated successfully.');
    }

    public function remove(Request $request, ProductVariant $variant): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$variant->id]);
        $request->session()->put('cart', $cart);

        return back()->with('success', 'Item removed from cart.');
    }

    public function clear(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');

        return redirect()->route('home')->with('success', 'Cart cleared.');
    }

    private function calculateTotals(array $cart): array
    {
        $subtotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        $shipping = (float) Setting::getValue('shipping_cost', 12.00);
        $total = $subtotal + $shipping;

        return compact('subtotal', 'shipping', 'total');
    }
}
