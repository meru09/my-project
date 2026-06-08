@extends('layouts.shop')

@section('title', 'Register - ' . config('app.name'))

@section('content')
<section class="section auth-section">
    <div class="auth-grid">
        <div class="card">
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Create account</p>
            <h1 class="section-title">Join {{ config('app.name') }}</h1>
            <p class="mt-4 text-slate-600">Register and enjoy personalized recommendations, saved favorites, and order tracking.</p>
            @if($errors->any())
                <div class="alert alert-error">
                    <ul class="list-disc ps-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}" class="form mt-6">
                @csrf
                <div class="form-control">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Your full name" />
                </div>
                <div class="form-control">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="you@example.com" />
                </div>
                <div class="form-control">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Create a password" />
                </div>
                <div class="form-control">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" />
                </div>
                <button type="submit" class="btn-primary btn-full">Register</button>
                <p class="text-sm text-center text-slate-500 mt-4">
                    By registering, you agree to our <a href="#" class="link-muted">Terms of Service</a> and <a href="#" class="link-muted">Privacy Policy</a>.
                </p>
            </form>
        </div>
        <div class="auth-panel">
            <div class="auth-panel-inner">
                <h2 class="section-title">Already have an account?</h2>
                <p class="mt-3 text-slate-600">Log in to manage your orders, reorder favourites, and explore new beauty launches.</p>
                <a href="{{ route('login') }}" class="btn-outline" style="margin-top: 1.5rem; display: inline-block;">Login now</a>
            </div>
        </div>
    </div>
</section>
@endsection