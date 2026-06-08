@extends('layouts.admin')

@section('content')
<div class="rounded-[2rem] bg-white p-8 shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Settings</p>
            <h1 class="text-3xl font-semibold text-slate-900">Shipping and store settings</h1>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="text-sm font-semibold text-slate-900">Default shipping cost</label>
            <input type="text" name="shipping_cost" value="{{ old('shipping_cost', $shipping_cost) }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
        </div>
        <button type="submit" class="rounded-full bg-slate-900 px-8 py-4 text-sm font-semibold text-white hover:bg-slate-800">Save settings</button>
    </form>
</div>
@endsection