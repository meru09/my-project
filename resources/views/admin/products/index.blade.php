@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Products</p>
            <h1 class="text-3xl font-semibold text-slate-900">Manage your catalog</h1>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800">New product</a>
    </div>

    <div class="rounded-[2rem] bg-white p-6 shadow-sm">
        <div class="grid gap-4">
            @forelse($products as $product)
<div class="rounded-3xl border border-slate-200 p-4 sm:flex sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-[1.5rem] overflow-hidden border border-slate-200" aria-hidden="true">
                            <img src="{{ $product->images->first()?->url ?? 'https://via.placeholder.com/300' }}" alt="{{ $product->name }}" class="w-full h-full object-cover" loading="lazy" />
                        </div>
                        <div class="space-y-2">
                            <p class="text-lg font-semibold text-slate-900">{{ $product->name }}</p>
                            <p class="text-sm text-slate-500">{{ $product->category->name }} · ${{ number_format($product->base_price, 2) }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3 text-sm">
                        <a href="{{ route('admin.products.edit', $product) }}" class="rounded-full border border-slate-300 px-4 py-2 text-slate-900 hover:bg-slate-50">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-full bg-rose-500 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-600">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-slate-500">No products have been added yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection