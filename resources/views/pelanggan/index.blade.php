@extends('layouts.app')

@section('title', 'Data Pelanggan - AHASS')
@section('page-title', 'Data Pelanggan')

@section('content')
<div class="card-solid animate-fadeIn">
    <div class="d-flex justify-between align-center mb-3" style="flex-wrap: wrap; gap: 1rem;">
        <h4 class="card-title mb-0"><i class="fas fa-users"></i> Tabel Pelanggan</h4>
        <a href="{{ route('pelanggan.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Pelanggan
        </a>
    </div>
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID Pelanggan</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggan as $p)
                <tr>
                    <td>{{ $p->idpelanggan }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('pelanggan.edit', $p->idpelanggan) }}" class="btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('pelanggan.destroy', $p->idpelanggan) }}" method="POST" style="display:inline;">
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
                    <td colspan="4" class="text-center">Tidak ada data pelanggan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="pagination-container">
        {{ $pelanggan->links('pagination::simple-bootstrap-5') }}
    </div>
</div>
@endsection
