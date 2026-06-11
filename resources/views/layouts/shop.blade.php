<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BeautyGlow - Premium beauty & cosmetics e-commerce platform">
    <meta property="og:title" content="BeautyGlow - Premium Beauty & Cosmetics">
    <meta property="og:description" content="Premium beauty and cosmetics, curated with love.">
    <meta property="og:type" content="website">
    <link rel="canonical" href="{{ config('app.url') }}">
    <title>@yield('title', config('app.name')) - Premium Beauty & Cosmetics</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="wrap">
        <nav>
            <div class="logo">{{ config('app.name') }}</div>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('categories.index') }}">Categories</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('cart.index') }}">Cart</a></li>
                @auth
                    <li><a href="{{ route('orders.index') }}">Orders</a></li>
                @endauth
            </ul>
            <div class="nav-right">
                @guest
                    <a href="{{ route('login') }}" class="nav-action">Login</a>
                    <a href="{{ route('register') }}" class="nav-action">Register</a>
                @else
                    <a href="{{ route('profile.edit') }}" class="nav-action">Profile</a>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="nav-action" style="background: var(--mauve); color: white;">Admin Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="nav-action" style="background: none; border: none; font-family: inherit; cursor: pointer;">Logout</button>
                    </form>
                @endguest

            </div>
        </nav>

        <main>
            @include('components.flash')
            @yield('content')
        </main>

        <footer>
            <div class="footer-brand">
                <div class="logo">{{ config('app.name') }}</div>
                <p>Premium beauty & cosmetics, curated with love. Free shipping on orders over $45.</p>
            </div>
            <div class="footer-col">
                <h4>SHOP</h4>
                <a href="{{ route('categories.show', App\Models\Category::where('slug', 'skin-care')->first() ?? '#') }}">Skin Care</a>
                <a href="{{ route('categories.show', App\Models\Category::where('slug', 'hair-care')->first() ?? '#') }}">Hair Care</a>
                <a href="{{ route('categories.show', App\Models\Category::where('slug', 'makeup')->first() ?? '#') }}">Makeup</a>
                <a href="{{ route('categories.index') }}">All Categories</a>
            </div>
            <div class="footer-col">
                <h4>HELP</h4>
                <a href="{{ route('profile.edit') }}">My Account</a>
                <a href="{{ route('orders.index') }}">Order Tracking</a>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
        </footer>
        <div class="footer-bottom">© {{ date('Y') }} {{ config('app.name') }} · All rights reserved · Made with ♡</div>
    </div>

    @if(session('error'))
    <div class="toast toast-error" id="toast">{{ session('error') }} <button onclick="this.parentElement.remove()" style="background:none;border:none;color:inherit;margin-left:0.75rem;font-size:1.1rem;cursor:pointer;">&times;</button></div>
    @endif
    @if(session('success'))
    <div class="toast toast-success" id="toast">{{ session('success') }} <button onclick="this.parentElement.remove()" style="background:none;border:none;color:inherit;margin-left:0.75rem;font-size:1.1rem;cursor:pointer;">&times;</button></div>
    @endif

    <script>
    document.addEventListener('DOMContentLoaded', function(){
        var t = document.getElementById('toast');
        if(t) { setTimeout(function(){ t.style.opacity = '0'; t.style.transform = 'translateY(-20px)'; setTimeout(function(){ t.remove(); }, 300); }, 5000); }
    });
    </script>
</body>
</html>