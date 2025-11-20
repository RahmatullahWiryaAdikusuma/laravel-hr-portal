@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Lowongan Baru</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.lowongan.store') }}" method="POST">
                    @csrf
                    
                    {{-- Input Posisi --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Posisi / Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="posisi" class="form-control @error('posisi') is-invalid @enderror" placeholder="Contoh: Staff Accounting" value="{{ old('posisi') }}" required>
                        @error('posisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        {{-- Input Departemen --}}
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Departemen <span class="text-danger">*</span></label>
                            <select name="dept_id" class="form-select @error('dept_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Departemen --</option>
                                @foreach($departemens as $dept)
                                    <option value="{{ $dept->id }}" {{ old('dept_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                @endforeach
                            </select>
                            @error('dept_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        {{-- Input Kuota --}}
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Kuota Penerimaan <span class="text-danger">*</span></label>
                            <input type="number" name="quota" class="form-control @error('quota') is-invalid @enderror" min="1" value="{{ old('quota') }}" required>
                            @error('quota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Input Deskripsi --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" placeholder="Jelaskan tanggung jawab dan kualifikasi pelamar..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.lowongan.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection