<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Uji;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class UjiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uji = Uji::with(['anggota', 'pengajuan'])->latest()->get();
        return view('uji.index', compact('uji'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pinjaman = Pinjaman::whereDoesntHave('uji')->get();
        return view('uji.create', compact('pinjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pinjaman_id' => 'required|exists:pinjaman,id'
        ]);

        $pengajuan = Pengajuan::findOrFail($request->pinjaman_id);

        $uji = Uji::create([
            'nik' => $pengajuan->nik,
            'nama' => $pengajuan->nama,
            'pekerjaan' => $pengajuan->pekerjaan,
            'penghasilan' => $pengajuan->penghasilan,
            'tabungan' => $pengajuan->tabungan,
            'pinjaman' => $pengajuan->pinjaman,
            'status_pinjaman' => $pengajuan->status_pinjaman,
            'anggota_id' => $pengajuan->anggota_id,
            'user_id' => auth()->id(),
            'pangajuan_id' => $pengajuan->id,
            'status_persetujuan' => 'sedang proses'
        ]);     

        return redirect()->route('uji.index')->with('success', 'Data berhasil ditambahkan ke proses uji');
    }

    /**
     * Display the specified resource.
     */
    public function show(Uji $uji)
    {
        return view('uji.show', compact('uji'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Uji $uji)
    {
        $request->validate([
            'status_persetujuan' => 'required|in:diterima,ditolak,sedang proses',
            'catatan' => 'nullable|string'
        ]);

        $uji->update([
            'status_persetujuan' => $request->status_persetujuan,
            'catatan' => $request->catatan
        ]);

        return back()->with('success', 'Status uji berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uji $uji)
    {
        $uji->delete();
        return redirect()->route('uji.index')->with('success', 'Data uji berhasil dihapus');
    }
}