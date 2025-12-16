<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AHASS Sinar Abadi Motor')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-brand">
                <h4><i class="fas fa-motorcycle"></i> AHASS</h4>
            </div>
            
            <div class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('pelanggan.index') }}" class="menu-item {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Pelanggan</span>
                </a>
                <a href="{{ route('motor.index') }}" class="menu-item {{ request()->routeIs('motor.*') ? 'active' : '' }}">
                    <i class="fas fa-motorcycle"></i>
                    <span>Motor</span>
                </a>
                <a href="{{ route('item.index') }}" class="menu-item {{ request()->routeIs('item.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span>Item</span>
                </a>
                <a href="{{ route('transaksi.index') }}" class="menu-item {{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                    <i class="fas fa-receipt"></i>
                    <span>Transaksi</span>
                </a>
            </div>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-header">
                <h2>@yield('page-title')</h2>
                <div class="user-info">
                    <span>Selamat datang, <strong>{{ session('nama', 'Admin') }}</strong></span>
                </div>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif
            
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
