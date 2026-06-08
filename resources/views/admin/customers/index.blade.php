@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-white p-8 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Customers</p>
                <h1 class="text-3xl font-semibold text-slate-900">Customer records</h1>
            </div>
        </div>
    </div>

    <div class="rounded-[2rem] bg-white p-6 shadow-sm">
        <div class="grid gap-4">
            @forelse($customers as $customer)
                <a href="{{ route('admin.customers.show', $customer) }}" class="rounded-3xl border border-slate-200 p-4 transition hover:border-slate-300">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-lg font-semibold text-slate-900">{{ $customer->name }}</p>
                            <p class="text-sm text-slate-500">{{ $customer->email }}</p>
                        </div>
                        <p class="text-sm text-slate-500">Joined {{ $customer->created_at->format('M d, Y') }}</p>
                    </div>
                </a>
            @empty
                <p class="text-slate-500">No customer accounts found.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection