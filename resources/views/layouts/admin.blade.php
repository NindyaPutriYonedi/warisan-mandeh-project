<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Warisan Mandeh</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">

<div class="admin-wrapper d-flex">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h4 class="brand">Warisan Mandeh</h4>

        <nav class="menu">
    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-house"></i> Dashboard
    </a>

    <a href="{{ route('admin.products.index') }}"
       class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
        <i class="bi bi-box"></i> Produk
    </a>

    <a href="{{ route('admin.orders.index') }}"
       class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
        <i class="bi bi-cart"></i> Order
    </a>

    <a href="{{ route('admin.reviews.index') }}"
       class="{{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
        <i class="bi bi-chat"></i> Review
    </a>
</nav>


        <form action="{{ route('admin.logout') }}" method="POST" class="logout">
            @csrf
            <button type="submit">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="content flex-fill">
        @yield('content')
    </main>

</div>

</body>
</html>
