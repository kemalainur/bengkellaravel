<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AHASS - Cek Status Servis')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        .badge { padding: 8px 16px; border-radius: 20px; font-size: 0.9rem; font-weight: 500; }
        .badge-warning { background: #f59e0b; color: #000; }
        .badge-info { background: #3b82f6; color: #fff; }
        .badge-success { background: #10b981; color: #fff; }
        .mt-4 { margin-top: 1.5rem; }
        .customer-header {
            background: linear-gradient(135deg, var(--bg-card) 0%, var(--bg-input) 100%);
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }
        .status-timeline {
            display: flex;
            justify-content: space-between;
            padding: 2rem 0;
            position: relative;
        }
        .status-timeline::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--border-color);
            z-index: 0;
        }
        .status-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 1;
            background: var(--bg-main);
            padding: 0 1rem;
        }
        .status-step .icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #666;
            margin-bottom: 0.5rem;
        }
        .status-step.active .icon {
            background: var(--accent-gold);
            color: #000;
        }
        .status-step.completed .icon {
            background: #10b981;
            color: #fff;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="dashboard-wrapper" style="grid-template-columns: 1fr;">
        <!-- Main Content -->
        <main class="main-content" style="margin-left: 0; max-width: 1200px; margin: 0 auto; padding: 2rem;">
            <div class="customer-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h2 style="margin: 0; color: var(--accent-gold);"><i class="fas fa-motorcycle"></i> AHASS Sinar Abadi Motor</h2>
                        <p style="margin: 0.5rem 0 0 0; color: #a0aec0;">Cek Status Servis Motor Anda</p>
                    </div>
                    <div style="text-align: right;">
                        <p style="margin: 0; color: #a0aec0;">Selamat datang,</p>
                        <h4 style="margin: 0; color: #fff;">{{ session('customer_nama') }}</h4>
                        <form action="{{ route('customer.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-secondary btn-sm" style="margin-top: 0.5rem;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
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
