@extends('layouts.advisor')

@section('title', 'Dashboard Service Advisor - AHASS')
@section('page-title', 'Dashboard Service Advisor')

@section('content')
<div class="stats-grid animate-fadeIn">
    <div class="stats-card">
        <div class="icon"><i class="fas fa-users"></i></div>
        <h5>Total Pelanggan</h5>
        <div class="stats-number">{{ $total_pelanggan }}</div>
    </div>
    
    <div class="stats-card">
        <div class="icon"><i class="fas fa-motorcycle"></i></div>
        <h5>Total Motor</h5>
        <div class="stats-number">{{ $total_motor }}</div>
    </div>
    
    <div class="stats-card" style="background: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%);">
        <div class="icon"><i class="fas fa-file-invoice"></i></div>
        <h5>Transaksi Bulan Ini</h5>
        <div class="stats-number">{{ $transaksi_bulan }}</div>
    </div>
    
    <div class="stats-card" style="background: linear-gradient(135deg, #b45309 0%, #f59e0b 100%);">
        <div class="icon"><i class="fas fa-clock"></i></div>
        <h5>Transaksi Pending</h5>
        <div class="stats-number">{{ $transaksi_pending_count }}</div>
    </div>
</div>

<!-- Transaksi Pending -->
@if($transaksi_pending->count() > 0)
<div class="card-solid mt-4 animate-fadeIn">
    <h4 class="card-title" style="color: #f59e0b;"><i class="fas fa-clock"></i> Transaksi Pending</h4>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No Struk</th>
                    <th>Pelanggan</th>
                    <th>No Polisi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi_pending as $t)
                <tr>
                    <td>{{ $t->nostruk }}</td>
                    <td>{{ $t->motor->pelanggan->nama ?? '-' }}</td>
                    <td>{{ $t->nopolisi }}</td>
                    <td>{{ $t->tanggal ? $t->tanggal->format('d/m/Y') : '-' }}</td>
                    <td><span class="badge badge-warning">Pending</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<div class="row mt-4" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
    <!-- Pelanggan Terbaru -->
    <div class="card-solid animate-fadeIn">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h4 class="card-title" style="margin: 0;"><i class="fas fa-user-clock"></i> Pelanggan Terbaru</h4>
            <a href="{{ route('advisor.pelanggan.create') }}" class="btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggan_terbaru as $p)
                    <tr>
                        <td>{{ $p->nama }}</td>
                        <td>{{ \Str::limit($p->alamat, 30) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Motor Terbaru -->
    <div class="card-solid animate-fadeIn">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h4 class="card-title" style="margin: 0;"><i class="fas fa-motorcycle"></i> Motor Terbaru</h4>
            <a href="{{ route('advisor.motor.create') }}" class="btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No Polisi</th>
                        <th>Pemilik</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($motor_terbaru as $m)
                    <tr>
                        <td>{{ $m->nopolisi }}</td>
                        <td>{{ $m->pelanggan->nama ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="form-actions mt-4">
    <a href="{{ route('advisor.pelanggan.create') }}" class="btn-primary">
        <i class="fas fa-user-plus"></i> Tambah Pelanggan
    </a>
    <a href="{{ route('advisor.motor.create') }}" class="btn-secondary">
        <i class="fas fa-plus-circle"></i> Tambah Motor
    </a>
</div>
@endsection
