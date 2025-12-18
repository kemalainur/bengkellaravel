@php $prefix = $routePrefix ?? 'pelanggan'; @endphp
@extends($prefix === 'advisor.pelanggan' ? 'layouts.advisor' : 'layouts.app')

@section('title', 'Edit Pelanggan - AHASS')
@section('page-title', 'Edit Pelanggan')

@section('content')
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-edit"></i> Form Edit Pelanggan</h4>
    
    <form action="{{ route($prefix . '.update', $pelanggan->idpelanggan) }}" method="POST" class="form-container">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label">ID Pelanggan</label>
            <input type="text" class="form-control" value="{{ $pelanggan->idpelanggan }}" readonly>
        </div>
        
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" value="{{ old('nama', $pelanggan->nama) }}" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat" rows="3">{{ old('alamat', $pelanggan->alamat) }}</textarea>
        </div>
        
        <div class="form-actions">
            <a href="{{ route($prefix . '.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
