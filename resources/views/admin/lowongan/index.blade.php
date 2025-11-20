@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="fas fa-briefcase me-2"></i>Master Lowongan</h3>
    <a href="{{ route('admin.lowongan.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Tambah Lowongan
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Posisi / Jabatan</th>
                        <th>Departemen</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th>Deskripsi</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- PERBAIKAN: Menggunakan variabel $lowongans (jamak) agar tidak error --}}
                    @forelse($lowongans as $key => $l)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="fw-bold">{{ $l->posisi }}</td>
                        <td>
                            {{-- Pakai ?? '-' biar aman kalau departemen terhapus --}}
                            <span class="badge bg-info text-dark">{{ $l->departemen->name ?? '-' }}</span>
                        </td>
                        <td>{{ $l->quota }}</td>
                        <td>
                            @if($l->is_active) 
                                <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Open</span>
                            @else
                                <span class="badge bg-secondary"><i class="fas fa-times-circle me-1"></i>Closed</span>
                            @endif
                        </td>
                        <td class="text-truncate" style="max-width: 150px;">{{ $l->deskripsi }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.lowongan.edit', $l->id) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                Edit
                            </a>
                            <form action="{{ route('admin.lowongan.destroy', $l->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lowongan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Hapus">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                            Belum ada data lowongan tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection