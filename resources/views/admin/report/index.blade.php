@extends('layouts.main')

@section('content')
<style>
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    .dashboard-container {
        font-family: 'Inter', sans-serif;
    }

    .stat-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 1.5rem;
    }

    .bg-gradient-primary { background: linear-gradient(45deg, #4e73df, #224abe); }
    .bg-gradient-success { background: linear-gradient(45deg, #1cc88a, #13855c); }
    .bg-gradient-danger { background: linear-gradient(45deg, #e74a3b, #be2617); }
    .bg-gradient-info { background: linear-gradient(45deg, #36b9cc, #258391); }

    .table-custom thead th {
        background-color: #f8f9fc;
        color: #5a5c69;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        border-top: none;
    }

    .table-custom tbody td {
        vertical-align: middle;
        color: #5a5c69;
        font-size: 0.95rem;
    }

    .card-header-custom {
        background-color: #fff;
        border-bottom: 1px solid #e3e6f0;
        padding: 1.5rem;
    }

    .progress-thin {
        height: 6px;
        border-radius: 3px;
    }
</style>

<div class="dashboard-container">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h3 class="fw-bold text-dark mb-1">Dashboard Overview</h3>
            <p class="text-muted mb-0">Ringkasan data pendaftaran dan kuota departemen.</p>
        </div>
        <div>
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                <i class="far fa-calendar-alt me-2"></i> {{ date('d F Y') }}
            </span>
        </div>
    </div>

     
    <div class="row g-4 mb-5">
        <!-- Card Total Pendaftar -->
        <div class="col-md-4">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase fw-bold text-primary small mb-1">Total Pelamar</div>
                            <div class="h2 mb-0 fw-bold text-gray-800">{{ $summaryStatus['total'] }}</div>
                        </div>
                        <div class="icon-box bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress progress-thin mb-1">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                        </div>
                        <small class="text-muted">Total semua aplikasi masuk</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Diterima -->
        <div class="col-md-4">
            <div class="card stat-card shadow-sm h-100 border-start border-success border-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase fw-bold text-success small mb-1">Diterima (Accepted)</div>
                            <div class="h2 mb-0 fw-bold text-gray-800">{{ $summaryStatus['diterima'] }}</div>
                        </div>
                        <div class="icon-box bg-success bg-opacity-10 text-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress progress-thin mb-1">
                            @php 
                                $persenTerima = $summaryStatus['total'] > 0 ? ($summaryStatus['diterima'] / $summaryStatus['total']) * 100 : 0; 
                            @endphp
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $persenTerima }}%"></div>
                        </div>
                        <small class="text-muted">{{ round($persenTerima) }}% dari total pelamar</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Ditolak -->
        <div class="col-md-4">
            <div class="card stat-card shadow-sm h-100 border-start border-danger border-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase fw-bold text-danger small mb-1">Ditolak (Rejected)</div>
                            <div class="h2 mb-0 fw-bold text-gray-800">{{ $summaryStatus['ditolak'] }}</div>
                        </div>
                        <div class="icon-box bg-danger bg-opacity-10 text-danger">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress progress-thin mb-1">
                            @php 
                                $persenTolak = $summaryStatus['total'] > 0 ? ($summaryStatus['ditolak'] / $summaryStatus['total']) * 100 : 0; 
                            @endphp
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $persenTolak }}%"></div>
                        </div>
                        <small class="text-muted">{{ round($persenTolak) }}% dari total pelamar</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. MAIN TABLE REPORT (Summary Departemen) -->
    <div class="card border-0 shadow rounded-3 overflow-hidden">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold text-primary">
                <i class="fas fa-chart-bar me-2"></i>Laporan Per Departemen
            </h5>
            <button class="btn btn-sm btn-outline-primary rounded-pill px-3" onclick="window.print()">
                <i class="fas fa-print me-1"></i> Cetak Laporan
            </button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4 py-3">Departemen</th>
                            <th class="text-center py-3">Total Kuota</th>
                            <th class="text-center py-3 text-success">Diterima</th>
                            <th class="text-center py-3 text-danger">Ditolak</th>
                            <th class="text-center py-3 text-primary">Sisa Kuota</th>
                            <th class="pe-4 py-3 text-center">Status Penuh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $row)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $row['departemen'] }}</td>
                            <td class="text-center">
                                <span class="badge bg-secondary bg-opacity-10 text-dark px-3 py-2 rounded-pill">
                                    {{ $row['total_quota'] }}
                                </span>
                            </td>
                            <td class="text-center fw-bold text-success">{{ $row['diterima'] }}</td>
                            <td class="text-center fw-bold text-danger">{{ $row['ditolak'] }}</td>
                            <td class="text-center">
                                <span class="fw-bold text-primary">{{ $row['sisa_quota'] }}</span>
                            </td>
                            <td class="pe-4 text-center">
                                @if($row['total_quota'] > 0)
                                    @php $usage = ($row['diterima'] / $row['total_quota']) * 100; @endphp
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="progress progress-thin w-100 me-2" style="height: 8px; max-width: 80px;">
                                            <div class="progress-bar {{ $usage >= 100 ? 'bg-danger' : ($usage >= 50 ? 'bg-warning' : 'bg-success') }}" 
                                                 role="progressbar" style="width: {{ $usage }}%"></div>
                                        </div>
                                        <small class="text-muted">{{ round($usage) }}%</small>
                                    </div>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-light fw-bold">
                        <tr>
                            <td class="ps-4 text-uppercase">Grand Total</td>
                            <td class="text-center">{{ collect($reports)->sum('total_quota') }}</td>
                            <td class="text-center text-success">{{ $summaryStatus['diterima'] }}</td>
                            <td class="text-center text-danger">{{ $summaryStatus['ditolak'] }}</td>
                            <td class="text-center text-primary">{{ collect($reports)->sum('sisa_quota') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection