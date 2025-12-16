@extends('layouts.app')

@section('title', 'Tambah Motor - AHASS')
@section('page-title', 'Tambah Motor')

@section('content')
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-plus"></i> Form Tambah Motor</h4>
    
    <form action="{{ route('motor.store') }}" method="POST" class="form-container">
        @csrf
        <div class="form-group">
            <label class="form-label">No Polisi</label>
            <input type="text" name="nopolisi" class="form-control" placeholder="Masukkan No Polisi" value="{{ old('nopolisi') }}" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Pelanggan</label>
            <select name="idpelanggan" class="form-select" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($pelanggan as $p)
                    <option value="{{ $p->idpelanggan }}" {{ old('idpelanggan') == $p->idpelanggan ? 'selected' : '' }}>
                        {{ $p->idpelanggan }} - {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label class="form-label">No Mesin</label>
            <input type="text" name="nomesin" class="form-control" placeholder="Masukkan No Mesin" value="{{ old('nomesin') }}">
        </div>
        
        <div class="form-group">
            <label class="form-label">Tipe</label>
            <input type="text" name="tipe" class="form-control" placeholder="Masukkan Tipe Motor" value="{{ old('tipe') }}">
        </div>
        
        <div class="form-group">
            <label class="form-label">Tahun</label>
            <input type="number" name="tahun" class="form-control" placeholder="Masukkan Tahun" value="{{ old('tahun') }}">
        </div>
        
        <div class="form-group">
            <label class="form-label">No Rangka</label>
            <input type="text" name="norangka" class="form-control" placeholder="Masukkan No Rangka" value="{{ old('norangka') }}">
        </div>
        
        <div class="form-actions">
            <a href="{{ route('motor.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
