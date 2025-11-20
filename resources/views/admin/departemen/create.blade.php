@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">Tambah Departemen</div>
            <div class="card-body">
                <form action="{{ route('admin.departemen.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Departemen</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: IT Support" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.departemen.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection