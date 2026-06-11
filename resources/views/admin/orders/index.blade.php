@extends('layouts.admin')

@section('content')
<div class="admin-page">
    <div class="admin-page__header">
        <div>
            <p class="admin-eyebrow">Orders</p>
            <h1 class="admin-h1">Order management</h1>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-list">
            @forelse($orders as $order)
                <a href="{{ route('admin.orders.show', $order) }}" class="admin-row">
                    <div class="admin-row__left">
                        <div class="admin-row__title">{{ $order->order_number }}</div>
                        <div class="admin-row__sub">{{ $order->created_at->format('M d, Y') }} · {{ $order->status }}</div>
                    </div>
                    <div class="admin-row__right">${{ number_format($order->total, 2) }}</div>
                </a>
            @empty
                <div class="admin-empty">No orders have been placed yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
