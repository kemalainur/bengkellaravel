<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AHASS Sinar Abadi Motor</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card animate-fadeInUp">
            <h2><i class="fas fa-motorcycle"></i> AHASS</h2>
            <p class="text-center text-muted" style="margin-bottom: 2rem;">Sinar Abadi Motor</p>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif
            
            <form action="{{ route('login.post') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <i class="fas fa-user form-icon"></i>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Pegawai" value="{{ old('nama') }}" required>
                </div>
                
                <div class="form-group">
                    <i class="fas fa-lock form-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="ID Pegawai" required>
                </div>
                
                <button type="submit" class="btn-primary login-btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>
