@extends('layouts.app')

@section('title', 'Tambah Item - AHASS')
@section('page-title', 'Tambah Item')

@section('content')
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-plus"></i> Form Tambah Item</h4>
    
    <form action="{{ route('item.store') }}" method="POST" class="form-container">
        @csrf
        <div class="form-group">
            <label class="form-label">ID Item</label>
            <input type="text" name="iditem" class="form-control" placeholder="Masukkan ID Item" value="{{ old('iditem') }}" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Nama Item</label>
            <input type="text" name="namaitem" class="form-control" placeholder="Masukkan Nama Item" value="{{ old('namaitem') }}" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Harga</label>
            <input type="text" name="harga" class="form-control" placeholder="Masukkan Harga (contoh: 50.000)" value="{{ old('harga') }}">
        </div>
        
        <div class="form-group">
            <label class="form-label">Jenis</label>
            <select name="jenis" class="form-select">
                <option value="">-- Pilih Jenis --</option>
                <option value="Barang" {{ old('jenis') == 'Barang' ? 'selected' : '' }}>Barang</option>
                <option value="Jasa" {{ old('jenis') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
            </select>
        </div>
        
        <div class="form-group">
            <label class="form-label">Stok</label>
            <input type="number" name="qty" class="form-control" placeholder="Masukkan Stok" value="{{ old('qty', 0) }}">
        </div>
        
        <div class="form-actions">
            <a href="{{ route('item.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
