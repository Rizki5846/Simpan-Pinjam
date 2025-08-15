<?php



namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pengajuan;
use App\Models\Uji;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{

        public function index()
    {
        $pengajuan = Pengajuan::latest()->get();
        return view('pinjaman.index', compact('pengajuan'));
    }

    public function create()
    {
        return view('pengajuan.create');
    }

    public function checkNik(Request $request)
    {
        $request->validate(['nik' => 'required|digits:16']);
        
        $anggota = Anggota::where('nik', $request->nik)->first();

        if (!$anggota) {
            return response()->json([
                'error' => 'NIK tidak terdaftar'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'nama' => $anggota->nama,
                'pekerjaan' => $anggota->pekerjaan,
                'penghasilan' => $anggota->penghasilan,
                'jumlah_tabungan' => $anggota->jumlah_tabungan,
                'status_pembayaran' => $anggota->status_pembayaran,
                'lama_keanggotaan' => $anggota->lama_keanggotaan,
                'maks_pinjaman' => $anggota->jumlah_tabungan * 3
            ]
        ]);
    }

   public function store(Request $request)
{
    $request->validate([
        'nik' => 'required|exists:anggota,nik',
        'jumlah_pinjaman' => 'required|numeric|min:100000',
        'maks_pinjaman' => 'required|numeric'
    ]);

    $anggota = Anggota::where('nik', $request->nik)->firstOrFail();

    if ($request->jumlah_pinjaman > $request->maks_pinjaman) {
        return back()->withErrors([
            'jumlah_pinjaman' => 'Jumlah pinjaman melebihi batas maksimal'
        ])->withInput();
    }

    Pengajuan::create([
        'nik' => $request->nik,
        'nama' => $anggota->nama,
        'pekerjaan' => $anggota->pekerjaan,
        'penghasilan' => $anggota->penghasilan,
        'jumlah_tabungan' => $anggota->jumlah_tabungan,
        'jumlah_pinjaman' => $request->jumlah_pinjaman,
        'status_pembayaran' => $anggota->status_pembayaran,
        'lama_keanggotaan' => $anggota->lama_keanggotaan,
        'status' => 'Menunggu'
    ]);

    return redirect()->route('pengajuan.index')
           ->with('success', 'Pengajuan berhasil disimpan');
}
public function show($id)
{
    $pengajuan = Pengajuan::findOrFail($id);
    return view('pinjaman.show', compact('pengajuan'));
}
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Disetujui,Ditolak',
        'alasan_penolakan' => 'required_if:status,Ditolak|max:255'
    ]);

    $pengajuan = Pengajuan::findOrFail($id);

    $pengajuan->update([
        'status' => $request->status,
        'alasan_penolakan' => $request->alasan_penolakan,
        'tanggal_diproses' => now()
    ]);

    return back()->with('success', 'Status pengajuan berhasil diperbarui');
}

    public function convertToUji($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        // Cek kalau sudah pernah diubah jadi data uji
        if (Uji::where('pengajuan_id', $pengajuan->id)->exists()) {
            return back()->with('error', 'Data uji sudah ada untuk pengajuan ini');
        }

        Uji::create($pengajuan->convertToUji());

        return back()->with('success', 'Berhasil konversi ke data uji');
    }
        
}