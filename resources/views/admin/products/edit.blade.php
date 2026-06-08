@extends('layouts.admin')

@section('content')
<div class="rounded-[2rem] bg-white p-8 shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Edit product</p>
            <h1 class="text-3xl font-semibold text-slate-900">Update product details</h1>
        </div>
        <a href="{{ route('admin.products.index') }}" class="rounded-full border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-900 hover:bg-slate-50">Back</a>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid gap-6 lg:grid-cols-2">
            <div>
                <label class="text-sm font-semibold text-slate-900">Category</label>
                <select name="category_id" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-900">Price</label>
                <input type="number" step="0.01" name="base_price" value="{{ old('base_price', $product->base_price) }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-900">Product name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-900">Short description</label>
                <input type="text" name="short_description" value="{{ old('short_description', $product->short_description) }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
            </div>
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-900">Description</label>
            <textarea name="description" rows="4" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div>
                <label class="text-sm font-semibold text-slate-900">Ingredients</label>
                <textarea name="ingredients" rows="4" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" placeholder="One ingredient per line">{{ old('ingredients', implode("\n", $product->ingredients ?? [])) }}</textarea>
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-900">Benefits</label>
                <textarea name="benefits" rows="4" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" placeholder="One benefit per line">{{ old('benefits', implode("\n", $product->benefits ?? [])) }}</textarea>
            </div>
        </div>

        <div class="space-y-4">
            <h2 class="text-xl font-semibold text-slate-900">Variants</h2>
            @foreach($product->variants as $index => $variant)
                <div class="rounded-3xl border border-slate-200 p-4">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="text-sm font-semibold text-slate-900">Variant name</label>
                            <input type="text" name="variants[{{ $index }}][name]" value="{{ old('variants.'.$index.'.name', $variant->name) }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-900">SKU</label>
                            <input type="text" name="variants[{{ $index }}][sku]" value="{{ old('variants.'.$index.'.sku', $variant->sku) }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-3 mt-4">
                        <div>
                            <label class="text-sm font-semibold text-slate-900">Price</label>
                            <input type="number" step="0.01" name="variants[{{ $index }}][price]" value="{{ old('variants.'.$index.'.price', $variant->price) }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-900">Stock</label>
                            <input type="number" name="variants[{{ $index }}][stock]" value="{{ old('variants.'.$index.'.stock', $variant->stock) }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-900">Shade</label>
                            <input type="text" name="variants[{{ $index }}][shade]" value="{{ old('variants.'.$index.'.shade', $variant->shade) }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex flex-wrap gap-4">
            <label class="inline-flex items-center gap-3 rounded-full border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900">
                <input type="checkbox" name="featured" value="1" {{ $product->featured ? 'checked' : '' }} class="h-5 w-5 rounded-full border-slate-300 bg-white" />
                Featured product
            </label>
            <label class="inline-flex items-center gap-3 rounded-full border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900">
                <input type="checkbox" name="active" value="1" {{ $product->active ? 'checked' : '' }} class="h-5 w-5 rounded-full border-slate-300 bg-white" />
                Active listing
            </label>
        </div>

        <button type="submit" class="rounded-full bg-slate-900 px-8 py-4 text-sm font-semibold text-white hover:bg-slate-800">Update product</button>
    </form>
</div>
@endsection