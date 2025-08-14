@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #e6f0ff; /* biru muda */
    }

    .main-box {
        background: #fff;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        max-width: 900px;
        margin: 50px auto;
    }

    .card-header-custom {
        background-color: #0056b3;
        color: white;
        padding: 15px 25px;
        border-radius: 10px 10px 0 0;
        text-align: center;
        font-size: 1.25rem;
        font-weight: bold;
    }
</style>

<div class="main-box">
    <div class="card-header-custom">Tambah Data Uji</div>

    <div class="card-body mt-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('uji.create.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}">
                    @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}">
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan" value="{{ old('pekerjaan') }}">
                    @error('pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="penghasilan" class="form-label">Penghasilan</label>
                    <input type="number" class="form-control @error('penghasilan') is-invalid @enderror" name="penghasilan" value="{{ old('penghasilan') }}">
                    @error('penghasilan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tabungan" class="form-label">Tabungan</label>
                    <input type="number" class="form-control @error('tabungan') is-invalid @enderror" name="tabungan" value="{{ old('tabungan') }}">
                    @error('tabungan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="pinjaman" class="form-label">Pinjaman</label>
                    <input type="number" class="form-control @error('pinjaman') is-invalid @enderror" name="pinjaman" value="{{ old('pinjaman') }}">
                    @error('pinjaman')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-12 mb-4">
                    <label for="status_pinjaman" class="form-label">Status Pinjaman</label>
                    <select class="form-select @error('status_pinjaman') is-invalid @enderror" name="status_pinjaman">
                        <option value="">-- Pilih Status --</option>
                        <option value="Lunas" {{ old('status_pinjaman') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="Belum Lunas" {{ old('status_pinjaman') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="Menunggak" {{ old('status_pinjaman') == 'Menunggak' ? 'selected' : '' }}>Menunggak</option>
                        <option value="Tidak Meminjam" {{ old('status_pinjaman') == 'Tidak Meminjam' ? 'selected' : '' }}>Tidak Meminjam</option>
                    </select>
                    @error('status_pinjaman')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('uji.index') }}" class="btn btn-outline-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            
        </form>
    </div>
</div>
@endsection
