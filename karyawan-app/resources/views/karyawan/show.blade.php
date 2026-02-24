@extends('layouts.app')
@section('title', 'Detail Karyawan')
@section('page-title', 'Detail Karyawan')

@section('content')
<div class="card">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <h5 class="fw-bold"><i class="bi bi-person-circle me-2"></i>Detail Karyawan</h5>
            <div class="d-flex gap-2">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('karyawan.edit', $karyawan) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                @endif
                <a href="{{ route('karyawan.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 text-center mb-4">
                @if($karyawan->foto)
                    <img src="{{ Storage::url($karyawan->foto) }}" class="img-fluid rounded-circle border shadow"
                        style="width:150px;height:150px;object-fit:cover" alt="foto">
                @else
                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center text-white fw-bold mx-auto"
                        style="width:150px;height:150px;font-size:60px">
                        {{ strtoupper(substr($karyawan->nama_lengkap, 0, 1)) }}
                    </div>
                @endif
                <h5 class="mt-3 mb-1">{{ $karyawan->nama_lengkap }}</h5>
                <span class="badge bg-info">{{ $karyawan->jabatan }}</span>
                <div class="mt-2">
                    <span class="badge {{ $karyawan->status=='aktif' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($karyawan->status) }}
                    </span>
                </div>
                @if($karyawan->cv)
                    <div class="mt-3">
                        <a href="{{ Storage::url($karyawan->cv) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                            <i class="bi bi-file-earmark-pdf me-1"></i>Download CV
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-9">
                <div class="row g-3">
                    @php
                    $fields = [
                        ['label'=>'NIK','value'=>$karyawan->nik],
                        ['label'=>'Email','value'=>$karyawan->email],
                        ['label'=>'No. Telepon','value'=>$karyawan->no_telepon],
                        ['label'=>'Tanggal Lahir','value'=>$karyawan->tanggal_lahir->format('d M Y')],
                        ['label'=>'Jenis Kelamin','value'=>$karyawan->jenis_kelamin],
                        ['label'=>'Pendidikan','value'=>$karyawan->pendidikan_terakhir],
                        ['label'=>'Departemen','value'=>$karyawan->departemen],
                        ['label'=>'Tgl Masuk','value'=>$karyawan->tanggal_masuk->format('d M Y')],
                    ];
                    @endphp
                    @foreach($fields as $f)
                    <div class="col-md-6">
                        <div class="bg-light rounded p-3">
                            <small class="text-muted d-block">{{ $f['label'] }}</small>
                            <strong>{{ $f['value'] }}</strong>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12">
                        <div class="bg-light rounded p-3">
                            <small class="text-muted d-block">Alamat</small>
                            <strong>{{ $karyawan->alamat }}</strong>
                        </div>
                    </div>
                    <div class="col-12">
                        <small class="text-muted">
                            Diinput oleh: {{ $karyawan->creator->name }} pada {{ $karyawan->created_at->format('d M Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection