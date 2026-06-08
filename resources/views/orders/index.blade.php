@extends('layouts.shop')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-white p-8 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Your orders</p>
                <h1 class="text-3xl font-semibold text-slate-900">Order history</h1>
            </div>
            <a href="{{ route('home') }}" class="rounded-full border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-900 hover:bg-slate-50">Continue shopping</a>
        </div>
    </div>

    <div class="grid gap-6">
        @forelse($orders as $order)
            <a href="{{ route('orders.show', $order) }}" class="rounded-[2rem] bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-slate-300 border border-transparent">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Order #{{ $order->order_number }}</p>
                        <h2 class="mt-2 text-xl font-semibold text-slate-900">{{ $order->status }}</h2>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-slate-500">{{ $order->created_at->format('M d, Y') }}</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">${{ number_format($order->total, 2) }}</p>
                    </div>
                </div>
            </a>
        @empty
            <div class="rounded-[2rem] bg-white p-8 shadow-sm text-center text-slate-600">
                You have not placed any orders yet.
            </div>
        @endforelse
    </div>
</div>
@endsection