@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card stat-card h-100" style="border-left-color: #4299e1">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                    <i class="bi bi-people-fill text-primary fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Karyawan</div>
                    <div class="fs-2 fw-bold">{{ $totalKaryawan }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card h-100" style="border-left-color: #38a169">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle bg-success bg-opacity-10 p-3">
                    <i class="bi bi-person-check-fill text-success fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Karyawan Aktif</div>
                    <div class="fs-2 fw-bold text-success">{{ $aktif }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card h-100" style="border-left-color: #e53e3e">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                    <i class="bi bi-person-x-fill text-danger fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Tidak Aktif</div>
                    <div class="fs-2 fw-bold text-danger">{{ $tidakAktif }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body p-4">
        <h5 class="mb-1">Selamat datang, {{ auth()->user()->name }}! 👋</h5>
        <p class="text-muted mb-3">
            Anda login sebagai <strong>{{ strtoupper(auth()->user()->role) }}</strong>.
        </p>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('karyawan.create') }}" class="btn btn-primary me-2">
                <i class="bi bi-plus-circle me-1"></i>Tambah Karyawan
            </a>
        @endif
        <a href="{{ route('karyawan.index') }}" class="btn btn-outline-primary me-2">
            <i class="bi bi-list-ul me-1"></i>Lihat Data
        </a>

    </div>
</div>
@endsection