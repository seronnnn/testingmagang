<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::query();

        if ($request->filled('search')) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%')
                  ->orWhere('jabatan', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $karyawans = $query->latest()->paginate(10);

        return view('karyawan.index', compact('karyawans'));
    }

    public function create()
{
    return view('karyawan.create');
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'       => 'required|string|max:255',
            'nik'                => 'required|string|unique:karyawans,nik',
            'email'              => 'required|email',
            'no_telepon'         => 'required|string|max:20',
            'jabatan'            => 'required|string|max:100',
            'departemen'         => 'required|string|max:100',
            'tanggal_masuk'      => 'required|date',
            'status'             => 'required|in:aktif,tidak aktif',
            'alamat'             => 'required|string',
            'tanggal_lahir'      => 'required|date',
            'jenis_kelamin'      => 'required|in:Laki-laki,Perempuan',
            'pendidikan_terakhir'=> 'required|string',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cv'                 => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_karyawan', 'public');
        }

        if ($request->hasFile('cv')) {
            $validated['cv'] = $request->file('cv')->store('cv_karyawan', 'public');
        }

        $validated['created_by'] = auth()->id();

        Karyawan::create($validated);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan!');
    }

    public function show(Karyawan $karyawan)
    {
        return view('karyawan.show', compact('karyawan'));
    }

    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $validated = $request->validate([
            'nama_lengkap'       => 'required|string|max:255',
            'nik'                => 'required|string|unique:karyawans,nik,' . $karyawan->id,
            'email'              => 'required|email',
            'no_telepon'         => 'required|string|max:20',
            'jabatan'            => 'required|string|max:100',
            'departemen'         => 'required|string|max:100',
            'tanggal_masuk'      => 'required|date',
            'status'             => 'required|in:aktif,tidak aktif',
            'alamat'             => 'required|string',
            'tanggal_lahir'      => 'required|date',
            'jenis_kelamin'      => 'required|in:Laki-laki,Perempuan',
            'pendidikan_terakhir'=> 'required|string',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cv'                 => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($karyawan->foto) Storage::disk('public')->delete($karyawan->foto);
            $validated['foto'] = $request->file('foto')->store('foto_karyawan', 'public');
        }

        if ($request->hasFile('cv')) {
            if ($karyawan->cv) Storage::disk('public')->delete($karyawan->cv);
            $validated['cv'] = $request->file('cv')->store('cv_karyawan', 'public');
        }

        $karyawan->update($validated);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diupdate!');
    }

    public function destroy(Karyawan $karyawan)
    {
        if ($karyawan->foto) Storage::disk('public')->delete($karyawan->foto);
        if ($karyawan->cv)   Storage::disk('public')->delete($karyawan->cv);

        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus!');
    }
}