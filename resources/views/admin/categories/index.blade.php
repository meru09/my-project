@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Categories</p>
            <h1 class="text-3xl font-semibold text-slate-900">Manage product categories</h1>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800">New category</a>
    </div>

    <div class="rounded-[2rem] bg-white p-6 shadow-sm">
        <div class="grid gap-4">
            @forelse($categories as $category)
                <div class="flex flex-col gap-4 rounded-3xl border border-slate-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-lg font-semibold text-slate-900">{{ $category->name }}</p>
                        <p class="text-sm text-slate-500">{{ $category->description }}</p>
                    </div>
                    <div class="flex flex-wrap gap-3 text-sm">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-full border border-slate-300 px-4 py-2 text-slate-900 hover:bg-slate-50">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-full bg-rose-500 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-600">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-slate-500">No categories created yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
