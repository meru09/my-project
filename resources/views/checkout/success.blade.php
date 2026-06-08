@extends('layouts.shop')

@section('content')
<div class="rounded-[2rem] bg-white p-10 shadow-sm">
    <div class="text-center">
        <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Order complete</p>
        <h1 class="mt-3 text-4xl font-semibold text-slate-900">Thank you for your purchase</h1>
        <p class="mt-4 text-slate-600">Your order has been placed successfully. We’ll send shipping updates shortly.</p>
    </div>

    <div class="mt-10 grid gap-8 lg:grid-cols-2">
        <div class="rounded-[2rem] bg-slate-50 p-8">
            <h2 class="text-xl font-semibold text-slate-900">Order details</h2>
            <div class="mt-6 space-y-4 text-slate-700">
                <div class="flex items-center justify-between">
                    <span>Order number</span>
                    <span class="font-semibold text-slate-900">{{ $order->order_number }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Status</span>
                    <span class="font-semibold text-slate-900">{{ $order->status }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Payment</span>
                    <span class="font-semibold text-slate-900">{{ $order->payment_method }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Total</span>
                    <span class="font-semibold text-slate-900">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>
        <div class="rounded-[2rem] bg-slate-50 p-8">
            <h2 class="text-xl font-semibold text-slate-900">Shipping address</h2>
            <div class="mt-6 space-y-2 text-slate-700">
                <p>{{ $order->shipping_name }}</p>
                <p>{{ $order->shipping_address }}</p>
                <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}</p>
                <p>{{ $order->shipping_country }}</p>
                <p>{{ $order->shipping_phone }}</p>
            </div>
        </div>
    </div>

    <div class="mt-10 text-center">
        <a href="{{ route('home') }}" class="inline-flex rounded-full bg-slate-900 px-8 py-4 text-sm font-semibold text-white hover:bg-slate-800">Continue shopping</a>
    </div>
</div>
@endsection