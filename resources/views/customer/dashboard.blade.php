@extends('layouts.customer')

@section('title', 'Status Servis - AHASS')

@section('content')
<!-- Motor Info -->
<div class="card-solid animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-motorcycle"></i> Informasi Motor</h4>
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
        <div>
            <p style="color: #a0aec0; margin: 0;">No Polisi</p>
            <h3 style="color: #fff; margin: 0.25rem 0;">{{ $motor->nopolisi ?? '-' }}</h3>
        </div>
        <div>
            <p style="color: #a0aec0; margin: 0;">Pemilik</p>
            <h3 style="color: #fff; margin: 0.25rem 0;">{{ session('customer_nama') }}</h3>
        </div>
    </div>
</div>

<!-- Transaksi Aktif -->
@if($transaksiAktif->count() > 0)
<div class="card-solid mt-4 animate-fadeIn" style="border: 2px solid #f59e0b;">
    <h4 class="card-title" style="color: #f59e0b;"><i class="fas fa-cog fa-spin"></i> Servis Dalam Proses</h4>
    
    @foreach($transaksiAktif as $t)
    <div style="background: var(--bg-input); padding: 1.5rem; border-radius: 8px; margin-bottom: 1rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <div>
                <p style="color: #a0aec0; margin: 0; font-size: 0.875rem;">No Struk</p>
                <h4 style="color: #fff; margin: 0;">{{ $t->nostruk }}</h4>
            </div>
            <div style="text-align: right;">
                <p style="color: #a0aec0; margin: 0; font-size: 0.875rem;">Tanggal</p>
                <h4 style="color: #fff; margin: 0;">{{ $t->tanggal ? $t->tanggal->format('d/m/Y') : '-' }}</h4>
            </div>
        </div>
        
        <!-- Status Timeline -->
        <div class="status-timeline">
            <div class="status-step {{ in_array($t->status, ['pending', 'proses', 'selesai']) ? 'completed' : '' }}">
                <div class="icon"><i class="fas fa-clipboard-check"></i></div>
                <span style="color: #fff; font-size: 0.875rem;">Diterima</span>
            </div>
            <div class="status-step {{ in_array($t->status, ['proses', 'selesai']) ? 'completed' : '' }} {{ $t->status == 'pending' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-tools"></i></div>
                <span style="color: #fff; font-size: 0.875rem;">Proses</span>
            </div>
            <div class="status-step {{ $t->status == 'selesai' ? 'completed' : '' }}">
                <div class="icon"><i class="fas fa-check-circle"></i></div>
                <span style="color: #fff; font-size: 0.875rem;">Selesai</span>
            </div>
        </div>

        <div style="text-align: center;">
            @if($t->status == 'pending')
                <span class="badge badge-warning"><i class="fas fa-clock"></i> Menunggu Proses</span>
            @elseif($t->status == 'proses')
                <span class="badge badge-info"><i class="fas fa-cog"></i> Sedang Dikerjakan</span>
            @endif
        </div>
        
        <div style="margin-top: 1rem; text-align: center;">
            <a href="{{ route('customer.transaksi', $t->nostruk) }}" class="btn-primary btn-sm">
                <i class="fas fa-eye"></i> Lihat Detail
            </a>
        </div>
    </div>
    @endforeach
</div>
@endif

<!-- Riwayat Servis -->
<div class="card-solid mt-4 animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-history"></i> Riwayat Servis</h4>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No Struk</th>
                    <th>Tanggal</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $t)
                <tr>
                    <td>{{ $t->nostruk }}</td>
                    <td>{{ $t->tanggal ? $t->tanggal->format('d/m/Y') : '-' }}</td>
                    <td><strong>Rp {{ number_format((float)str_replace('.', '', $t->totalbiaya), 0, ',', '.') }}</strong></td>
                    <td>
                        @if($t->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($t->status == 'proses')
                            <span class="badge badge-info">Proses</span>
                        @else
                            <span class="badge badge-success">Selesai</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('customer.transaksi', $t->nostruk) }}" class="btn-primary btn-sm">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada riwayat servis</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
