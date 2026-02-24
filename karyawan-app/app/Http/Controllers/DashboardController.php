<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();
        $aktif         = Karyawan::where('status', 'aktif')->count();
        $tidakAktif    = Karyawan::where('status', 'tidak aktif')->count();

        return view('dashboard', compact('totalKaryawan', 'aktif', 'tidakAktif'));
    }
}