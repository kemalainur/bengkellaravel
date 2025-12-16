@extends('layouts.app')

@section('title', 'Tambah Transaksi - AHASS')
@section('page-title', 'Tambah Transaksi')

@section('content')
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-plus"></i> Form Tambah Transaksi</h4>
    
    <form action="{{ route('transaksi.store') }}" method="POST" class="form-container">
        @csrf
        <div class="form-group">
            <label class="form-label">No Struk</label>
            <input type="number" name="nostruk" class="form-control" placeholder="Masukkan No Struk" value="{{ old('nostruk') }}" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">No Polisi (Motor)</label>
            <select name="nopolisi" class="form-select" required>
                <option value="">-- Pilih Motor --</option>
                @foreach($motor as $m)
                    <option value="{{ $m->nopolisi }}" {{ old('nopolisi') == $m->nopolisi ? 'selected' : '' }}>
                        {{ $m->nopolisi }} - {{ $m->tipe }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
        </div>
        
        <div class="form-actions">
            <a href="{{ route('transaksi.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
