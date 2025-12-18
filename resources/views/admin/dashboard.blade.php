@extends('layouts.admin')

@section('title', 'Dashboard Admin - AHASS')
@section('page-title', 'Dashboard Admin')

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
    
    <div class="stats-card">
        <div class="icon"><i class="fas fa-box"></i></div>
        <h5>Total Item</h5>
        <div class="stats-number">{{ $total_item }}</div>
    </div>
    
    <div class="stats-card">
        <div class="icon"><i class="fas fa-receipt"></i></div>
        <h5>Total Transaksi</h5>
        <div class="stats-number">{{ $total_transaksi }}</div>
    </div>
</div>

<!-- Financial Summary -->
<div class="row mt-4 animate-fadeIn" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
    <div class="stats-card" style="background: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%);">
        <div class="icon"><i class="fas fa-calendar-day"></i></div>
        <h5>Pendapatan Hari Ini</h5>
        <div class="stats-number">Rp {{ number_format($pendapatan_hari, 0, ',', '.') }}</div>
    </div>
    
    <div class="stats-card" style="background: linear-gradient(135deg, #1a4d7c 0%, #2980b9 100%);">
        <div class="icon"><i class="fas fa-calendar-alt"></i></div>
        <h5>Pendapatan Bulan Ini</h5>
        <div class="stats-number">Rp {{ number_format($pendapatan_bulan, 0, ',', '.') }}</div>
    </div>
    
    <div class="stats-card" style="background: linear-gradient(135deg, #7c2d12 0%, #b45309 100%);">
        <div class="icon"><i class="fas fa-coins"></i></div>
        <h5>Total Pendapatan</h5>
        <div class="stats-number">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</div>
    </div>
</div>

<!-- Status Overview -->
<div class="row mt-4 animate-fadeIn" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
    <div class="stats-card">
        <div class="icon" style="background: #f59e0b;"><i class="fas fa-clock"></i></div>
        <h5>Transaksi Pending</h5>
        <div class="stats-number">{{ $transaksi_pending }}</div>
    </div>
    
    <div class="stats-card">
        <div class="icon" style="background: #3b82f6;"><i class="fas fa-cog fa-spin"></i></div>
        <h5>Transaksi Proses</h5>
        <div class="stats-number">{{ $transaksi_proses }}</div>
    </div>
    
    <div class="stats-card">
        <div class="icon" style="background: #10b981;"><i class="fas fa-check-circle"></i></div>
        <h5>Transaksi Selesai</h5>
        <div class="stats-number">{{ $transaksi_selesai }}</div>
    </div>
</div>

<!-- Chart Pendapatan -->
<div class="card-solid mt-4 animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-chart-bar"></i> Pendapatan 6 Bulan Terakhir</h4>
    <canvas id="revenueChart" height="100"></canvas>
</div>

<!-- Transaksi Terbaru -->
<div class="card-solid mt-4 animate-fadeIn">
    <h4 class="card-title"><i class="fas fa-history"></i> Transaksi Terbaru</h4>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No Struk</th>
                    <th>Pelanggan</th>
                    <th>No Polisi</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi_terbaru as $t)
                <tr>
                    <td>{{ $t->nostruk }}</td>
                    <td>{{ $t->motor->pelanggan->nama ?? '-' }}</td>
                    <td>{{ $t->nopolisi }}</td>
                    <td>{{ $t->tanggal ? $t->tanggal->format('d/m/Y') : '-' }}</td>
                    <td>Rp {{ number_format((float)str_replace('.', '', $t->totalbiaya), 0, ',', '.') }}</td>
                    <td>
                        @if($t->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($t->status == 'proses')
                            <span class="badge badge-info">Proses</span>
                        @else
                            <span class="badge badge-success">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chart_labels),
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: @json($chart_data),
                backgroundColor: 'rgba(212, 175, 55, 0.7)',
                borderColor: 'rgb(212, 175, 55)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        },
                        color: '#a0aec0'
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: '#a0aec0'
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#a0aec0'
                    }
                }
            }
        }
    });
</script>
@endpush
