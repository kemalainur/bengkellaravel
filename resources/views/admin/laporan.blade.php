@extends('layouts.admin')

@section('title', 'Laporan Keuangan - AHASS')
@section('page-title', 'Laporan Keuangan')

@section('content')
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-filter"></i> Filter Laporan</h4>
    
    <form action="{{ route('admin.laporan') }}" method="GET" class="row" style="display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap;">
        <div class="form-group" style="flex: 1; min-width: 200px;">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
        </div>
        <div class="form-group" style="flex: 1; min-width: 200px;">
            <label class="form-label">Tanggal Akhir</label>
            <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
        </div>
        <button type="submit" class="btn-primary">
            <i class="fas fa-search"></i> Filter
        </button>
    </form>
</div>

<!-- Summary -->
<div class="stats-grid mt-4 animate-fadeIn" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
    <div class="stats-card" style="background: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%);">
        <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
        <h5>Total Pendapatan</h5>
        <div class="stats-number">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
        <small style="color: rgba(255,255,255,0.7);">Periode: {{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate)) }}</small>
    </div>
    
    <div class="stats-card">
        <div class="icon"><i class="fas fa-file-invoice"></i></div>
        <h5>Jumlah Transaksi</h5>
        <div class="stats-number">{{ $transaksi->count() }}</div>
        <small style="color: rgba(255,255,255,0.7);">transaksi dalam periode</small>
    </div>
</div>

<!-- Item Terlaris -->
<div class="card-solid mt-4 animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-trophy"></i> Item Terlaris</h4>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Item</th>
                    <th>Total Terjual</th>
                </tr>
            </thead>
            <tbody>
                @forelse($itemTerlaris as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->namaitem }}</td>
                    <td><strong>{{ $item->total_terjual }}</strong> unit</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Daftar Transaksi -->
<div class="card-solid mt-4 animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-list"></i> Daftar Transaksi</h4>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No Struk</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>No Polisi</th>
                    <th>Status</th>
                    <th>Total Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $t)
                <tr>
                    <td>{{ $t->nostruk }}</td>
                    <td>{{ $t->tanggal ? $t->tanggal->format('d/m/Y') : '-' }}</td>
                    <td>{{ $t->motor->pelanggan->nama ?? '-' }}</td>
                    <td>{{ $t->nopolisi }}</td>
                    <td>
                        @if($t->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($t->status == 'proses')
                            <span class="badge badge-info">Proses</span>
                        @else
                            <span class="badge badge-success">Selesai</span>
                        @endif
                    </td>
                    <td><strong>Rp {{ number_format((float)str_replace('.', '', $t->totalbiaya), 0, ',', '.') }}</strong></td>
                    <td>
                        <a href="{{ route('transaksi.show', $t->nostruk) }}" class="btn-primary btn-sm">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada transaksi dalam periode ini</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Print Button -->
<div class="form-actions mt-4">
    <button onclick="window.print()" class="btn-primary">
        <i class="fas fa-print"></i> Cetak Laporan
    </button>
</div>
@endsection

@push('styles')
<style>
    @media print {
        .sidebar, .logout-btn, .content-header, .form-actions, form { display: none !important; }
        .main-content { margin-left: 0 !important; padding: 0 !important; }
        .card-solid { box-shadow: none !important; border: 1px solid #ddd !important; }
    }
</style>
@endpush
