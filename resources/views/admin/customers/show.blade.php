@extends('layouts.admin')

@section('content')
<div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
    <div class="rounded-[2rem] bg-white p-8 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Customer profile</p>
                <h1 class="text-3xl font-semibold text-slate-900">{{ $customer->name }}</h1>
            </div>
            <p class="text-sm text-slate-500">{{ $customer->email }}</p>
        </div>

        <div class="space-y-4 text-slate-700">
            <p><span class="font-semibold text-slate-900">Joined:</span> {{ $customer->created_at->format('M d, Y') }}</p>
            <p><span class="font-semibold text-slate-900">Orders:</span> {{ $orders->count() }}</p>
        </div>
    </div>

    <div class="rounded-[2rem] bg-white p-8 shadow-sm">
        <h2 class="text-xl font-semibold text-slate-900">Recent orders</h2>
        <div class="mt-6 space-y-4">
            @forelse($orders as $order)
                <a href="{{ route('admin.orders.show', $order) }}" class="block rounded-3xl border border-slate-200 p-4 transition hover:border-slate-300">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-slate-900">{{ $order->order_number }}</p>
                        <p class="text-sm text-slate-500">${{ number_format($order->total, 2) }}</p>
                    </div>
                    <p class="mt-2 text-sm text-slate-500">{{ $order->created_at->format('M d, Y') }} · {{ $order->status }}</p>
                </a>
            @empty
                <p class="text-slate-500">No orders placed yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection