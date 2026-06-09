@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-white p-8 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Order details</p>
                <h1 class="text-3xl font-semibold text-slate-900">{{ $order->order_number }}</h1>
            </div>
            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex flex-wrap gap-3">
                @csrf
                @method('PUT')
                <select name="status" class="rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">
                    @foreach(['Pending', 'Processing', 'Completed', 'Cancelled'] as $status)
                        <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800">Update status</button>
            </form>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-[2rem] bg-white p-8 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Customer</h2>
            <p class="mt-4 text-slate-600">{{ $order->user?->name ?? 'Guest' }}</p>
            <p class="text-sm text-slate-500">{{ $order->user?->email ?? 'No registered customer' }}</p>
        </div>
        <div class="rounded-[2rem] bg-white p-8 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Shipping</h2>
            <div class="mt-4 space-y-2 text-slate-600">
                <p>{{ $order->shipping_name }}</p>
                <p>{{ $order->shipping_address }}</p>
                <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}</p>
                <p>{{ $order->shipping_country }}</p>
                <p>{{ $order->shipping_phone }}</p>
            </div>
        </div>
    </div>

    <div class="rounded-[2rem] bg-white p-8 shadow-sm">
        <h2 class="text-xl font-semibold text-slate-900">Order items</h2>
        <div class="mt-6 space-y-4">
@foreach($order->items as $item)
                <div class="rounded-3xl border border-slate-200 p-4">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-[1.5rem] overflow-hidden border border-slate-200" aria-hidden="true">
                                <img src="{{ $item->variant?->product?->images->first()?->url ?? 'https://via.placeholder.com/300' }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover" loading="lazy" />
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">{{ $item->product_name }}</p>
                                <p class="mt-2 text-sm text-slate-600">{{ $item->variant_name }}</p>
                            </div>
                        </div>
                        <p class="text-slate-900">${{ number_format($item->subtotal, 2) }}</p>
                    </div>
                    <p class="mt-3 text-sm text-slate-500">Quantity: {{ $item->quantity }} · SKU: {{ $item->sku }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-6 border-t border-slate-200 pt-6 text-slate-700">
            <div class="flex items-center justify-between">
                <span>Subtotal</span>
                <span>${{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div class="flex items-center justify-between mt-3">
                <span>Shipping</span>
                <span>${{ number_format($order->shipping_cost, 2) }}</span>
            </div>
            <div class="flex items-center justify-between mt-4 text-lg font-semibold text-slate-900">
                <span>Total</span>
                <span>${{ number_format($order->total, 2) }}</span>
            </div>
        </div>
    </div>
</div>
@endsection