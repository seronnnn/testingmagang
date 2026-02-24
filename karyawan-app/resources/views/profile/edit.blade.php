@extends('layouts.app')
@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4"><i class="bi bi-person-gear me-2"></i>Edit Profile Saya</h5>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Foto Profile --}}
                    <div class="text-center mb-4">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ Storage::url(auth()->user()->profile_photo) }}" id="profilePreview"
                                class="rounded-circle border shadow mb-2"
                                style="width:120px;height:120px;object-fit:cover">
                        @else
                            <div id="profileInitial" class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center text-white fw-bold mb-2"
                                style="width:120px;height:120px;font-size:48px">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <img id="profilePreview" src="#" alt="Preview"
                                class="rounded-circle border shadow mb-2 d-none"
                                style="width:120px;height:120px;object-fit:cover">
                        @endif
                        <div>
                            <label class="btn btn-sm btn-outline-primary" for="photoInput">
                                <i class="bi bi-camera me-1"></i>Ganti Foto
                            </label>
                            <input type="file" id="photoInput" name="profile_photo" class="d-none"
                                accept="image/*" onchange="previewProfile(this)">
                        </div>
                        <small class="text-muted d-block">JPG/PNG, max 2MB</small>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', auth()->user()->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', auth()->user()->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password Baru</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Kosongkan jika tidak ingin ganti">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>

                <div class="mt-3 p-3 bg-light rounded">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Role Anda: <strong>{{ strtoupper(auth()->user()->role) }}</strong> |
                        Bergabung: {{ auth()->user()->created_at->format('d M Y') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewProfile(input) {
    const preview = document.getElementById('profilePreview');
    const initial = document.getElementById('profileInitial');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            if (initial) initial.classList.add('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection