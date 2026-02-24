<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Karyawan App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3a5f, #2c5282);
            width: 250px;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
        .main-content { margin-left: 250px; padding: 20px; min-height: 100vh; }
        .navbar-top {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 20px;
            margin-left: 250px;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .sidebar-brand { padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .user-avatar { width: 36px; height: 36px; object-fit: cover; border-radius: 50%; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <h5 class="text-white mb-0"><i class="bi bi-people-fill me-2"></i>Karyawan App</h5>
        <small class="text-white-50">Sistem Manajemen</small>
    </div>
    <nav class="mt-3">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a href="{{ route('karyawan.index') }}" class="nav-link {{ request()->routeIs('karyawan.*') ? 'active' : '' }}">
            <i class="bi bi-person-badge me-2"></i> Data Karyawan
        </a>
        @if(auth()->user()->isAdmin())
        <a href="{{ route('karyawan.create') }}" class="nav-link">
            <i class="bi bi-person-plus me-2"></i> Tambah Karyawan
        </a>
        @endif
        <a href="{{ route('report.index') }}" class="nav-link {{ request()->routeIs('report.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-bar-graph me-2"></i> Report
        </a>
        <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="bi bi-person-circle me-2"></i> Profile
        </a>
    </nav>
</div>

<nav class="navbar-top d-flex justify-content-between align-items-center">
    <span class="fw-semibold text-secondary">@yield('page-title', 'Dashboard')</span>
    <div class="d-flex align-items-center gap-3">
        <div class="d-flex align-items-center gap-2">
            @if(auth()->user()->profile_photo)
                <img src="{{ Storage::url(auth()->user()->profile_photo) }}" class="user-avatar" alt="foto">
            @else
                <div class="user-avatar bg-primary d-flex align-items-center justify-content-center text-white fw-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endif
            <div>
                <div class="fw-semibold small">{{ auth()->user()->name }}</div>
                <span class="badge {{ auth()->user()->isAdmin() ? 'bg-danger' : 'bg-success' }} text-white" style="font-size:10px">
                    {{ strtoupper(auth()->user()->role) }}
                </span>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-sm btn-outline-danger">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </button>
        </form>
    </div>
</nav>

<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>