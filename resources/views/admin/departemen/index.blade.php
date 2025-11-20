@extends('layouts.main')

@section('content')
{{-- Header Halaman --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="fas fa-building me-2"></i>Master Departemen</h3>
    <a href="{{ route('admin.departemen.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Tambah Departemen
    </a>
</div>

{{-- Card Tabel --}}
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="10%" class="text-center">No</th>
                        <th>Nama Departemen</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departemens as $index => $d)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $d->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.departemen.edit', $d->id) }}" class="btn btn-sm btn-warning text-white me-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.departemen.destroy', $d->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus departemen {{ $d->name }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                            Belum ada data departemen.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection