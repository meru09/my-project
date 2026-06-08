@extends('layouts.shop')

@section('content')
<section class="section">
    <div class="section-header">
        <div>
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Shopping cart</p>
            <h1 class="section-title">Your selected products</h1>
        </div>
        <a href="{{ route('checkout.index') }}" class="btn-primary">Checkout</a>
    </div>

    @forelse($cart as $item)
        <article class="prod-card">
            <div class="prod-img bg1" style="min-height: 180px;">
                <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover rounded-[1.5rem]" />
            </div>
            <div class="prod-info">
                <div class="prod-brand">{{ $item['variant_name'] }}</div>
                <div class="prod-name">{{ $item['name'] }}</div>
                <div class="prod-bottom" style="margin-top: 1rem; gap: 1rem; flex-wrap: wrap;">
                    <div>
                        <span class="prod-price">${{ number_format($item['price'], 2) }}</span>
                        <span class="prod-old">x{{ $item['quantity'] }}</span>
                    </div>
                    <form action="{{ route('cart.remove', $item['variant_id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="prod-add">×</button>
                    </form>
                </div>
            </div>
        </article>
    @empty
        <div class="card text-center">
            <p class="text-slate-600">Your cart is empty. Start shopping beautiful skincare and cosmetics.</p>
        </div>
    @endforelse

    @if(count($cart))
        <div class="card" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem;">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Order summary</p>
                <p class="text-3xl font-semibold">${{ number_format($totals['total'], 2) }}</p>
            </div>
            <a href="{{ route('checkout.index') }}" class="btn-primary">Proceed to checkout</a>
        </div>
    @endif
</section>
@endsection
