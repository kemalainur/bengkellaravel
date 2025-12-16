@extends('layouts.app')

@section('title', 'Edit Transaksi - AHASS')
@section('page-title', 'Edit Transaksi')

@section('content')
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-edit"></i> Form Edit Transaksi</h4>
    
    <form action="{{ route('transaksi.update', $transaksi->nostruk) }}" method="POST" class="form-container">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label">No Struk</label>
            <input type="number" class="form-control" value="{{ $transaksi->nostruk }}" readonly>
        </div>
        
        <div class="form-group">
            <label class="form-label">No Polisi (Motor)</label>
            <select name="nopolisi" class="form-select" required>
                @foreach($motor as $m)
                    <option value="{{ $m->nopolisi }}" {{ old('nopolisi', $transaksi->nopolisi) == $m->nopolisi ? 'selected' : '' }}>
                        {{ $m->nopolisi }} - {{ $m->tipe }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $transaksi->tanggal ? $transaksi->tanggal->format('Y-m-d') : '') }}" required>
        </div>
        
        <div class="form-actions">
            <a href="{{ route('transaksi.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
