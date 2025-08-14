@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Buat Pengajuan Baru</div>

                <div class="card-body">
                    <form id="pengajuanForm" method="POST" action="{{ route('pengajuan.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nik" class="col-md-4 col-form-label text-md-right">NIK Anggota</label>
                            <div class="col-md-6">
                                <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" 
                                       name="nik" value="{{ old('nik') }}" required autocomplete="off">
                                @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="text-muted">Masukkan NIK anggota untuk mengisi data otomatis</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Status Pinjaman</label>
                            <div class="col-md-6">
                                <input type="text" id="status_pinjaman" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Lama Keanggotaan</label>
                            <div class="col-md-6">
                                <input type="text" id="lama_keanggotaan" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama Lengkap</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" 
                                       name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pekerjaan" class="col-md-4 col-form-label text-md-right">Pekerjaan</label>
                            <div class="col-md-6">
                                <input id="pekerjaan" type="text" class="form-control @error('pekerjaan') is-invalid @enderror" 
                                       name="pekerjaan" value="{{ old('pekerjaan') }}" required>
                                @error('pekerjaan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="penghasilan" class="col-md-4 col-form-label text-md-right">Penghasilan</label>
                            <div class="col-md-6">
                                <input id="penghasilan" type="number" class="form-control @error('penghasilan') is-invalid @enderror" 
                                       name="penghasilan" value="{{ old('penghasilan') }}" required>
                                @error('penghasilan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tabungan" class="col-md-4 col-form-label text-md-right">Tabungan</label>
                            <div class="col-md-6">
                                <input id="tabungan" type="number" class="form-control @error('tabungan') is-invalid @enderror" 
                                       name="tabungan" value="{{ old('tabungan') }}" required>
                                @error('tabungan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pinjaman" class="col-md-4 col-form-label text-md-right">Jumlah Pinjaman</label>
                            <div class="col-md-6">
                                <input id="pinjaman" type="number" class="form-control @error('pinjaman') is-invalid @enderror" 
                                       name="pinjaman" value="{{ old('pinjaman') }}" required>
                                @error('pinjaman')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit Pengajuan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nikInput = document.getElementById('nik');
    
    nikInput.addEventListener('change', function() {
        const nik = this.value;
        
        if (!nik) return;
        
        fetch(`/get-anggota?nik=${encodeURIComponent(nik)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }
                
                // Auto-fill the fields
                document.getElementById('nama').value = data.data.nama;
                document.getElementById('pekerjaan').value = data.data.pekerjaan;
                document.getElementById('penghasilan').value = data.data.penghasilan;
                document.getElementById('status_pinjaman').value = data.data.status_pinjaman;
                
                const lamaKeanggotaan = `${data.data.lama_keanggotaan_tahun} tahun ${data.data.lama_keanggotaan_bulan} bulan`;
                document.getElementById('lama_keanggotaan').value = lamaKeanggotaan;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data anggota');
            });
    });
});
</script>
@endsection