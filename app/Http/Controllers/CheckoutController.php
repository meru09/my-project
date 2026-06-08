<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ProductVariant;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Please add items to your cart before checking out.');
        }

        $subtotal = array_reduce($cart, fn ($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);
        $shippingCost = (float) Setting::getValue('shipping_cost', 12.00);
        $total = $subtotal + $shippingCost;

        return view('checkout.index', compact('cart', 'subtotal', 'shippingCost', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'phone' => 'required|string|max:30',
            'payment_method' => 'required|in:Cash On Delivery,Bank Transfer',
        ]);

        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Add some products first!');
        }

        $shippingCost = (float) Setting::getValue('shipping_cost', 12.00);
        $subtotal = array_reduce($cart, fn ($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);
        $total = $subtotal + $shippingCost;

        $order = Order::create([
            'user_id' => $request->user()?->id,
            'order_number' => strtoupper('BCE' . Str::random(8)),
            'status' => 'Pending',
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'payment_method' => $request->input('payment_method'),
            'shipping_name' => $request->input('full_name'),
            'shipping_address' => $request->input('street_address'),
            'shipping_city' => $request->input('city'),
            'shipping_state' => $request->input('state'),
            'shipping_country' => $request->input('country'),
            'shipping_postal_code' => $request->input('postal_code'),
            'shipping_phone' => $request->input('phone'),
            'notes' => $request->input('notes'),
        ]);

        foreach ($cart as $item) {
            $variant = ProductVariant::find($item['variant_id']);
            if (! $variant || $variant->stock < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', 'One or more items in your cart are no longer available. Please review your cart and try again.');
            }
        }

        foreach ($cart as $item) {
            $variant = ProductVariant::find($item['variant_id']);
            $variant->decrement('stock', $item['quantity']);

            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item['variant_id'],
                'product_name' => $item['name'],
                'variant_name' => $item['variant_name'],
                'sku' => $item['sku'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        Payment::create([
            'order_id' => $order->id,
            'amount' => $total,
            'method' => $request->input('payment_method'),
            'status' => 'Pending',
        ]);

        $request->session()->forget('cart');

        return redirect()->route('checkout.success', $order)->with('success', 'Your order was placed successfully.');
    }

    public function success(Order $order): View
    {
        return view('checkout.success', compact('order'));
    }
}
