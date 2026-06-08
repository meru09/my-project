@extends('layouts.shop')

@section('content')
<div class="grid gap-8 lg:grid-cols-[1.4fr_0.6fr]">
    <div class="space-y-6">
        <div class="rounded-[2rem] bg-white p-8 shadow-sm">
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Secure checkout</p>
            <h1 class="mt-3 text-3xl font-semibold text-slate-900">Complete your order</h1>
            <p class="mt-4 text-slate-600">Fill in your shipping details and choose a payment option. Guest checkout is available for a fast, seamless experience.</p>
        </div>

        <div class="rounded-[2rem] bg-white p-8 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Shipping information</h2>
            @if($errors->any())
                <div class="alert" style="background:#F8D4DC;color:#7C2142;border-color:#F4C2CF;">
                    <ul class="list-disc ps-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('checkout.store') }}" method="POST" class="mt-6 space-y-6">
                @csrf
                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label class="text-sm font-semibold text-slate-900">Full name</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-900">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-900">Street address</label>
                    <input type="text" name="street_address" value="{{ old('street_address') }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                </div>
                <div class="grid gap-6 sm:grid-cols-3">
                    <div>
                        <label class="text-sm font-semibold text-slate-900">City</label>
                        <input type="text" name="city" value="{{ old('city') }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-900">State</label>
                        <input type="text" name="state" value="{{ old('state') }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-900">Postal code</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-900">Country</label>
                    <input type="text" name="country" value="{{ old('country') }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-900">Order notes</label>
                    <textarea name="notes" rows="4" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" placeholder="Add any delivery instructions or preferences.">{{ old('notes') }}</textarea>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-900">Payment method</label>
                    <select name="payment_method" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">
                        <option value="Cash On Delivery" {{ old('payment_method') === 'Cash On Delivery' ? 'selected' : '' }}>Cash On Delivery</option>
                        <option value="Bank Transfer" {{ old('payment_method') === 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    </select>
                </div>
                <button type="submit" class="rounded-full bg-slate-900 px-8 py-4 text-sm font-semibold text-white hover:bg-slate-800">Place order</button>
            </form>
        </div>
    </div>
    <aside class="space-y-6">
        <div class="rounded-[2rem] bg-white p-8 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Order summary</h2>
            <div class="mt-6 space-y-4 text-slate-700">
                <div class="flex items-center justify-between">
                    <span>Items total</span>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Shipping</span>
                    <span>${{ number_format($shippingCost, 2) }}</span>
                </div>
                <div class="border-t border-slate-200 pt-4 flex items-center justify-between text-lg font-semibold text-slate-900">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="rounded-[2rem] bg-slate-50 p-8 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Cart items</h2>
            <div class="mt-6 space-y-4">
                @foreach($cart as $item)
                    <div class="rounded-3xl border border-slate-200 p-4">
                        <p class="font-semibold text-slate-900">{{ $item['name'] }}</p>
                        <p class="text-sm text-slate-600">{{ $item['variant_name'] }} × {{ $item['quantity'] }}</p>
                        <p class="mt-2 text-slate-900">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </aside>
</div>
@endsection