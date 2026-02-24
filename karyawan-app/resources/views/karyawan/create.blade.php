@extends('layouts.app')
@section('title', 'Tambah Karyawan')
@section('page-title', 'Tambah Karyawan')

@section('content')
<div class="card">
    <div class="card-body p-4">
        <h5 class="mb-4 fw-bold"><i class="bi bi-person-plus me-2"></i>Form Tambah Karyawan</h5>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h6 class="text-primary border-bottom pb-2 mb-3 mt-4">📋 Biodata</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                    <input type="text" name="nik" class="form-control" value="{{ old('nik') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">No. Telepon <span class="text-danger">*</span></label>
                    <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="">Pilih...</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Pendidikan Terakhir <span class="text-danger">*</span></label>
                    <select name="pendidikan_terakhir" class="form-select" required>
                        <option value="">Pilih...</option>
                        @foreach(['SD','SMP','SMA/SMK','D3','S1','S2','S3'] as $p)
                            <option value="{{ $p }}" {{ old('pendidikan_terakhir') == $p ? 'selected' : '' }}>{{ $p }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat') }}</textarea>
                </div>
            </div>

            <h6 class="text-primary border-bottom pb-2 mb-3 mt-4">🏢 Data Pekerjaan</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
                    <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Departemen <span class="text-danger">*</span></label>
                    <input type="text" name="departemen" class="form-control" value="{{ old('departemen') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Masuk <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ old('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <h6 class="text-primary border-bottom pb-2 mb-3 mt-4">📎 Upload File</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Foto Karyawan</label>
                    <input type="file" name="foto" id="fotoInput" class="form-control"
                        accept="image/jpeg,image/png,image/jpg"
                        onchange="previewFoto(this)">
                    <small class="text-muted">Format: JPG, PNG. Max 2MB</small>
                    {{-- FIX: Error message placeholder for foto --}}
                    <div id="fotoError" class="text-danger small mt-1 d-none"></div>
                    <div class="mt-2">
                        {{-- FIX: Preview now properly hidden by default and can be cleared --}}
                        <img id="fotoPreview" src="#" alt="Preview" class="d-none rounded border"
                            style="max-width:120px;max-height:120px;object-fit:cover">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">CV / Dokumen</label>
                    {{-- FIX: Using proper MIME types instead of just extensions --}}
                    <input type="file" name="cv" id="cvInput" class="form-control"
                        accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                        onchange="validateCv(this)">
                    <small class="text-muted">Format: PDF, DOC, DOCX. Max 5MB</small>
                    {{-- FIX: Error message placeholder for CV --}}
                    <div id="cvError" class="text-danger small mt-1 d-none"></div>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i>Simpan
                </button>
                <a href="{{ route('karyawan.index') }}" class="btn btn-secondary px-4">
                    <i class="bi bi-x-circle me-1"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    /**
     * FIX 1: Preview foto now resets properly when file is cleared.
     * FIX 2: Added client-side file size validation (max 2MB).
     * FIX 3: Added client-side MIME type validation for extra security.
     */
    function previewFoto(input) {
        const preview = document.getElementById('fotoPreview');
        const errorEl = document.getElementById('fotoError');
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        // Reset state first
        preview.src = '#';
        preview.classList.add('d-none');
        errorEl.textContent = '';
        errorEl.classList.add('d-none');

        if (!input.files || !input.files[0]) return;

        const file = input.files[0];

        // Validate file type
        if (!allowedTypes.includes(file.type)) {
            errorEl.textContent = 'Format file tidak valid. Gunakan JPG atau PNG.';
            errorEl.classList.remove('d-none');
            input.value = '';
            return;
        }

        // Validate file size
        if (file.size > maxSize) {
            errorEl.textContent = 'Ukuran file terlalu besar. Maksimal 2MB.';
            errorEl.classList.remove('d-none');
            input.value = '';
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }

    /**
     * FIX 4: Added client-side validation for CV file (size + type).
     */
    function validateCv(input) {
        const errorEl = document.getElementById('cvError');
        const allowedTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
        const maxSize = 5 * 1024 * 1024; // 5MB

        // Reset state
        errorEl.textContent = '';
        errorEl.classList.add('d-none');

        if (!input.files || !input.files[0]) return;

        const file = input.files[0];

        // Validate file type
        if (!allowedTypes.includes(file.type)) {
            errorEl.textContent = 'Format file tidak valid. Gunakan PDF, DOC, atau DOCX.';
            errorEl.classList.remove('d-none');
            input.value = '';
            return;
        }

        // Validate file size
        if (file.size > maxSize) {
            errorEl.textContent = 'Ukuran file terlalu besar. Maksimal 5MB.';
            errorEl.classList.remove('d-none');
            input.value = '';
            return;
        }
    }
</script>
@endpush
@endsection