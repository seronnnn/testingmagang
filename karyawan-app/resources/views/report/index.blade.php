@extends('layouts.app')
@section('title', 'Report')
@section('page-title', 'Report Karyawan')

@section('content')
<div class="card">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4"><i class="bi bi-file-earmark-bar-graph me-2"></i>Report / Riwayat Data Karyawan</h5>

        {{-- Filter --}}
        <form method="GET" action="{{ route('report.index') }}" class="row g-2 mb-4">
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua</option>
                    <option value="aktif" {{ request('status')=='aktif'?'selected':'' }}>Aktif</option>
                    <option value="tidak aktif" {{ request('status')=='tidak aktif'?'selected':'' }}>Tidak Aktif</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold">Departemen</label>
                <input type="text" name="departemen" class="form-control" value="{{ request('departemen') }}" placeholder="Cari dept...">
            </div>
            <div class="col-md-2 d-flex align-items-end gap-1">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
                <a href="{{ route('report.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x"></i>
                </a>
            </div>
        </form>

        <div class="mb-3">
            <small class="text-muted">Total data: <strong>{{ $karyawans->total() }}</strong> karyawan</small>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Departemen</th>
                        <th>Status</th>
                        <th>Tgl Masuk</th>
                        <th>Diinput Oleh</th>
                        <th>Tgl Input</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($karyawans as $k)
                    <tr>
                        <td>{{ $loop->iteration + ($karyawans->currentPage()-1)*$karyawans->perPage() }}</td>
                        <td><span class="badge bg-secondary">{{ $k->nik }}</span></td>
                        <td class="fw-semibold">{{ $k->nama_lengkap }}</td>
                        <td>{{ $k->jabatan }}</td>
                        <td>{{ $k->departemen }}</td>
                        <td>
                            <span class="badge {{ $k->status=='aktif' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($k->status) }}
                            </span>
                        </td>
                        <td>{{ $k->tanggal_masuk->format('d M Y') }}</td>
                        <td>{{ $k->creator->name ?? '-' }}</td>
                        <td>{{ $k->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('karyawan.show', $k) }}" class="btn btn-sm btn-info text-white">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>Tidak ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $karyawans->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection