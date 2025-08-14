<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan; // sesuaikan jika nama model riwayat berbeda
use App\Models\Pinjaman;

class RiwayatController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $pinjaman = Pengajuan::with('riwayat')
            ->where('user_id', $userId) // atau sesuaikan kolom user
            ->get();

        return view('Riwayat.index', compact('pinjaman'));
    }
}
