<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="admin-body">

<div class="admin-shell">
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="admin-brand">
            <div class="admin-brand__logo">Beauty Admin</div>
            <div class="admin-brand__meta">Store management</div>
        </div>

        <button class="admin-sidebar__toggle" type="button" aria-label="Close sidebar" id="adminSidebarClose">✕</button>

        <nav class="admin-nav">
            <a class="admin-nav__link" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="admin-nav__link" href="{{ route('admin.categories.index') }}">Categories</a>
            <a class="admin-nav__link" href="{{ route('admin.products.index') }}">Products</a>
            <a class="admin-nav__link" href="{{ route('admin.orders.index') }}">Orders</a>
            <a class="admin-nav__link" href="{{ route('admin.customers.index') }}">Customers</a>
            <a class="admin-nav__link" href="{{ route('admin.settings.edit') }}">Settings</a>
        </nav>

        <div class="admin-sidebar__footer">
            <div class="admin-chip">v1</div>
            <div class="admin-hint">Admin UI refreshed</div>
        </div>
    </aside>

    <div class="admin-main">
        <header class="admin-topbar">
            <button class="admin-topbar__burger" type="button" aria-label="Open sidebar" id="adminSidebarOpen">☰</button>

            <div class="admin-topbar__title">
                <div class="admin-topbar__headline">Admin panel</div>
                <div class="admin-topbar__sub">Analytics, catalog & order management</div>
            </div>

            <div class="admin-topbar__actions">
                <a class="admin-btn admin-btn--ghost" href="{{ route('home') }}">View store</a>
            </div>
        </header>

        <main class="admin-content">
            @include('components.flash')
            @yield('content')
        </main>
    </div>
</div>

<script>
(function () {
    const sidebar = document.getElementById('adminSidebar');
    const openBtn = document.getElementById('adminSidebarOpen');
    const closeBtn = document.getElementById('adminSidebarClose');

    if (!sidebar || !openBtn || !closeBtn) return;

    function openSidebar() {
        sidebar.classList.add('is-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('is-open');
    }

    openBtn.addEventListener('click', openSidebar);
    closeBtn.addEventListener('click', closeSidebar);

    // Close on outside click (mobile)
    document.addEventListener('click', function (e) {
        const target = e.target;
        const isSidebar = sidebar.contains(target);
        const clickedBurger = target === openBtn;
        if (!isSidebar && !clickedBurger) closeSidebar();
    });
})();
</script>
</body>
</html>

