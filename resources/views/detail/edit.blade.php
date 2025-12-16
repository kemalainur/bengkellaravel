@extends('layouts.app')

@section('title', 'Edit Detail - AHASS')
@section('page-title', 'Edit Detail')

@section('content')
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-edit"></i> Form Edit Detail</h4>
    <p class="text-center" style="color: var(--text-secondary); margin-bottom: var(--space-lg);">
        No. Struk: <strong style="color: var(--accent-gold);">{{ $transaksi->nostruk }}</strong>
    </p>
    
    <form action="{{ route('detail.update', [$transaksi->nostruk, $detail->id]) }}" method="POST" class="form-container">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label">Item</label>
            <input type="text" class="form-control" value="{{ $detail->item->namaitem ?? '-' }}" readonly>
        </div>
        
        <div class="form-group">
            <label class="form-label">Banyaknya</label>
            <input type="number" name="banyaknya" class="form-control" min="1" value="{{ old('banyaknya', $detail->banyaknya) }}" required>
        </div>
        
        <div class="form-actions">
            <a href="{{ route('transaksi.show', $transaksi->nostruk) }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
