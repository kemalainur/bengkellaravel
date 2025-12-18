@php $prefix = $routePrefix ?? 'motor'; @endphp
@extends($prefix === 'advisor.motor' ? 'layouts.advisor' : 'layouts.app')

@section('title', 'Edit Motor - AHASS')
@section('page-title', 'Edit Motor')

@section('content')
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-edit"></i> Form Edit Motor</h4>
    
    <form action="{{ route($prefix . '.update', $motor->nopolisi) }}" method="POST" class="form-container">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label">No Polisi</label>
            <input type="text" class="form-control" value="{{ $motor->nopolisi }}" readonly>
        </div>
        
        <div class="form-group">
            <label class="form-label">Pelanggan</label>
            <input type="text" class="form-control" value="{{ $motor->pelanggan->nama ?? '-' }}" readonly>
        </div>
        
        <div class="form-group">
            <label class="form-label">No Mesin</label>
            <input type="text" name="nomesin" class="form-control" placeholder="Masukkan No Mesin" value="{{ old('nomesin', $motor->nomesin) }}">
        </div>
        
        <div class="form-group">
            <label class="form-label">Tipe</label>
            <input type="text" name="tipe" class="form-control" placeholder="Masukkan Tipe Motor" value="{{ old('tipe', $motor->tipe) }}">
        </div>
        
        <div class="form-group">
            <label class="form-label">Tahun</label>
            <input type="number" name="tahun" class="form-control" placeholder="Masukkan Tahun" value="{{ old('tahun', $motor->tahun) }}">
        </div>
        
        <div class="form-group">
            <label class="form-label">No Rangka</label>
            <input type="text" name="norangka" class="form-control" placeholder="Masukkan No Rangka" value="{{ old('norangka', $motor->norangka) }}">
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
