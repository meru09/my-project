@extends('layouts.shop')

@section('content')
<section class="section">
    <div class="section-header">
        <div>
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">{{ $category->name }}</p>
            <h1 class="section-title">{{ $category->name }} essentials</h1>
            <p class="mt-2 text-slate-600">{{ $category->description ?? 'Beauty products tailored for your routine.' }}</p>
        </div>
        <a href="{{ route('categories.index') }}" class="btn-outline">Back to categories</a>
    </div>

    <div class="products-grid">
        @foreach($category->products as $product)
            <article class="prod-card">
                <div class="prod-img bg2">
                    <img src="{{ $product->images->first()?->url ?? 'https://via.placeholder.com/500' }}" alt="{{ $product->name }}" class="h-full w-full object-cover rounded-[1.5rem]" />
                </div>
                <div class="prod-info">
                    <div class="prod-brand">{{ $product->category->name }}</div>
                    <div class="prod-name">{{ $product->name }}</div>
                    <div class="prod-stars">★★★★★ <span>({{ $product->reviews()->count() }})</span></div>
                    <div class="prod-bottom">
                        <span class="prod-price">${{ number_format($product->base_price, 2) }}</span>
                        <a href="{{ route('products.show', $product) }}" class="btn-outline">View</a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endsection
