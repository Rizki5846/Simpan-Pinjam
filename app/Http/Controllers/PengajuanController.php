<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Models\Pengajuan;

class PengajuanController extends Controller
{
    public function create()
    {
        return view('pengajuan.create');
    }

    public function getAnggota(Request $request)
    {
        $request->validate([
            'nik' => 'required|string'
        ]);

        $anggota = Anggota::where('nik', $request->nik)->first();

        if (!$anggota) {
            return response()->json([
                'error' => 'Anggota dengan NIK tersebut tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'nama' => $anggota->nama,
                'pekerjaan' => $anggota->pekerjaan,
                'penghasilan' => $anggota->penghasilan,
                'status_pinjaman' => $anggota->status_pinjaman,
                'jumlah_pinjaman' => $anggota->jumlah_pinjaman,
                'jumlah_tabungan' => $anggota->jumlah_tabungan,
                'lama_keanggotaan_tahun' => $anggota->lama_keanggotaan_tahun,
                'lama_keanggotaan_bulan' => $anggota->lama_keanggotaan_bulan,
                'status_kelayakan' => $anggota->status_kelayakan
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string',
            'nama' => 'required|string',
            'pekerjaan' => 'required|string',
            'penghasilan' => 'required|numeric',
            'tabungan' => 'required|numeric',
            'pinjaman' => 'required|numeric',
        ]);

        $anggota = Anggota::where('nik', $request->nik)->first();

        $pengajuan = new Pengajuan();
        $pengajuan->nik = $request->nik;
        $pengajuan->nama = $request->nama;
        $pengajuan->pekerjaan = $request->pekerjaan;
        $pengajuan->penghasilan = $request->penghasilan;
        $pengajuan->tabungan = $request->tabungan;
        $pengajuan->pinjaman = $request->pinjaman;
        $pengajuan->status_pinjaman = $anggota ? $anggota->status_pinjaman : null;
        $pengajuan->anggota_id = $anggota ? $anggota->id : null;
        $pengajuan->user_id = auth()->id();
        $pengajuan->status_persetujuan = 'sedang proses'; // Set default status
        $pengajuan->save();

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil dibuat!');
    }

    public function index()
    {
        $pengajuan = Pengajuan::with('anggota')->latest()->get();
        return view('pengajuan.index', compact('pengajuan'));
    }

    // Tambahkan method untuk mengupdate status persetujuan
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak,sedang proses',
            'catatan' => 'nullable|string'
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status_persetujuan = $request->status;
        $pengajuan->catatan = $request->catatan;
        $pengajuan->save();

        return back()->with('success', 'Status pengajuan berhasil diperbarui');
    }
}