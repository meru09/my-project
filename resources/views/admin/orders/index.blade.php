@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Orders</p>
            <h1 class="text-3xl font-semibold text-slate-900">Order management</h1>
        </div>
    </div>

    <div class="rounded-[2rem] bg-white p-6 shadow-sm">
        <div class="grid gap-4">
            @forelse($orders as $order)
                <a href="{{ route('admin.orders.show', $order) }}" class="rounded-3xl border border-slate-200 p-4 transition hover:border-slate-300">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-lg font-semibold text-slate-900">{{ $order->order_number }}</p>
                            <p class="text-sm text-slate-500">Placed on {{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-slate-500">{{ $order->user?->name ?? 'Guest' }}</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">${{ number_format($order->total, 2) }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-slate-500">No orders have been placed yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection