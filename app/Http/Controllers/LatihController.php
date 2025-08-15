<?php

namespace App\Http\Controllers;

use App\Models\Latih;
use App\Models\Anggota;
use Illuminate\Http\Request;

class LatihController extends Controller
{
    /**
     * Menampilkan daftar data latih
     */
    public function index()
    {
        $latih = Latih::with('anggota')->latest()->get();
        return view('latih.index', compact('latih'));
    }

    /**
     * Menampilkan form edit data latih
     */
    public function edit($id)
    {
        $latih = Latih::with('anggota')->findOrFail($id);
        return view('latih.edit', compact('latih'));
    }

    /**
     * Mengupdate data latih
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_kelayakan' => 'required|in:Layak,Tidak Layak'
        ]);

        $latih = Latih::findOrFail($id);
        $latih->update($validated);

        return redirect()->route('latih.index')
            ->with('success', 'Data latih berhasil diperbarui');
    }

    /**
     * Menghapus data latih
     */
    public function destroy($id)
    {
        $latih = Latih::findOrFail($id);
        $latih->delete();

        return back()->with('success', 'Data latih berhasil dihapus');
    }
}