<?php

// app/Http/Controllers/pengajuanController.php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

use App\Models\Uji;
use App\Models\Riwayatpengajuan; // Tambahkan ini

class PinjamanController extends Controller
{
           public function create()
    {
        return view('pinjaman.create');
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
                'status_pengajuan' => $anggota->status_pengajuan,
                'jumlah_pengajuan' => $anggota->jumlah_pengajuan,
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
            'pengajuan' => 'required|numeric',
        ]);

        $anggota = Anggota::where('nik', $request->nik)->first();

        $pengajuan = new Pengajuan();
        $pengajuan->nik = $request->nik;
        $pengajuan->nama = $request->nama;
        $pengajuan->pekerjaan = $request->pekerjaan;
        $pengajuan->penghasilan = $request->penghasilan;
        $pengajuan->tabungan = $request->tabungan;
        $pengajuan->pengajuan = $request->pengajuan;
        $pengajuan->status_pengajuan = $anggota ? $anggota->status_pengajuan : null;
        $pengajuan->anggota_id = $anggota ? $anggota->id : null;
        $pengajuan->user_id = auth()->id();
        $pengajuan->status_persetujuan = 'sedang proses'; // Set default status
        $pengajuan->save();

        return redirect()->route('pinjaman.index')->with('success', 'Pengajuan berhasil dibuat!');
    }

    public function index()
    {
        $pengajuan = Pengajuan::with('anggota')->latest()->get();
        return view('pinjaman.index', compact('pengajuan'));
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

    public function kirimKeUji($id)
{
    $pengajuan = Pengajuan::findOrFail($id);
    
    // Cek apakah sudah ada di tabel uji
    $existingUji = Uji::where('pangajuan_id', $id)->first();
    
    if ($existingUji) {
        return back()->with('error', 'Data pengajuan ini sudah ada di tabel uji');
    }

    // Buat record baru di tabel uji
    $uji = new Uji();
    $uji->nik = $pengajuan->nik;
    $uji->nama = $pengajuan->nama;
    $uji->pekerjaan = $pengajuan->pekerjaan;
    $uji->penghasilan = $pengajuan->penghasilan;
    $uji->pinjaman = $pengajuan->pinjaman;
    $uji->tabungan = $pengajuan->tabungan;
    $uji->status_persetujuan = $pengajuan->status_persetujuan;
    $uji->anggota_id = $pengajuan->anggota_id;
    $uji->user_id = auth()->id();
    $uji->pangajuan_id = $pengajuan->id;
    $uji->save();

    return back()->with('success', 'Data pengajuan berhasil dikirim ke tabel uji');
}
        
}