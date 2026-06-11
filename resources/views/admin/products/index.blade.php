@extends('layouts.admin')

@section('content')
<div class="admin-page">
    <div class="admin-page__header">
        <div>
            <p class="admin-eyebrow">Products</p>
            <h1 class="admin-h1">Manage catalog</h1>
        </div>

        <a class="admin-btn admin-btn--ghost" href="{{ route('admin.products.create') }}">+ New product</a>
    </div>

    <div class="admin-card">
        <div class="admin-list">
            @forelse($products as $product)
                <div class="admin-row" style="align-items:center;">
                    <div class="admin-row__left" style="display:flex; align-items:center; gap:12px;">
                        <div style="width:38px; height:38px; border-radius:12px; overflow:hidden; border:1px solid rgba(2,6,23,0.08); flex:0 0 auto;">
                            <img src="{{ $product->images->first()?->url ?? 'https://via.placeholder.com/300' }}" alt="{{ $product->name }}" style="width:100%; height:100%; object-fit:cover;" loading="lazy" />
                        </div>
                        <div>
                            <div class="admin-row__title">{{ $product->name }}</div>
                            <div class="admin-row__sub">{{ $product->category->name }} · ${{ number_format($product->base_price, 2) }}</div>
                        </div>
                    </div>

                    <div style="display:flex; gap:10px; align-items:center;">
                        <a class="admin-btn admin-btn--ghost" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-btn" style="background: rgba(239,68,68,0.10); border-color: rgba(239,68,68,0.22); color:#991b1b;">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="admin-empty">No products have been added yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
