@extends('layouts.app')

@section('title', 'Edit Item - AHASS')
@section('page-title', 'Edit Item')

@section('content')
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-edit"></i> Form Edit Item</h4>
    
    <form action="{{ route('item.update', $item->iditem) }}" method="POST" class="form-container">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label">ID Item</label>
            <input type="text" class="form-control" value="{{ $item->iditem }}" readonly>
        </div>
        
        <div class="form-group">
            <label class="form-label">Nama Item</label>
            <input type="text" name="namaitem" class="form-control" placeholder="Masukkan Nama Item" value="{{ old('namaitem', $item->namaitem) }}" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Harga</label>
            <input type="text" name="harga" class="form-control" placeholder="Masukkan Harga" value="{{ old('harga', $item->harga) }}">
        </div>
        
        <div class="form-group">
            <label class="form-label">Jenis</label>
            <select name="jenis" class="form-select">
                <option value="">-- Pilih Jenis --</option>
                <option value="Barang" {{ old('jenis', $item->jenis) == 'Barang' ? 'selected' : '' }}>Barang</option>
                <option value="Jasa" {{ old('jenis', $item->jenis) == 'Jasa' ? 'selected' : '' }}>Jasa</option>
            </select>
        </div>
        
        <div class="form-group">
            <label class="form-label">Stok</label>
            <input type="number" name="qty" class="form-control" placeholder="Masukkan Stok" value="{{ old('qty', $item->qty) }}">
        </div>
        
        <div class="form-actions">
            <a href="{{ route('item.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
