@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="grid gap-6 md:grid-cols-4">
        <div class="rounded-[2rem] bg-white p-6 shadow-sm">
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Today</p>
            <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $ordersToday }}</p>
            <p class="mt-2 text-sm text-slate-500">Orders placed today</p>
        </div>
        <div class="rounded-[2rem] bg-white p-6 shadow-sm">
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">This month</p>
            <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $ordersMonth }}</p>
            <p class="mt-2 text-sm text-slate-500">Orders this month</p>
        </div>
        <div class="rounded-[2rem] bg-white p-6 shadow-sm">
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Low stock</p>
            <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $lowStockCount }}</p>
            <p class="mt-2 text-sm text-slate-500">Variants at risk</p>
        </div>
        <div class="rounded-[2rem] bg-white p-6 shadow-sm">
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Revenue</p>
            <p class="mt-4 text-3xl font-semibold text-slate-900">${{ number_format($revenue, 2) }}</p>
            <p class="mt-2 text-sm text-slate-500">Total sales</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-[2rem] bg-white p-8 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Recent orders</h2>
            <div class="mt-6 space-y-4">
                @foreach($orders as $order)
                    <a href="{{ route('admin.orders.show', $order) }}" class="block rounded-3xl border border-slate-200 p-4 transition hover:border-slate-300">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-slate-900">{{ $order->order_number }}</span>
                            <span class="text-sm text-slate-500">${{ number_format($order->total, 2) }}</span>
                        </div>
                        <p class="mt-2 text-sm text-slate-600">{{ $order->created_at->format('M d, Y') }} — {{ $order->status }}</p>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="rounded-[2rem] bg-white p-8 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Store overview</h2>
            <div class="mt-6 space-y-4 text-slate-600">
                <p><span class="font-semibold text-slate-900">Customers:</span> {{ $customers }}</p>
                <p><span class="font-semibold text-slate-900">Recent orders:</span> {{ $orders->count() }}</p>
                <p><span class="font-semibold text-slate-900">Quick actions:</span> Manage categories, products, and shipments from the sidebar.</p>
            </div>
        </div>
    </div>
</div>
@endsection