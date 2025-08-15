<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Koperasi Desa') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            background-color: #eaf7ff;
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            width: 280px;
            background-color: #ffffff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            border-right: 1px solid #ddd;
            z-index: 999;
        }

        .sidebar-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1fa3a1;
            padding: 1.5rem 1rem;
            text-align: center;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .nav-link {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            color: #1fa3a1;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.2s ease;
            box-sizing: border-box;
        }

        .nav-link.active,
        .nav-link:hover {
            background-color: #1fa3a1;
            color: #ffffff !important;
        }

        .navbar {
            background-color: #1fa3a1;
            color: #ffffff;
            padding: 1rem 2rem;
            position: fixed;
            top: 0;
            left: 280px;
            width: calc(100% - 280px);
            height: 80px;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 0;
        }

        .navbar .navbar-brand {
            color: #ffffff !important;
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }

        .profile-dropdown {
            background-color: #fff;
            border-radius: 10px;
            padding: 0.3rem 0.8rem;
            color: black;
            display: flex;
            align-items: center;
            font-weight: 600;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            padding-top: 100px;
        }

        .content-wrapper {
            background-color: #ffffff;
            border-radius: 25px;
            padding: 2rem;
            min-height: 90vh;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                margin-left: -280px;
                transition: margin 0.3s;
            }
            .sidebar.show {
                margin-left: 0;
            }
            .navbar {
                left: 0;
                width: 100%;
            }
            .main-content {
                margin-left: 0;
                padding-top: 100px;
            }
        }
    </style>
</head>
<body>
<!-- Sidebar -->
<nav id="sidebar" class="sidebar">
    <div class="p-4 text-center">
        <a href="{{ route('dashboard') }}" class="text-decoration-none">
            <h5 class="mb-0" style="color: #1fa3a1; font-family: 'Segoe UI', sans-serif; font-weight: 700; letter-spacing: 1px;">
                SIMPAN PINJAM
            </h5>
            <h5 class="mb-0" style="color: #1fa3a1; font-family: 'Segoe UI', sans-serif; font-weight: 700; letter-spacing: 1px;">
                KOPERASI
            </h5>
        </a>
    </div>
    <ul class="nav flex-column px-2">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
        </li>

        @if (auth()->user()->level == 'Admin')
            <a href="{{ route('anggota.index') }}" class="nav-link {{ request()->is('anggota*') ? 'active' : '' }}">
                <i class="bi bi-database"></i> Data Anggota
            </a>
            <a href="{{ route('latih.index') }}" class="nav-link {{ request()->is('latih*') ? 'active' : '' }}">
                <i class="bi bi-database"></i> Data Latih
            </a>
            <a href="{{ route('uji.index') }}" class="nav-link {{ request()->is('uji*') ? 'active' : '' }}">
                <i class="bi bi-database"></i> Data Uji
            </a>
            <a href="{{ route('pengajuan.index') }}" class="nav-link {{ request()->is('pengajuan*') ? 'active' : '' }}">
                <i class="bi bi-database"></i> Pengajuan Pinjaman
            </a> 
            <a href="{{ route('knn.index') }}" class="nav-link {{ request()->is('knn') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Penghitungan KNN
            </a>
            {{-- <a href="{{ route('Riwayat_Penghitungan.index') }}" class="nav-link {{ request()->is('riwayat_penghitungan*') ? 'active' : '' }}">
                <i class="bi bi-person"></i> Riwayat Hitungan
            </a> --}}
        @endif

     @if (auth()->user()->level == 'Anggota')
            <a href="{{ route('pengajuan.index') }}" class="nav-link {{ request()->is('pengajuan*') ? 'active' : '' }}">
                <i class="bi bi-database"></i> Pengajuan Pinjaman
            </a>
            <a href="{{ route('pinjaman.index') }}" class="nav-link {{ request()->is('pinjaman*') ? 'active' : '' }}">
                <i class="bi bi-database"></i> Riwayat Pinjaman
            </a>
        @endif
    </ul>
</nav>

<!-- Main Content -->
<div class="main-content">
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                <span class="d-none d-md-inline">Simpan Pinjam Koperasi</span>
            </a>
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown profile-dropdown">
                    <button class="btn btn-light d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <img src="{{ asset('img/undraw_profile.svg') }}" alt="Profile" class="rounded-circle" width="32">
                        <span class="d-none d-md-inline">{{ auth()->user()->nama }}</span>
                        <i class="bi bi-chevron-down small"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="p-4">
        @yield('content')
    </main>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('show');
    });

    const handleResize = () => {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');

        if (window.innerWidth <= 768) {
            sidebar.classList.remove('show');
            mainContent.classList.add('expanded');
        } else {
            sidebar.classList.remove('show');
            mainContent.classList.remove('expanded');
        }
    };

    window.addEventListener('resize', handleResize);
    handleResize();
</script>
</body>
</html>
