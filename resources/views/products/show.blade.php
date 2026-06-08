@extends('layouts.shop')

@section('content')
<section class="section">
    <div class="grid gap-8 xl:grid-cols-[1.3fr_0.7fr]">
        <div class="space-y-8">
            <div class="card">
                <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
                    <div>
                        <img src="{{ $product->images->first()?->url ?? 'https://via.placeholder.com/700' }}" alt="{{ $product->name }}" class="w-full rounded-[2rem] object-cover" style="height: 420px;" />
                    </div>
                    <div class="space-y-6">
                        <p class="text-sm uppercase tracking-[0.32em] text-slate-500">{{ $product->category->name }}</p>
                        <h1 class="section-title">{{ $product->name }}</h1>
                        <p class="text-slate-600">{{ $product->short_description }}</p>
                        <div class="card" style="background: var(--warm);">
                            <div class="flex items-center justify-between text-slate-900">
                                <span class="text-3xl font-semibold">${{ number_format($product->base_price, 2) }}</span>
                                <span class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900">{{ $product->variants->count() }} variants</span>
                            </div>
                            <div class="mt-4 space-y-3">
                                @foreach($product->variants as $variant)
                                    <div class="rounded-3xl border border-slate-200 p-4" style="background: white;">
                                        <h3 class="font-semibold text-slate-900">{{ $variant->name }}</h3>
                                        <p class="mt-1 text-sm text-slate-600">Price: ${{ number_format($variant->price, 2) }} · Stock: {{ $variant->stock }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="card">
                    <h2 class="section-title">Ingredients</h2>
                    <ul class="mt-4 space-y-2 text-slate-600 list-disc ps-5">
                        @foreach($product->ingredients ?? [] as $ingredient)
                            <li>{{ $ingredient }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="card">
                    <h2 class="section-title">Benefits</h2>
                    <ul class="mt-4 space-y-2 text-slate-600 list-disc ps-5">
                        @foreach($product->benefits ?? [] as $benefit)
                            <li>{{ $benefit }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card">
                <h2 class="section-title">Description</h2>
                <p class="mt-4 text-slate-600">{{ $product->description }}</p>
            </div>

            <div class="card">
                <h2 class="section-title">Reviews</h2>
                <div class="mt-4 space-y-4">
                    @forelse($product->reviews as $review)
                        <div class="rounded-3xl border border-slate-200 p-4">
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-slate-900">{{ $review->user?->name ?? 'Guest' }}</p>
                                <span class="text-sm text-slate-600">{{ $review->rating }}/5</span>
                            </div>
                            <p class="mt-2 text-slate-600">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <p class="text-slate-500">No reviews yet.</p>
                    @endforelse
                </div>
                <form action="{{ route('products.reviews.store', $product) }}" method="POST" class="mt-6 space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-semibold text-slate-900">Rating</label>
                        <select name="rating" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-900">Comment</label>
                        <textarea name="comment" rows="4" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" placeholder="Share your experience"></textarea>
                    </div>
                    <button type="submit" class="rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800">Submit Review</button>
                </form>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="card">
                <h2 class="section-title">Buy now</h2>
                <p class="mt-3 text-slate-600">Choose the variant and add your favourite product to the cart.</p>
                <form action="{{ route('cart.add') }}" method="POST" class="space-y-4 mt-6">
                    @csrf
                    <div>
                        <label class="text-sm font-semibold text-slate-900">Variant</label>
                        <select name="variant_id" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">
                            @foreach($product->variants as $variant)
                                <option value="{{ $variant->id }}">{{ $variant->name }} — ${{ number_format($variant->price, 2) }} ({{ $variant->stock }} in stock)</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-900">Quantity</label>
                        <input name="quantity" type="number" value="1" min="1" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                    </div>
                    <button type="submit" class="w-full rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800">Add to Cart</button>
                </form>
            </div>

            <div class="card">
                <h2 class="section-title">Related products</h2>
                <div class="mt-4 space-y-4">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('products.show', $related) }}" class="block rounded-3xl border border-slate-200 p-4 transition hover:border-slate-300">
                            <h3 class="font-semibold text-slate-900">{{ $related->name }}</h3>
                            <p class="mt-2 text-sm text-slate-600">${{ number_format($related->base_price, 2) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</section>
@endsection
