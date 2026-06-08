@extends('layouts.shop')

@section('title', 'Login - ' . config('app.name'))

@section('content')
<section class="section auth-section">
    <div class="auth-grid">
        <div class="card">
            <p class="text-sm uppercase tracking-[0.32em] text-slate-500">Welcome back</p>
            <h1 class="section-title">Login to {{ config('app.name') }}</h1>
            <p class="mt-4 text-slate-600">Access your orders, saved favourites and fast checkout with your account.</p>
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-error">
                    <ul class="list-disc ps-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}" class="form mt-6">
                @csrf
                <div class="form-control">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="you@example.com" />
                </div>
                <div class="form-control">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
                </div>
                <div class="form-row">
                    <label class="checkbox-label">
                        <input id="remember_me" type="checkbox" name="remember" />
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link-muted">Forgot password?</a>
                    @endif
                </div>
                <button type="submit" class="btn-primary btn-full">Log in</button>
            </form>
        </div>
        <div class="auth-panel">
            <div class="auth-panel-inner">
                <h2 class="section-title">New to {{ config('app.name') }}?</h2>
                <p class="mt-3 text-slate-600">Create your account to save favourites, track orders, and receive exclusive beauty drops.</p>
                <a href="{{ route('register') }}" class="btn-outline" style="margin-top: 1.5rem; display: inline-block;">Create account</a>
            </div>
        </div>
    </div>
</section>
@endsection