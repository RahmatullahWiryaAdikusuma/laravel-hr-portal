@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="fas fa-user-check me-2"></i>Approval Pendaftar Magang</h3>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelamar</th>
                        <th>Lowongan Dilamar</th>
                        <th>IPK</th>
                        <th>Status</th>
                        <th>File CV</th>
                        <th class="text-center">Aksi / Keputusan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Perhatikan: Di Controller kamu variabelnya bernama $pendaftar (sesuai error log) --}}
                    @forelse($pendaftar as $key => $p)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <div class="fw-bold">{{ $p->name }}</div>
                            <small class="text-muted">{{ $p->university }} - {{ $p->major }}</small>
                        </td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $p->lowongan->posisi ?? '-' }}</span>
                            <div class="small text-muted mt-1">{{ $p->lowongan->departemen->name ?? '' }}</div>
                        </td>
                        <td>{{ $p->ipk }}</td>
                        <td>
                            @if($p->status == 'P')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($p->status == 'A')
                                <span class="badge bg-success">Diterima</span>
                            @elseif($p->status == 'R')
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            {{-- Pastikan sudah menjalankan: php artisan storage:link --}}
                            <a href="{{ asset('storage/' . $p->path_cv) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-pdf me-1"></i> Lihat CV
                            </a>
                        </td>
                        <td class="text-center">
                            @if($p->status == 'P')
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Tombol Approve --}}
                                    <form action="{{ route('admin.approval', $p->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button name="status" value="A" class="btn btn-sm btn-success" title="Terima Lamaran" onclick="return confirm('Yakin ingin MENERIMA pelamar ini?')">
                                            <i class="fas fa-check"></i> Terima
                                        </button>
                                    </form>

                                    {{-- Tombol Reject --}}
                                    <form action="{{ route('admin.approval', $p->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button name="status" value="R" class="btn btn-sm btn-danger" title="Tolak Lamaran" onclick="return confirm('Yakin ingin MENOLAK pelamar ini?')">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-muted small fst-italic">
                                    Keputusan: {{ $p->status == 'A' ? 'Diterima' : 'Ditolak' }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-users-slash fa-3x mb-3 d-block"></i>
                            Belum ada pendaftar masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection