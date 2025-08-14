@extends('layouts.app')

@section('content')
<div class="container-fluid my-5 px-5">
    <div class="bg-white rounded shadow-sm p-4">
        <h2 class="fw-bold text-primary mb-4" style="font-family: 'Lora', serif;">
            📝 Tambah Data Latih
        </h2>

        {{-- Tampilkan error validasi jika ada --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Tambah Anggota --}}
        <form action="{{ route('latih.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="penghasilan" class="form-label">Penghasilan (Rp)</label>
                    <input type="number" step="0.01" class="form-control" id="penghasilan" name="penghasilan" value="{{ old('penghasilan') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="tabungan" class="form-label">Jumlah Tabungan (Rp)</label>
                    <input type="number" step="0.01" class="form-control" id="tabungan" name="tabungan" value="{{ old('tabungan') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="pinjaman" class="form-label">Jumlah Pinjaman (Rp)</label>
                    <input type="number" step="0.01" class="form-control" id="pinjaman" name="pinjaman" value="{{ old('pinjaman') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="status_pinjaman" class="form-label">Status Pembayaran</label>
                    <select class="form-select" id="status_pinjaman" name="status_pinjaman" required>
                        <option disabled selected>-- Pilih Status --</option>
                        <option value="Lunas" {{ old('status_pinjaman') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="Belum Lunas" {{ old('status_pinjaman') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="Menunggak" {{ old('status_pinjaman') == 'Menunggak' ? 'selected' : '' }}>Menunggak</option>
                        <option value="Tidak Meminjam" {{ old('status_pinjaman') == 'Tidak Meminjam' ? 'selected' : '' }}>Tidak Meminjam</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="lama_keanggotaan" class="form-label">Lama Keanggotaan</label>
                    <div class="d-flex gap-2">
                        <input type="number" name="lama_keanggotaan_bulan" class="form-control" placeholder="Bulan" min="0" style="max-width: 120px;" value="{{ old('lama_keanggotaan_bulan') }}" required>
                        <input type="number" name="lama_keanggotaan_tahun" class="form-control" placeholder="Tahun" min="0" style="max-width: 120px;" value="{{ old('lama_keanggotaan_tahun') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="status_kelayakan" class="form-label">Status Kelayakan</label>
                    <select class="form-select" id="status_kelayakan" name="status_kelayakan" required>
                        <option disabled selected>-- Pilih Kelayakan --</option>
                        <option value="Layak" {{ old('status_kelayakan') == 'Layak' ? 'selected' : '' }}>Layak</option>
                        <option value="Tidak Layak" {{ old('status_kelayakan') == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
                    </select>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('latih.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Batal
                </a>
                <button type="submit" class="btn btn-success shadow-sm">
                    <i class="bi bi-save2-fill"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection