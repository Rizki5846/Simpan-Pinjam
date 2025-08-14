<?php
namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AnggotaImport;
use App\Models\Latih;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        // VALIDASI
        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:anggota,nik|unique:latih,nik',
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'penghasilan' => 'required|numeric|min:0',
            'jumlah_pinjaman' => 'required|numeric|min:0',
            'jumlah_tabungan' => 'required|numeric|min:0',
            'status_pinjaman' => 'required|string|max:50',
            'status_kelayakan' => 'required|string|max:50',
            'lama_keanggotaan_tahun' => 'integer|min:0',
            'lama_keanggotaan_bulan' => 'integer|min:0|max:11',
        ]);
  $lamaKeanggotaan = ($validated['lama_keanggotaan_tahun'] * 12) + $validated['lama_keanggotaan_bulan'];
        // SIMPAN KE TABEL ANGGOTA
        Anggota::create([
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'pekerjaan' => $validated['pekerjaan'],
            'penghasilan' => $validated['penghasilan'],
            'status_pinjaman' => $validated['status_pinjaman'],
            'jumlah_pinjaman' => $validated['jumlah_pinjaman'],
            'jumlah_tabungan' => $validated['jumlah_tabungan'],
            'status_kelayakan' => $validated['status_kelayakan'],
            'lama_keanggotaan' => $lamaKeanggotaan, // Simpan dalam bulan juga
        ]);

       


        // SIMPAN KE TABEL LATIH
        Latih::create([
        'nik' => $validated['nik'],
        'nama' => $validated['nama'],
        'pekerjaan' => $validated['pekerjaan'],
        'penghasilan' => $validated['penghasilan'],
        'jumlah_tabungan' => $validated['jumlah_tabungan'],
        'jumlah_pinjaman' => $validated['jumlah_pinjaman'],
        'status_pinjaman' => $validated['status_pinjaman'],
        'status_kelayakan' => $validated['status_kelayakan'],
        'lama_keanggotaan' => $lamaKeanggotaan, // Simpan dalam bulan juga
    ]);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil disimpan!');
    }


    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:anggota,nik,' . $id,
            'nama' => 'required',
            'pekerjaan' => 'required',
            'penghasilan' => 'required|numeric',
            'status_pembayaran' => 'required',
            'keanggotaan_koperasi' => 'required',
            'jumlah_pinjaman' => 'required|numeric',
            'jumlah_tabungan' => 'required|numeric',
            'status_kelayakan' => 'nullable'
        ]);

        $anggota->update($request->all());

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|file|mimes:xls,xlsx'
        ]);

        Excel::import(new AnggotaImport, $request->file('file_excel'));

        return redirect()->route('anggota.index')->with('success', 'Data berhasil diimport.');
    }
}
