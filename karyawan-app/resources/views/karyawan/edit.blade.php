@extends('layouts.app')
@section('title', 'Edit Karyawan')
@section('page-title', 'Edit Karyawan')

@section('content')
<div class="card">
    <div class="card-body p-4">
        <h5 class="mb-4 fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Data: {{ $karyawan->nama_lengkap }}</h5>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('karyawan.update', $karyawan) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <h6 class="text-primary border-bottom pb-2 mb-3 mt-4">📋 Biodata</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Lengkap *</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $karyawan->nama_lengkap) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">NIK *</label>
                    <input type="text" name="nik" class="form-control" value="{{ old('nik', $karyawan->nik) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $karyawan->email) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">No. Telepon *</label>
                    <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon', $karyawan->no_telepon) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Lahir *</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jenis Kelamin *</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $karyawan->jenis_kelamin)=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $karyawan->jenis_kelamin)=='Perempuan'?'selected':'' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Pendidikan Terakhir *</label>
                    <select name="pendidikan_terakhir" class="form-select" required>
                        @foreach(['SD','SMP','SMA/SMK','D3','S1','S2','S3'] as $p)
                            <option value="{{ $p }}" {{ old('pendidikan_terakhir', $karyawan->pendidikan_terakhir)==$p?'selected':'' }}>{{ $p }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Alamat *</label>
                    <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $karyawan->alamat) }}</textarea>
                </div>
            </div>

            <h6 class="text-primary border-bottom pb-2 mb-3 mt-4">🏢 Data Pekerjaan</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jabatan *</label>
                    <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $karyawan->jabatan) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Departemen *</label>
                    <input type="text" name="departemen" class="form-control" value="{{ old('departemen', $karyawan->departemen) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Masuk *</label>
                    <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk', $karyawan->tanggal_masuk->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status *</label>
                    <select name="status" class="form-select" required>
                        <option value="aktif" {{ old('status', $karyawan->status)=='aktif'?'selected':'' }}>Aktif</option>
                        <option value="tidak aktif" {{ old('status', $karyawan->status)=='tidak aktif'?'selected':'' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <h6 class="text-primary border-bottom pb-2 mb-3 mt-4">📎 Upload File</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Ganti Foto</label>
                    @if($karyawan->foto)
                        <div class="mb-2">
                            <img src="{{ Storage::url($karyawan->foto) }}" class="rounded border"
                                style="max-width:100px;max-height:100px;object-fit:cover">
                            <small class="d-block text-muted mt-1">Foto saat ini</small>
                        </div>
                    @endif
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin ganti foto</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Ganti CV</label>
                    @if($karyawan->cv)
                        <div class="mb-2">
                            <a href="{{ Storage::url($karyawan->cv) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                <i class="bi bi-file-earmark-pdf me-1"></i>Lihat CV saat ini
                            </a>
                        </div>
                    @endif
                    <input type="file" name="cv" class="form-control" accept=".pdf,.doc,.docx">
                    <small class="text-muted">Kosongkan jika tidak ingin ganti CV</small>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="bi bi-save me-1"></i>Update
                </button>
                <a href="{{ route('karyawan.index') }}" class="btn btn-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection