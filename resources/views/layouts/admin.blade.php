<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-100 text-slate-900 font-sans">
    <div class="min-h-screen">
        <header class="bg-slate-950 text-slate-100 shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-4 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="text-xl font-semibold">Beauty Admin</a>
                    <p class="text-sm text-slate-400">Store management and analytics</p>
                </div>
                <nav class="flex flex-wrap items-center gap-3 text-sm text-slate-300">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-white">Dashboard</a>
                    <a href="{{ route('admin.categories.index') }}" class="hover:text-white">Categories</a>
                    <a href="{{ route('admin.products.index') }}" class="hover:text-white">Products</a>
                    <a href="{{ route('admin.orders.index') }}" class="hover:text-white">Orders</a>
                    <a href="{{ route('admin.customers.index') }}" class="hover:text-white">Customers</a>
                    <a href="{{ route('admin.settings.edit') }}" class="hover:text-white">Settings</a>
                </nav>
            </div>
        </header>
        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            @include('components.flash')
            @yield('content')
        </main>
    </div>
</body>
</html>
