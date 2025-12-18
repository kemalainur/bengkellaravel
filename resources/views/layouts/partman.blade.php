<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AHASS Sinar Abadi Motor')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        .badge { padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 500; }
        .badge-warning { background: #f59e0b; color: #000; }
        .badge-info { background: #3b82f6; color: #fff; }
        .badge-success { background: #10b981; color: #fff; }
        .mt-4 { margin-top: 1.5rem; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-brand">
                <h4><i class="fas fa-motorcycle"></i> AHASS</h4>
                <small style="color: var(--accent-gold); font-size: 0.75rem;">Partman</small>
            </div>
            
            <div class="sidebar-menu">
                <a href="{{ route('partman.dashboard') }}" class="menu-item {{ request()->routeIs('partman.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('partman.item.index') }}" class="menu-item {{ request()->routeIs('partman.item.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span>Kelola Item</span>
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
                    <span>Selamat datang, <strong>{{ session('nama', 'Partman') }}</strong></span>
                    <span class="badge badge-info" style="margin-left: 10px;">Partman</span>
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
