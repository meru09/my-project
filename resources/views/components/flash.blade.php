@if(session('success'))
    <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900 mb-6">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="rounded-3xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-900 mb-6">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="rounded-3xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-900 mb-6">
        <p class="font-semibold">Please fix the following errors:</p>
        <ul class="mt-2 list-disc ps-5 space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
