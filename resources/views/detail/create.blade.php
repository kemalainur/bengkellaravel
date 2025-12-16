@extends('layouts.app')

@section('title', 'Tambah Detail - AHASS')
@section('page-title', 'Tambah Detail')

@section('content')
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-plus"></i> Tambah Detail Transaksi</h4>
    <p class="text-center" style="color: var(--text-secondary); margin-bottom: var(--space-lg);">
        No. Struk: <strong style="color: var(--accent-gold);">{{ $transaksi->nostruk }}</strong>
    </p>
    
    <form action="{{ route('detail.store', $transaksi->nostruk) }}" method="POST" class="form-container">
        @csrf
        <div class="form-group">
            <label class="form-label">Pilih Barang / Jasa</label>
            <select name="iditem" class="form-select" required>
                <option value="">-- Pilih Item --</option>
                @foreach($items as $i)
                    <option value="{{ $i->iditem }}" {{ old('iditem') == $i->iditem ? 'selected' : '' }}>
                        {{ $i->iditem }} - {{ $i->namaitem }} (Stok: {{ $i->qty }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Jumlah / Qty</label>
            <input type="number" name="banyaknya" class="form-control" min="1" placeholder="Masukkan jumlah" value="{{ old('banyaknya', 1) }}" required>
        </div>

        <div class="form-actions">
            <a href="{{ route('transaksi.show', $transaksi->nostruk) }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Simpan Detail
            </button>
        </div>
    </form>
</div>
@endsection
