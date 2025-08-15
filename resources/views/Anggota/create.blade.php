@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Anggota Baru</h2>
    
    @if ($errors->any())
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
        
        <div class="mb-3">
            <label class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                   value="{{ old('nik') }}" maxlength="16" required>
            @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Masukkan 16 digit NIK</small>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                   value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Pekerjaan</label>
            <select name="pekerjaan" class="form-select @error('pekerjaan') is-invalid @enderror" required>
                <option value="">Pilih Pekerjaan</option>
                <option value="PNS" {{ old('pekerjaan') == 'PNS' ? 'selected' : '' }}>PNS</option>
                <option value="Swasta" {{ old('pekerjaan') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                <option value="Wirausaha" {{ old('pekerjaan') == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
            </select>
            @error('pekerjaan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Penghasilan</label>
            <input type="number" name="penghasilan" class="form-control @error('penghasilan') is-invalid @enderror" 
                   value="{{ old('penghasilan') }}" min="0" required>
            @error('penghasilan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Jumlah Tabungan</label>
            <input type="number" name="jumlah_tabungan" class="form-control @error('jumlah_tabungan') is-invalid @enderror" 
                   value="{{ old('jumlah_tabungan') }}" min="0" required>
            @error('jumlah_tabungan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Jumlah Pinjaman</label>
            <input type="number" name="jumlah_pinjaman" class="form-control @error('jumlah_pinjaman') is-invalid @enderror" 
                   value="{{ old('jumlah_pinjaman', 0) }}" min="0" required>
            @error('jumlah_pinjaman')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Status Pembayaran</label>
            <select name="status_pembayaran" class="form-select @error('status_pembayaran') is-invalid @enderror" required>
                <option value="">Pilih Status</option>
                <option value="Lancar" {{ old('status_pembayaran') == 'Lancar' ? 'selected' : '' }}>Lancar</option>
                <option value="Menunggak" {{ old('status_pembayaran') == 'Menunggak' ? 'selected' : '' }}>Menunggak</option>
                <option value="Belum Pernah" {{ old('status_pembayaran') == 'Belum Pernah' ? 'selected' : '' }}>Belum Pernah Pinjam</option>
            </select>
            @error('status_pembayaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Lama Keanggotaan</label>
            <select name="lama_keanggotaan" class="form-select @error('lama_keanggotaan') is-invalid @enderror" required>
                <option value="">Pilih Lama Keanggotaan</option>
                <option value="<1 Tahun" {{ old('lama_keanggotaan') == '<1 Tahun' ? 'selected' : '' }}>< 1 Tahun</option>
                <option value="1-2 Tahun" {{ old('lama_keanggotaan') == '1-2 Tahun' ? 'selected' : '' }}>1-2 Tahun</option>
                <option value=">2 Tahun" {{ old('lama_keanggotaan') == '>2 Tahun' ? 'selected' : '' }}>> 2 Tahun</option>
            </select>
            @error('lama_keanggotaan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
// Validasi client-side untuk NIK (hanya angka)
document.querySelector('input[name="nik"]').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>
@endsection