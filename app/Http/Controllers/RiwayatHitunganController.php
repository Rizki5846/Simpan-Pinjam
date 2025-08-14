<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPenghitungan; // pastikan modelnya sesuai

class RiwayatHitunganController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel riwayatpenghitungan
        $riwayat = RiwayatPenghitungan::orderBy('created_at', 'desc')->get();

        // Kirim ke view
        return view('Riwayat_Penghitungan.index', compact('riwayat'));
    }
}
