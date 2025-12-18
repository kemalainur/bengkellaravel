@extends('layouts.customer')

@section('title', 'Detail Transaksi - AHASS')

@section('content')
<div class="card-solid animate-fadeIn">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h4 class="card-title" style="margin: 0;"><i class="fas fa-file-invoice"></i> Detail Transaksi</h4>
        <a href="{{ route('customer.dashboard') }}" class="btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    
    <!-- Info Transaksi -->
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-bottom: 2rem;">
        <div style="background: var(--bg-input); padding: 1rem; border-radius: 8px;">
            <p style="color: #a0aec0; margin: 0; font-size: 0.875rem;">No Struk</p>
            <h3 style="color: var(--accent-gold); margin: 0.25rem 0;">{{ $transaksi->nostruk }}</h3>
        </div>
        <div style="background: var(--bg-input); padding: 1rem; border-radius: 8px;">
            <p style="color: #a0aec0; margin: 0; font-size: 0.875rem;">Tanggal</p>
            <h3 style="color: #fff; margin: 0.25rem 0;">{{ $transaksi->tanggal ? $transaksi->tanggal->format('d/m/Y') : '-' }}</h3>
        </div>
        <div style="background: var(--bg-input); padding: 1rem; border-radius: 8px;">
            <p style="color: #a0aec0; margin: 0; font-size: 0.875rem;">No Polisi</p>
            <h3 style="color: #fff; margin: 0.25rem 0;">{{ $transaksi->nopolisi }}</h3>
        </div>
        <div style="background: var(--bg-input); padding: 1rem; border-radius: 8px;">
            <p style="color: #a0aec0; margin: 0; font-size: 0.875rem;">Status</p>
            @if($transaksi->status == 'pending')
                <span class="badge badge-warning" style="font-size: 1rem;">Pending</span>
            @elseif($transaksi->status == 'proses')
                <span class="badge badge-info" style="font-size: 1rem;">Proses</span>
            @else
                <span class="badge badge-success" style="font-size: 1rem;">Selesai</span>
            @endif
        </div>
    </div>

    <!-- Status Timeline -->
    <div class="status-timeline" style="margin-bottom: 2rem;">
        <div class="status-step {{ in_array($transaksi->status, ['pending', 'proses', 'selesai']) ? 'completed' : '' }}">
            <div class="icon"><i class="fas fa-clipboard-check"></i></div>
            <span style="color: #fff; font-size: 0.875rem;">Diterima</span>
        </div>
        <div class="status-step {{ in_array($transaksi->status, ['proses', 'selesai']) ? 'completed' : '' }}">
            <div class="icon"><i class="fas fa-tools"></i></div>
            <span style="color: #fff; font-size: 0.875rem;">Proses</span>
        </div>
        <div class="status-step {{ $transaksi->status == 'selesai' ? 'completed' : '' }}">
            <div class="icon"><i class="fas fa-check-circle"></i></div>
            <span style="color: #fff; font-size: 0.875rem;">Selesai</span>
        </div>
    </div>

    <!-- Item Detail -->
    <h4 class="card-title"><i class="fas fa-list"></i> Rincian Servis</h4>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi->details as $d)
                <tr>
                    <td>{{ $d->item->namaitem ?? '-' }}</td>
                    <td>{{ $d->item->jenis ?? '-' }}</td>
                    <td>Rp {{ number_format((float)str_replace('.', '', $d->item->harga ?? 0), 0, ',', '.') }}</td>
                    <td>{{ $d->banyaknya }}</td>
                    <td><strong>Rp {{ number_format((float)str_replace('.', '', $d->hargatotal), 0, ',', '.') }}</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada detail item</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr style="background: var(--bg-input);">
                    <td colspan="4" style="text-align: right; font-weight: bold; color: #fff;">Total Biaya:</td>
                    <td style="font-weight: bold; color: var(--accent-gold); font-size: 1.25rem;">
                        Rp {{ number_format((float)str_replace('.', '', $transaksi->totalbiaya), 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    @if($transaksi->terbilang)
    <div style="background: var(--bg-input); padding: 1rem; border-radius: 8px; margin-top: 1rem;">
        <p style="color: #a0aec0; margin: 0; font-size: 0.875rem;">Terbilang:</p>
        <p style="color: #fff; margin: 0.25rem 0; font-style: italic;">{{ $transaksi->terbilang }}</p>
    </div>
    @endif
</div>
@endsection
