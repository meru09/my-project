@extends('layouts.admin')

@section('content')
<div class="admin-page">
    <div class="admin-page__header">
        <div>
            <p class="admin-eyebrow">Dashboard</p>
            <h1 class="admin-h1">Store overview</h1>
        </div>
    </div>

    <section class="admin-grid admin-grid--4">
        <article class="admin-card admin-card--metric">
            <p class="admin-card__label">Today</p>
            <div class="admin-card__value">{{ $ordersToday }}</div>
            <div class="admin-card__meta">Orders placed today</div>
        </article>

        <article class="admin-card admin-card--metric">
            <p class="admin-card__label">This month</p>
            <div class="admin-card__value">{{ $ordersMonth }}</div>
            <div class="admin-card__meta">Orders this month</div>
        </article>

        <article class="admin-card admin-card--metric">
            <p class="admin-card__label">Low stock</p>
            <div class="admin-card__value">{{ $lowStockCount }}</div>
            <div class="admin-card__meta">Variants at risk</div>
        </article>

        <article class="admin-card admin-card--metric">
            <p class="admin-card__label">Revenue</p>
            <div class="admin-card__value">${{ number_format($revenue, 2) }}</div>
            <div class="admin-card__meta">Total sales</div>
        </article>
    </section>

    <section class="admin-grid admin-grid--2">
        <article class="admin-card">
            <h2 class="admin-h2">Recent orders</h2>
            <div class="admin-list">
                @foreach($orders as $order)
                    <a href="{{ route('admin.orders.show', $order) }}" class="admin-row">
                        <div class="admin-row__left">
                            <div class="admin-row__title">{{ $order->order_number }}</div>
                            <div class="admin-row__sub">{{ $order->created_at->format('M d, Y') }} — {{ $order->status }}</div>
                        </div>
                        <div class="admin-row__right">${{ number_format($order->total, 2) }}</div>
                    </a>
                @endforeach

                @if($orders->isEmpty())
                    <div class="admin-empty">No orders found.</div>
                @endif
            </div>
        </article>

        <article class="admin-card">
            <h2 class="admin-h2">Store overview</h2>
            <div class="admin-prose">
                <div class="admin-prose__item"><span class="admin-prose__k">Customers:</span> <span class="admin-prose__v">{{ $customers }}</span></div>
                <div class="admin-prose__item"><span class="admin-prose__k">Recent orders:</span> <span class="admin-prose__v">{{ $orders->count() }}</span></div>
                <div class="admin-prose__item"><span class="admin-prose__k">Quick actions:</span> <span class="admin-prose__v">Manage categories, products, and shipments from the sidebar.</span></div>
            </div>
        </article>
    </section>
</div>

@endsection