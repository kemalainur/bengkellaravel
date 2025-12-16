@extends('layouts.app')

@section('title', 'Detail Transaksi - AHASS')
@section('page-title', 'Detail Transaksi')

@push('styles')
<style>
    .info-table {
        width: 100%;
        margin-bottom: var(--space-lg);
    }
    .info-table th {
        background: var(--bg-input);
        color: var(--accent-gold);
        padding: 12px 16px;
        text-align: left;
        width: 30%;
        border: 1px solid var(--border-color);
    }
    .info-table td {
        background: var(--bg-card);
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        color: #ffffff;
    }
</style>
@endpush

@section('content')
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-file-invoice"></i> Detail Transaksi</h4>
    
    <!-- Info Transaksi -->
    <table class="info-table">
        <tr>
            <th><i class="fas fa-hashtag"></i> No Struk</th>
            <td>{{ $transaksi->nostruk }}</td>
        </tr>
        <tr>
            <th><i class="fas fa-motorcycle"></i> No Polisi</th>
            <td>{{ $transaksi->nopolisi }}</td>
        </tr>
        <tr>
            <th><i class="fas fa-user"></i> Pelanggan</th>
            <td>{{ $transaksi->motor->pelanggan->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th><i class="fas fa-calendar"></i> Tanggal</th>
            <td>{{ $transaksi->tanggal ? $transaksi->tanggal->format('d/m/Y') : '-' }}</td>
        </tr>
        <tr>
            <th><i class="fas fa-money-bill"></i> Total Biaya</th>
            <td><strong style="color: var(--accent-gold);">Rp {{ $transaksi->totalbiaya }}</strong></td>
        </tr>
        <tr>
            <th><i class="fas fa-comment"></i> Terbilang</th>
            <td>{{ $transaksi->terbilang }}</td>
        </tr>
    </table>

    <!-- Tombol Aksi -->
    <div class="d-flex justify-between align-center mb-3" style="flex-wrap: wrap; gap: 1rem;">
        <h5 style="color: var(--accent-gold); margin: 0;"><i class="fas fa-list"></i> Item Detail</h5>
        <a href="{{ route('detail.create', $transaksi->nostruk) }}" class="btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Detail
        </a>
    </div>

    <!-- Tabel Detail -->
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Item</th>
                    <th>Harga Item</th>
                    <th>Jenis</th>
                    <th>Banyaknya</th>
                    <th>Harga Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi->details as $d)
                <tr>
                    <td>{{ $d->item->namaitem ?? '-' }}</td>
                    <td>Rp {{ $d->item->harga ?? '-' }}</td>
                    <td>{{ $d->item->jenis ?? '-' }}</td>
                    <td>{{ $d->banyaknya }}</td>
                    <td>Rp {{ $d->hargatotal }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('detail.edit', [$transaksi->nostruk, $d->id]) }}" class="btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Ubah
                            </a>
                            <form action="{{ route('detail.destroy', [$transaksi->nostruk, $d->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada item detail</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="form-actions" style="margin-top: 2rem;">
        <a href="{{ route('transaksi.index') }}" class="btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection
