<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan - AHASS Sinar Abadi Motor</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card animate-fadeInUp">
            <h2><i class="fas fa-motorcycle"></i> AHASS</h2>
            <p class="text-center text-muted" style="margin-bottom: 0.5rem;">Sinar Abadi Motor</p>
            <p class="text-center" style="margin-bottom: 2rem; color: var(--accent-gold); font-size: 0.9rem;">
                <i class="fas fa-search"></i> Cek Status Servis
            </p>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif
            
            <form action="{{ route('customer.login.post') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <i class="fas fa-user form-icon"></i>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Pelanggan" value="{{ old('nama') }}" required>
                </div>
                
                <div class="form-group">
                    <i class="fas fa-motorcycle form-icon"></i>
                    <input type="text" name="nopolisi" class="form-control" placeholder="No Polisi Motor (contoh: B1234XYZ)" value="{{ old('nopolisi') }}" required style="text-transform: uppercase;">
                </div>
                
                <button type="submit" class="btn-primary login-btn">
                    <i class="fas fa-search"></i> Cek Status Servis
                </button>
            </form>
            
            <hr style="border-color: var(--border-color); margin: 2rem 0;">
            
            <p class="text-center" style="color: #a0aec0; font-size: 0.875rem;">
                Untuk pegawai, <a href="{{ route('login') }}" style="color: var(--accent-gold);">login disini</a>
            </p>
        </div>
    </div>
</body>
</html>
