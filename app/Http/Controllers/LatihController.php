<?php

namespace App\Http\Controllers;

use App\Models\Latih;
use Illuminate\Http\Request;

class LatihController extends Controller
{
    /**
     * Tampilkan semua data latih.
     */
    public function index()
    {
        $latih = Latih::all();
        return view('latih.index', compact('latih'));
    }

    /**
     * Tampilkan form untuk menambahkan data latih.
     */
    public function create()
    {
        return view('latih.create');
    }

    /**
     * Simpan data latih baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:20|unique:latih,nik', // Pastikan nama tabel benar
            'nama' => 'required|string|max:255', // Diubah jadi required
            'pekerjaan' => 'required|string|max:100', // Diubah jadi required
            'penghasilan' => 'required|numeric|min:0', // Diubah jadi numeric dan required
            'tabungan' => 'required|numeric|min:0', // Diubah jadi numeric dan required
            'pinjaman' => 'required|numeric|min:0', // Diubah jadi numeric dan required
            'status_pinjaman' => 'required|in:Lunas,Belum Lunas,Menunggak,Tidak Meminjam',
            'lama_keanggotaan_tahun' => 'required|integer|min:0', // Ditambahkan validasi
            'lama_keanggotaan_bulan' => 'required|integer|min:0|max:11', // Ditambahkan validasi
            'status_kelayakan' => 'required|in:Layak,Tidak Layak',
        ]);

        // Gabungkan tahun dan bulan menjadi satu field jika perlu
        $data = $request->all();
        $data['lama_keanggotaan'] = ($request->lama_keanggotaan_tahun * 12) + $request->lama_keanggotaan_bulan;

        Latih::create($data);

        return redirect()->route('latih.index')
                         ->with('success', 'Data latih berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail data latih.
     */
    public function show($id)
    {
        $latih = Latih::findOrFail($id);
        return view('latih.show', compact('latih'));
    }

    /**
     * Tampilkan form edit data latih.
     */
    public function edit($id)
    {
        $latih = Latih::findOrFail($id);
        return view('latih.edit', compact('latih'));
    }

    /**
     * Update data latih berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|string|max:20|unique:latihs,nik,'.$id,
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:100',
            'penghasilan' => 'required|numeric|min:0',
            'tabungan' => 'required|numeric|min:0',
            'pinjaman' => 'required|numeric|min:0',
            'status_pinjaman' => 'required|in:Lunas,Belum Lunas,Menunggak,Tidak Meminjam',
            'lama_keanggotaan_tahun' => 'required|integer|min:0',
            'lama_keanggotaan_bulan' => 'required|integer|min:0|max:11',
            'status_kelayakan' => 'required|in:Layak,Tidak Layak',
        ]);

        $latih = Latih::findOrFail($id);
        
        // Update data dengan gabungan tahun dan bulan
        $data = $request->all();
        $data['lama_keanggotaan'] = ($request->lama_keanggotaan_tahun * 12) + $request->lama_keanggotaan_bulan;
        
        $latih->update($data);

        return redirect()->route('latih.index')
                         ->with('success', 'Data latih berhasil diperbarui.');
    }

    /**
     * Hapus data latih.
     */
    public function destroy($id)
    {
        $latih = Latih::findOrFail($id);
        $latih->delete();

        return redirect()->route('latih.index')
                         ->with('success', 'Data latih berhasil dihapus.');
    }
}