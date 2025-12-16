@extends('layouts.app')

@section('title', 'Data Item - AHASS')
@section('page-title', 'Data Item')

@section('content')
<div class="card-solid animate-fadeIn">
    <div class="d-flex justify-between align-center mb-3" style="flex-wrap: wrap; gap: 1rem;">
        <h4 class="card-title mb-0"><i class="fas fa-box"></i> Tabel Item</h4>
        <a href="{{ route('item.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Item
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($item as $i)
                <tr>
                    <td>{{ $i->iditem }}</td>
                    <td>{{ $i->namaitem }}</td>
                    <td>Rp {{ $i->harga }}</td>
                    <td>{{ $i->jenis }}</td>
                    <td>{{ $i->qty }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('item.edit', $i->iditem) }}" class="btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('item.destroy', $i->iditem) }}" method="POST" style="display:inline;">
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
                    <td colspan="6" class="text-center">Tidak ada data item</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="pagination-container">
        {{ $item->links('pagination::simple-bootstrap-5') }}
    </div>
</div>
@endsection
