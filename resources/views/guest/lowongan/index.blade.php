@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <h3>Daftar Lowongan Tersedia</h3>
    </div>

    @foreach($lowongan as $loker)
    <div class="col-md-4 mb-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $loker->posisi }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $loker->departemen->name }}</h6>
                <p class="card-text text-truncate">{{ $loker->deskripsi }}</p>
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item">Kuota: {{ $loker->quota }}</li>
                </ul>
                <button type="button" class="btn btn-primary w-100 btn-apply" 
                    data-bs-toggle="modal" 
                    data-bs-target="#applyModal"
                    data-id="{{ $loker->id }}"
                    data-posisi="{{ $loker->posisi }}">
                    Lamar Sekarang
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="modal fade" id="applyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('apply') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Lamar Posisi: <span id="posisiLabel"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="lowongan_id" id="lowongan_id">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Lahir (DOB)</label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>No Telp</label>
                            <input type="text" name="no_telp" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Alamat</label>
                            <textarea name="address" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Universitas</label>
                            <input type="text" name="university" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Jurusan (Major)</label>
                            <input type="text" name="major" class="form-control" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>IPK</label>
                            <input type="number" step="0.01" name="ipk" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Upload CV (PDF)</label>
                            <input type="file" name="cv" class="form-control" accept=".pdf" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Lamaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        const applyBtns = document.querySelectorAll('.btn-apply');
        applyBtns.forEach(btn => {
            btn.addEventListener('click', function(){
                document.getElementById('lowongan_id').value = this.getAttribute('data-id');
                document.getElementById('posisiLabel').innerText = this.getAttribute('data-posisi');
            });
        });
    });
</script>
@endsection