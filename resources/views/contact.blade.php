@extends('layouts.shop')

@section('title', 'Contact - ' . config('app.name'))

@section('content')
<section class="section contact-section">
    <div class="text-center mb-4">
        <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Get in touch</p>
        <h1 class="section-title" style="font-size: 2.4rem;">We'd love to <span>hear from you</span></h1>
        <p class="mt-3 text-slate-600 max-w-xl mx-auto">Questions about an order, our products, or shipping? Send us a message and our {{ config('app.name') }} support team will respond within one business day.</p>
    </div>

    <div class="grid gap-8 lg:grid-cols-2 max-w-5xl mx-auto">
        <div class="contact-info-card">
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="space-y-8">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <span style="font-size: 1.5rem;">📧</span>
                        <h2 class="text-lg font-semibold" style="color: var(--text);">Customer support</h2>
                    </div>
                    <p class="text-slate-600">support@beautyglow.com</p>
                    <p class="text-slate-600">+1 (800) 555-0199</p>
                </div>
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <span style="font-size: 1.5rem;">🕐</span>
                        <h2 class="text-lg font-semibold" style="color: var(--text);">Store hours</h2>
                    </div>
                    <p class="text-slate-600">Monday – Friday: 9am – 6pm</p>
                    <p class="text-slate-600">Saturday: 10am – 4pm</p>
                    <p class="text-slate-600">Sunday: Closed</p>
                </div>
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <span style="font-size: 1.5rem;">📍</span>
                        <h2 class="text-lg font-semibold" style="color: var(--text);">Mailing address</h2>
                    </div>
                    <p class="text-slate-600">{{ config('app.name') }} HQ</p>
                    <p class="text-slate-600">123 Bloom Avenue, Suite 200</p>
                    <p class="text-slate-600">Los Angeles, CA 90017</p>
                </div>
            </div>
        </div>

        <div class="card">
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Send a message</p>
            <h2 class="section-title">We're here to help</h2>
            <form method="POST" action="{{ route('contact.store') }}" class="form mt-6">
                @csrf
                <div class="form-control">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="Your name" />
                    @error('name') <span class="text-sm" style="color: #E53E3E;">{{ $message }}</span> @enderror
                </div>
                <div class="form-control">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com" />
                    @error('email') <span class="text-sm" style="color: #E53E3E;">{{ $message }}</span> @enderror
                </div>
                <div class="form-control">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required placeholder="Tell us how we can help">{{ old('message') }}</textarea>
                    @error('message') <span class="text-sm" style="color: #E53E3E;">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn-primary btn-full">Submit request</button>
            </form>
        </div>
    </div>
</section>
@endsection