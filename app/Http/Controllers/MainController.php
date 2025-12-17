<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pekerjaan;

class MainController extends Controller
{
    public function index()
    {
        // Hitung jumlah pegawai berdasarkan gender
        $male = Pegawai::where('gender', 'male')->count();
        $female = Pegawai::where('gender', 'female')->count();

        // Ambil jumlah pegawai per pekerjaan
        $pekerjaanData = Pekerjaan::withCount('pegawai')->get();

        $labels = $pekerjaanData->pluck('nama');   // Nama pekerjaan
        $counts = $pekerjaanData->pluck('pegawai_count'); // Jumlah pegawai

        return view('index', compact('male', 'female', 'labels', 'counts'));
    }
}
