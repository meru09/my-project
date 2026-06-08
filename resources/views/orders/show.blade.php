@extends('layouts.shop')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-white p-8 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Order details</p>
                <h1 class="text-3xl font-semibold text-slate-900">Order #{{ $order->order_number }}</h1>
            </div>
            <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-900">{{ $order->status }}</span>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-[2rem] bg-white p-8 shadow-sm lg:col-span-2">
            <h2 class="text-xl font-semibold text-slate-900">Purchased items</h2>
            <div class="mt-6 space-y-4">
                @foreach($order->items as $item)
                    <div class="rounded-3xl border border-slate-200 p-4">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-semibold text-slate-900">{{ $item->product_name }}</p>
                                <p class="mt-2 text-sm text-slate-600">{{ $item->variant_name }}</p>
                            </div>
                            <p class="text-sm font-semibold text-slate-900">${{ number_format($item->subtotal, 2) }}</p>
                        </div>
                        <p class="mt-3 text-sm text-slate-500">Quantity: {{ $item->quantity }} · SKU: {{ $item->sku }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="rounded-[2rem] bg-white p-8 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Order summary</h2>
            <div class="mt-6 space-y-3 text-slate-700">
                <div class="flex items-center justify-between">
                    <span>Subtotal</span>
                    <span>${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Shipping</span>
                    <span>${{ number_format($order->shipping_cost, 2) }}</span>
                </div>
                <div class="border-t border-slate-200 pt-4 flex items-center justify-between font-semibold text-slate-900">
                    <span>Total</span>
                    <span>${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
            <div class="mt-6 space-y-3 text-sm text-slate-600">
                <p><span class="font-semibold text-slate-900">Shipping to:</span></p>
                <p>{{ $order->shipping_name }}</p>
                <p>{{ $order->shipping_address }}</p>
                <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}</p>
                <p>{{ $order->shipping_country }}</p>
            </div>
        </div>
    </div>
</div>
@endsection