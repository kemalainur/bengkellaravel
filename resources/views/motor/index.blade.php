@php $prefix = $routePrefix ?? 'motor'; @endphp
@extends($prefix === 'advisor.motor' ? 'layouts.advisor' : 'layouts.app')

@section('title', 'Data Motor - AHASS')
@section('page-title', 'Data Motor')

@section('content')
<div class="card-solid animate-fadeIn">
    <div class="d-flex justify-between align-center mb-3" style="flex-wrap: wrap; gap: 1rem;">
        <h4 class="card-title mb-0"><i class="fas fa-motorcycle"></i> Tabel Motor</h4>
        <a href="{{ route($prefix . '.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Motor
        </a>
    </div>
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No Polisi</th>
                    <th>Pelanggan</th>
                    <th>Tipe</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($motor as $m)
                <tr>
                    <td>{{ $m->nopolisi }}</td>
                    <td>{{ $m->pelanggan->nama ?? '-' }}</td>
                    <td>{{ $m->tipe }}</td>
                    <td>{{ $m->tahun }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route($prefix . '.edit', $m->nopolisi) }}" class="btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route($prefix . '.destroy', $m->nopolisi) }}" method="POST" style="display:inline;">
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
                    <td colspan="5" class="text-center">Tidak ada data motor</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="pagination-container">
        {{ $motor->links('pagination::simple-bootstrap-5') }}
    </div>
</div>
@endsection
