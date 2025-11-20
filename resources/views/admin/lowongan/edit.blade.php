@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Lowongan</h5>
            </div>
            <div class="card-body p-4">
                {{-- Form Update Lowongan --}}
                <form action="{{ route('admin.lowongan.update', $lowongan->id) }}" method="POST">
                    @csrf 
                    @method('PUT')
                    
                    {{-- Input Posisi --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Posisi / Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="posisi" class="form-control @error('posisi') is-invalid @enderror" value="{{ old('posisi', $lowongan->posisi) }}" required>
                        @error('posisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        {{-- Input Departemen --}}
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Departemen <span class="text-danger">*</span></label>
                            <select name="dept_id" class="form-select @error('dept_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Departemen --</option>
                                @foreach($departemens as $dept)
                                    <option value="{{ $dept->id }}" {{ old('dept_id', $lowongan->dept_id) == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dept_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Input Kuota --}}
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Kuota <span class="text-danger">*</span></label>
                            <input type="number" name="quota" class="form-control @error('quota') is-invalid @enderror" value="{{ old('quota', $lowongan->quota) }}" required>
                            @error('quota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Switch Status Aktif/Nonaktif --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Status Lowongan</label>
                        <div class="form-check form-switch">
                            {{-- Trik Hidden Input: Agar jika tidak dicentang tetap mengirim nilai 0 --}}
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="statusSwitch" {{ $lowongan->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusSwitch">Aktif (Dapat dilihat pelamar)</label>
                        </div>
                    </div>

                    {{-- Input Deskripsi --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.lowongan.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">Update Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection