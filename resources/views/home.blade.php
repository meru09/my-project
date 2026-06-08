@extends('layouts.shop')

@section('title', config('app.name'))

@section('content')
<div class="hero">
    <div class="hero-text">
        <div class="hero-badge">✦ K-Beauty Curated Collection</div>
        <h1>Glow from<br><em>the inside</em> out</h1>
        <p>Premium Korean beauty rituals, curated for your glow-up routine. Discover serums, masks, and rituals that nurture luminous skin.</p>
        <div class="hero-btns">
            <a href="{{ route('categories.index') }}" class="btn-primary">Shop now ↗</a>
            <a href="{{ route('categories.index') }}" class="btn-outline">Explore categories</a>
        </div>
    </div>

    <div class="hero-visual hero-photo">
        <div class="hero-photo-card">
            <div class="photo-label">BeautyGlow Studio</div>
            <div class="photo-frame">
                <div class="photo-swatch">
                    <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=800&q=80" alt="BeautyGlow beauty products collection" style="width:100%;height:100%;object-fit:cover;border-radius:28px;" loading="lazy">
                </div>
            </div>
            <div class="photo-caption">Premium skincare and beauty essentials designed to brighten, soothe, and restore.</div>
        </div>
    </div>
</div>

<div class="category-links">
    @foreach($categories as $category)
        <a href="{{ route('categories.show', $category) }}" class="cat-link">{{ $category->name }}</a>
    @endforeach
</div>

<div class="trust">
    <div class="trust-item"><span>🚚</span> Free shipping over $45</div>
    <div class="trust-item"><span>🐰</span> 100% cruelty-free</div>
    <div class="trust-item"><span>↻</span> 30-day easy returns</div>
    <div class="trust-item"><span>🔒</span> Authentic products only</div>
</div>

<section class="section">
    <div class="section-header">
        <h2 class="section-title">Shop by <span>category</span></h2>
        <a href="{{ route('categories.index') }}" class="see-all">View all →</a>
    </div>

    <div class="cat-grid">
        @php
            $categoryClasses = ['skincare', 'haircare', 'makeup'];
            $categoryEmojis = ['🌸', '💇‍♀️', '💄'];
        @endphp
        @foreach($categories->take(3) as $index => $category)
            <a href="{{ route('categories.show', $category) }}" class="cat-card {{ $categoryClasses[$index] ?? 'skincare' }}">
                <span class="cat-emoji">{{ $categoryEmojis[$index] ?? '🌸' }}</span>
                <div class="cat-label">COLLECTION</div>
                <div class="cat-name">{{ $category->name }}</div>
                <div class="cat-count">{{ $category->products()->count() }} products</div>
            </a>
        @endforeach
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="section-header">
        <h2 class="section-title">Trending <span>right now</span></h2>
        <a href="{{ route('categories.index') }}" class="see-all">See all products →</a>
    </div>

    <div class="products-grid">
        @forelse($featuredProducts->take(8) as $product)
            <article class="prod-card">
                <div class="prod-img bg1">
                    <span class="prod-badge badge-new">NEW</span>
                    <span class="prod-emoji">✨</span>
                    <div class="prod-wish">♥</div>
                </div>
                <div class="prod-info">
                    <div class="prod-brand">{{ $product->category->name ?? config('app.name') }}</div>
                    <div class="prod-name">{{ $product->name }}</div>
                    <div class="prod-stars">★★★★★ <span>({{ $product->reviews()->count() }})</span></div>
                    <div class="prod-bottom">
                        <div><span class="prod-price">${{ number_format($product->base_price, 2) }}</span></div>
                        <a href="{{ route('products.show', $product) }}" class="prod-add">+</a>
                    </div>
                </div>
            </article>
        @empty
            <p class="text-slate-600">No featured products yet. Run the seeder to add products.</p>
        @endforelse
    </div>
</section>

<section class="banner">
    <div class="banner-text">
        <h2>Your skin deserves<br>the very best</h2>
        <p>Join 120,000+ beauty lovers. Get early access to new launches, exclusive discounts, and personalized routines.</p>
        <button class="btn-light">Join Petal Club ↗</button>
    </div>
    <div class="banner-nums">
        <div class="banner-num">
            <h3>120K+</h3>
            <p>MEMBERS</p>
        </div>
        <div class="banner-num">
            <h3>438</h3>
            <p>BRANDS</p>
        </div>
        <div class="banner-num">
            <h3>4.9★</h3>
            <p>RATING</p>
        </div>
    </div>
</section>

<section class="bs-strip">
    <div class="section-header" style="margin-top:2rem">
        <h2 class="section-title">Quick <span>picks</span></h2>
    </div>
    <div class="bs-grid">
        <div class="bs-item">
            <div class="bs-circle c1">🌸</div>
            <div class="bs-name">Glow Serum</div>
            <div class="bs-price">$34</div>
        </div>
        <div class="bs-item">
            <div class="bs-circle c2">💜</div>
            <div class="bs-name">Lavender Mask</div>
            <div class="bs-price">$18</div>
        </div>
        <div class="bs-item">
            <div class="bs-circle c3">🍵</div>
            <div class="bs-name">Green Tea Foam</div>
            <div class="bs-price">$15</div>
        </div>
        <div class="bs-item">
            <div class="bs-circle c4">🍯</div>
            <div class="bs-name">Honey Balm</div>
            <div class="bs-price">$22</div>
        </div>
        <div class="bs-item">
            <div class="bs-circle c5">💧</div>
            <div class="bs-name">Hyaluronic Ampoule</div>
            <div class="bs-price">$41</div>
        </div>
    </div>
</section>

<section class="test-section">
    <div class="section-header">
        <h2 class="section-title">What our <span>community</span> says</h2>
    </div>
    <div class="test-grid">
        <div class="test-card">
            <div class="test-top">
                <div class="test-avatar">Y</div>
                <div>
                    <div class="test-name">Yuna K.</div>
                    <div class="test-stars">★★★★★</div>
                </div>
            </div>
            <div class="test-txt">"I've been using the snail essence for 3 weeks and my skin texture has completely transformed. Glass skin is real!"</div>
            <div class="test-prod">→ COSRX Snail Mucin Essence</div>
        </div>
        <div class="test-card">
            <div class="test-top">
                <div class="test-avatar" style="background:#EDE8FC;color:#8B78C8">M</div>
                <div>
                    <div class="test-name">Mia Chen</div>
                    <div class="test-stars">★★★★★</div>
                </div>
            </div>
            <div class="test-txt">"Finally found a toner that doesn't irritate my sensitive skin. The blueberry line is everything!"</div>
            <div class="test-prod">→ Innisfree Blueberry Toner</div>
        </div>
        <div class="test-card">
            <div class="test-top">
                <div class="test-avatar" style="background:#E8F8EC;color:#5A9A6A">S</div>
                <div>
                    <div class="test-name">Selin A.</div>
                    <div class="test-stars">★★★★★</div>
                </div>
            </div>
            <div class="test-txt">"Super fast delivery, packaging is gorgeous, and the products are 100% authentic. My go-to K-beauty shop!"</div>
            <div class="test-prod">→ BeautyGlow Experience</div>
        </div>
    </div>
</section>
@endsection