@extends('layouts.app')

@section('title', 'Tambah Pelanggan - AHASS')
@section('page-title', 'Tambah Pelanggan')

@section('content')
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-plus"></i> Form Tambah Pelanggan</h4>
    
    <form action="{{ route('pelanggan.store') }}" method="POST" class="form-container">
        @csrf
        <div class="form-group">
            <label class="form-label">ID Pelanggan</label>
            <input type="text" name="idpelanggan" class="form-control" placeholder="Masukkan ID Pelanggan" value="{{ old('idpelanggan') }}" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" value="{{ old('nama') }}" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat" rows="3">{{ old('alamat') }}</textarea>
        </div>
        
        <div class="form-actions">
            <a href="{{ route('pelanggan.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
