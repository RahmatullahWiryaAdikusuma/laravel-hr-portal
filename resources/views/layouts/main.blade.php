<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HR Portal - Admin Dashboard</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eaf0ff;
            --text-dark: #2b2d42;
            --text-muted: #8d99ae;
            --bg-body: #f8f9fc;
            --sidebar-width: 260px;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* --- SIDEBAR STYLING --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #ffffff;
            border-right: 1px solid #eaecf0;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            padding: 1.5rem 1rem;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar-brand {
            font-size: 1.25rem;
            font-weight: 800; /* Lebih tebal agar menonjol */
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2.5rem; /* Jarak lebih lega */
            padding-left: 0.75rem;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .nav-item { margin-bottom: 4px; }

        .nav-link {
            color: var(--text-muted);
            font-weight: 500;
            padding: 0.85rem 1rem; /* Padding sedikit diperbesar */
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s;
        }

        .nav-link i { 
            width: 20px; 
            text-align: center; 
            font-size: 1.1rem; 
            transition: transform 0.2s;
        }

        .nav-link:hover {
            background-color: #f8f9fa;
            color: var(--primary-color);
        }
        .nav-link:hover i { transform: translateX(3px); }

        .nav-link.active {
            background-color: var(--primary-light);
            color: var(--primary-color);
            font-weight: 600;
        }

        /* --- MAIN CONTENT WRAPPER --- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease-in-out;
        }

        /* --- TOPBAR --- */
        .topbar {
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #eaecf0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        /* User Dropdown Styling */
        .user-dropdown .btn {
            border: none;
            background: transparent;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-dark);
            padding: 5px 10px;
            border-radius: 50px; /* Pill shape saat hover */
            transition: background 0.2s;
        }
        
        .user-dropdown .btn:hover, .user-dropdown .btn:focus {
            background-color: #f8f9fa;
            border-color: transparent;
        }

        .user-info {
            text-align: right;
            line-height: 1.2;
        }
        
        .user-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: var(--primary-light);
            color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 2px 5px rgba(67, 97, 238, 0.1);
        }

        .content-body { padding: 2rem; flex: 1; }

        /* --- MOBILE RESPONSIVE LOGIC --- */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .sidebar-overlay.show { display: block; opacity: 1; }
            .topbar { padding: 0 1rem; }
            .content-body { padding: 1rem; }
            
            /* Sembunyikan nama user di mobile agar tidak sempit */
            .user-info { display: none; } 
        }
    </style>
</head>
<body>

    @if(auth()->check() && auth()->user()->role === 'admin')
        
        <!-- OVERLAY MOBILE -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- SIDEBAR ADMIN -->
        <aside class="sidebar" id="sidebar">
            <a href="#" class="sidebar-brand">
                <i class="fas fa-layer-group fa-lg"></i> HR PORTAL
            </a>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.report') || request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.report') }}">
                        <i class="fas fa-chart-pie"></i> Dashboard
                    </a>
                </li>
                
                <li class="nav-item mt-4 mb-2 px-2">
                    <small class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Master Data</small>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.lowongan.*') ? 'active' : '' }}" href="{{ route('admin.lowongan.index') }}">
                        <i class="fas fa-briefcase"></i> Master Lowongan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.departemen.*') ? 'active' : '' }}" href="{{ route('admin.departemen.index') }}">
                        <i class="fas fa-building"></i> Master Departemen
                    </a>
                </li>

                <li class="nav-item mt-4 mb-2 px-2">
                    <small class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Perekrutan</small>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.pendaftar') ? 'active' : '' }}" href="{{ route('admin.pendaftar') }}">
                        <i class="fas fa-user-check"></i> Approval Pendaftar
                    </a>
                </li>
            </ul>
            
            <!-- Tombol Logout DIHAPUS dari sini sesuai request -->
        </aside>

        <!-- WRAPPER UNTUK KONTEN KANAN -->
        <div class="main-wrapper">
            <!-- TOPBAR -->
            <header class="topbar">
                <!-- Tombol Toggle Sidebar (Mobile Only) -->
                <button class="btn btn-light d-lg-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Spacer agar dropdown ke kanan -->
                <div class="ms-auto"></div>

                <!-- User Profile Dropdown -->
                <div class="dropdown user-dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-info me-2">
                            <div class="user-name">{{ auth()->user()->name }}</div>
                            <div class="user-role">Administrator</div>
                        </div>
                        <div class="user-avatar">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" style="min-width: 200px;">
                        <li class="px-3 py-2">
                            <div class="fw-bold text-dark">{{ auth()->user()->name }}</div>
                            <small class="text-muted">{{ auth()->user()->email }}</small>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-cog me-2 text-muted"></i> Edit Profile
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item py-2 text-danger fw-semibold">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </header>

            <!-- CONTENT -->
            <main class="content-body">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

    @else
        <!-- LAYOUT UNTUK GUEST (Pelamar) -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom sticky-top">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary" href="#">
                    <i class="fas fa-layer-group me-2"></i>HR Portal
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center gap-3">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                    <div class="user-avatar" style="width: 32px; height: 32px; font-size: 0.9rem;">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                    <span class="fw-semibold">{{ auth()->user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item text-danger">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-primary px-4 rounded-pill">Login</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container py-5">
            @if(session('success'))
                <div class="alert alert-success shadow-sm mb-4 border-0 border-start border-success border-4">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script Toggle Sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                });
            }
        });
    </script>
</body>
</html>