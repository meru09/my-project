@extends('layouts.shop')

@section('content')
<section class="section">
    <div class="section-header">
        <div>
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Collections</p>
            <h1 class="section-title">Explore beauty categories</h1>
        </div>
    </div>

    <div class="cat-grid">
        @foreach($categories as $index => $category)
            @php
                $type = ['skincare','haircare','makeup'][$index % 3];
            @endphp
            <a href="{{ route('categories.show', $category) }}" class="cat-card {{ $type }}">
                <span class="cat-emoji">🌸</span>
                <div class="cat-label">COLLECTION</div>
                <div class="cat-name">{{ $category->name }}</div>
                <div class="cat-count">{{ $category->products()->count() }} products</div>
            </a>
        @endforeach
    </div>
</section>
@endsection
