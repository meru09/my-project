@extends('layouts.admin')

@section('content')
<div class="rounded-[2rem] bg-white p-8 shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">New category</p>
            <h1 class="text-3xl font-semibold text-slate-900">Add a new category</h1>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="rounded-full border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-900 hover:bg-slate-50">Back</a>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="text-sm font-semibold text-slate-900">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-900">Description</label>
            <textarea name="description" rows="4" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="rounded-full bg-slate-900 px-8 py-4 text-sm font-semibold text-white hover:bg-slate-800">Save category</button>
    </form>
</div>
@endsection