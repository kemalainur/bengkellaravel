@extends('layouts.partman')

@section('title', 'Dashboard Partman - AHASS')
@section('page-title', 'Dashboard Partman')

@section('content')
<div class="stats-grid animate-fadeIn">
    <div class="stats-card">
        <div class="icon"><i class="fas fa-box"></i></div>
        <h5>Total Item</h5>
        <div class="stats-number">{{ $total_item }}</div>
    </div>
    
    <div class="stats-card">
        <div class="icon"><i class="fas fa-cog"></i></div>
        <h5>Total Sparepart</h5>
        <div class="stats-number">{{ $total_sparepart }}</div>
    </div>
    
    <div class="stats-card">
        <div class="icon"><i class="fas fa-wrench"></i></div>
        <h5>Total Jasa</h5>
        <div class="stats-number">{{ $total_jasa }}</div>
    </div>
    
    <div class="stats-card" style="background: linear-gradient(135deg, #7c2d12 0%, #b45309 100%);">
        <div class="icon" style="background: #ef4444;"><i class="fas fa-exclamation-triangle"></i></div>
        <h5>Stok Rendah</h5>
        <div class="stats-number">{{ $stok_rendah }}</div>
    </div>
</div>

<!-- Item Stok Rendah -->
@if($item_stok_rendah->count() > 0)
<div class="card-solid mt-4 animate-fadeIn">
    <h4 class="card-title" style="color: #ef4444;"><i class="fas fa-exclamation-circle"></i> Peringatan Stok Rendah (< 5)</h4>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID Item</th>
                    <th>Nama Item</th>
                    <th>Jenis</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($item_stok_rendah as $item)
                <tr>
                    <td>{{ $item->iditem }}</td>
                    <td>{{ $item->namaitem }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td><span class="badge badge-danger">{{ $item->qty }}</span></td>
                    <td>
                        <a href="{{ route('partman.item.edit', $item->iditem) }}" class="btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Update Stok
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- Item Terbaru -->
<div class="card-solid mt-4 animate-fadeIn">
    <div class="d-flex justify-between align-center mb-3" style="display: flex; justify-content: space-between; align-items: center;">
        <h4 class="card-title" style="margin: 0;"><i class="fas fa-clock"></i> Item Terbaru</h4>
        <a href="{{ route('partman.item.create') }}" class="btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Item Baru
        </a>
    </div>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID Item</th>
                    <th>Nama Item</th>
                    <th>Harga</th>
                    <th>Jenis</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse($item_terbaru as $item)
                <tr>
                    <td>{{ $item->iditem }}</td>
                    <td>{{ $item->namaitem }}</td>
                    <td>Rp {{ number_format((float)str_replace('.', '', $item->harga), 0, ',', '.') }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td>{{ $item->qty }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada item</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Action -->
<div class="form-actions mt-4">
    <a href="{{ route('partman.item.index') }}" class="btn-primary">
        <i class="fas fa-th-list"></i> Lihat Semua Item
    </a>
    <a href="{{ route('partman.item.create') }}" class="btn-secondary">
        <i class="fas fa-plus"></i> Tambah Item Baru
    </a>
</div>
@endsection
