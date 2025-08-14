@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Anggota</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('anggota.store') }}" method="POST">
        @csrf

        <!-- NIK -->
        <div class="mb-3">
            <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
            <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" 
                   value="{{ old('nik') }}" maxlength="16" 
                   oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
            @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">NIK harus 16 digit angka</small>
        </div>

        <!-- Nama -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                   value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pekerjaan -->
        <div class="mb-3">
            <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" 
                   value="{{ old('pekerjaan') }}" required>
            @error('pekerjaan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Penghasilan -->
        <div class="mb-3">
            <label for="penghasilan" class="form-label">Penghasilan (Rp) <span class="text-danger">*</span></label>
            <input type="number" name="penghasilan" class="form-control @error('penghasilan') is-invalid @enderror" 
                   value="{{ old('penghasilan') }}" min="0" required>
            @error('penghasilan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Jumlah Tabungan -->
        <div class="mb-3">
            <label for="jumlah_tabungan" class="form-label">Jumlah Tabungan (Rp) <span class="text-danger">*</span></label>
            <input type="number" name="jumlah_tabungan" class="form-control @error('jumlah_tabungan') is-invalid @enderror" 
                   value="{{ old('jumlah_tabungan') }}" min="0" required>
            @error('jumlah_tabungan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Jumlah Pinjaman -->
        <div class="mb-3">
            <label for="jumlah_pinjaman" class="form-label">Jumlah Pinjaman (Rp) <span class="text-danger">*</span></label>
            <input type="number" name="jumlah_pinjaman" class="form-control @error('jumlah_pinjaman') is-invalid @enderror" 
                   value="{{ old('jumlah_pinjaman') }}" min="0" required>
            @error('jumlah_pinjaman')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status Pinjaman -->
        <div class="mb-3">
            <label for="status_pinjaman" class="form-label">Status Pinjaman <span class="text-danger">*</span></label>
            <select name="status_pinjaman" class="form-control @error('status_pinjaman') is-invalid @enderror" required>
                <option value="">Pilih Status</option>
                <option value="Lunas" {{ old('status_pinjaman') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="Belum Lunas" {{ old('status_pinjaman') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                <option value="Menunggak" {{ old('status_pinjaman') == 'Menunggak' ? 'selected' : '' }}>Menunggak</option>
                <option value="Tidak Meminjam" {{ old('status_pinjaman') == 'Tidak Meminjam' ? 'selected' : '' }}>Tidak Meminjam</option>
            </select>
            @error('status_pinjaman')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Lama Keanggotaan -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="lama_keanggotaan_tahun" class="form-label">Lama Keanggotaan (Tahun) <span class="text-danger">*</span></label>
                <input type="number" name="lama_keanggotaan_tahun" class="form-control @error('lama_keanggotaan_tahun') is-invalid @enderror"
                       value="{{ old('lama_keanggotaan_tahun') }}" min="0" required>
                @error('lama_keanggotaan_tahun')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="lama_keanggotaan_bulan" class="form-label">Lama Keanggotaan (Bulan) <span class="text-danger">*</span></label>
                <input type="number" name="lama_keanggotaan_bulan" class="form-control @error('lama_keanggotaan_bulan') is-invalid @enderror"
                       value="{{ old('lama_keanggotaan_bulan') }}" min="0" max="11" required>
                @error('lama_keanggotaan_bulan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Status Kelayakan -->
        <div class="mb-3">
            <label for="status_kelayakan" class="form-label">Status Kelayakan <span class="text-danger">*</span></label>
            <select name="status_kelayakan" class="form-control @error('status_kelayakan') is-invalid @enderror" required>
                <option value="">Pilih Status</option>
                <option value="Layak" {{ old('status_kelayakan') == 'Layak' ? 'selected' : '' }}>Layak</option>
                <option value="Tidak Layak" {{ old('status_kelayakan') == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
                <option value="-" {{ old('status_kelayakan') == '-' ? 'selected' : '' }}>-</option>
            </select>
            @error('status_kelayakan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
