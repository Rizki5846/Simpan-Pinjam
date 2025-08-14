<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPenghitungan;

class RiwayatHitunganController extends Controller
{
    public function index()
    {
        // Gunakan get() untuk mengambil semua data tanpa pagination
        $riwayat = RiwayatPenghitungan::orderBy('created_at', 'desc')->get();

        return view('Riwayat_Penghitungan.index', compact('riwayat'));
    }
}