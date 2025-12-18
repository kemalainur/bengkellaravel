@extends('layouts.app')

@section('title', 'Data Transaksi - AHASS')
@section('page-title', 'Data Transaksi')

@section('content')
<div class="card-solid animate-fadeIn">
    <div class="d-flex justify-between align-center mb-3" style="flex-wrap: wrap; gap: 1rem;">
        <h4 class="card-title mb-0"><i class="fas fa-receipt"></i> Tabel Transaksi</h4>
        <a href="{{ route('transaksi.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Transaksi
        </a>
    </div>
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No Struk</th>
                    <th>No Polisi</th>
                    <th>Pelanggan</th>
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
                    <td>{{ $t->nopolisi }}</td>
                    <td>{{ $t->motor->pelanggan->nama ?? '-' }}</td>
                    <td>{{ $t->tanggal ? $t->tanggal->format('d/m/Y') : '-' }}</td>
                    <td>Rp {{ number_format((float)str_replace('.', '', $t->totalbiaya), 0, ',', '.') }}</td>
                    <td>
                        @if($t->status == 'pending')
                            <span style="background: #f59e0b; color: #000; padding: 4px 10px; border-radius: 12px; font-size: 0.8rem;">Pending</span>
                        @elseif($t->status == 'proses')
                            <span style="background: #3b82f6; color: #fff; padding: 4px 10px; border-radius: 12px; font-size: 0.8rem;">Proses</span>
                        @else
                            <span style="background: #10b981; color: #fff; padding: 4px 10px; border-radius: 12px; font-size: 0.8rem;">Selesai</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('transaksi.show', $t->nostruk) }}" class="btn-primary btn-sm" style="background: var(--info);">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('transaksi.edit', $t->nostruk) }}" class="btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('transaksi.destroy', $t->nostruk) }}" method="POST" style="display:inline;">
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
                    <td colspan="7" class="text-center">Tidak ada data transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="pagination-container">
        {{ $transaksi->links('pagination::simple-bootstrap-5') }}
    </div>
</div>
@endsection
