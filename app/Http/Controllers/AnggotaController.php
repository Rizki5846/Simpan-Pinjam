<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Latih;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with('latih')->latest()->get();
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'nik.required' => 'NIK wajib diisi',
            'nik.digits' => 'NIK harus terdiri dari 16 digit angka',
            'nik.unique' => 'NIK sudah terdaftar',
            // Tambahkan pesan validasi lainnya sesuai kebutuhan
        ];

        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:anggota',
            'nama' => 'required',
            'pekerjaan' => 'required|in:PNS,Swasta,Wirausaha',
            'penghasilan' => 'required|numeric|min:0',
            'jumlah_tabungan' => 'required|numeric|min:0',
            'jumlah_pinjaman' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:Lancar,Menunggak,Belum Pernah',
            'lama_keanggotaan' => 'required|in:<1 Tahun,1-2 Tahun,>2 Tahun'
        ], $messages);

        Anggota::create($validated);

        return redirect()->route('anggota.index')->with('success', 'Data berhasil disimpan');
    }
    public function convertToLatih($id, Request $request)
    {
        $request->validate(['status_kelayakan' => 'required|in:Layak,Tidak Layak']);
        $anggota = Anggota::findOrFail($id);
        if ($anggota->latih) {
            return back()->with('error', 'Data latih sudah ada');
        }
        Latih::create($anggota->convertToLatih($request->status_kelayakan));
        return back()->with('success', 'Berhasil konversi ke data latih');
    }
}