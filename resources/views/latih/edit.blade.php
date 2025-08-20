@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Latih</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('latih.update', $latih->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Pekerjaan</label>
            <select name="pekerjaan" class="form-select" required>
                <option value="0" {{ $latih->pekerjaan == 0 ? 'selected' : '' }}>0 - Wirausaha</option>
                <option value="0.5" {{ $latih->pekerjaan == 0.5 ? 'selected' : '' }}>0.5 - Swasta</option>
                <option value="1" {{ $latih->pekerjaan == 1 ? 'selected' : '' }}>1 - PNS</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Penghasilan (Normalized 0-1)</label>
            <input type="number" step="0.01" name="penghasilan" class="form-control" 
                   value="{{ $latih->penghasilan }}" min="0" max="1" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Status Pembayaran</label>
            <select name="status_pembayaran" class="form-select" required>
                <option value="0" {{ $latih->status_pembayaran == 0 ? 'selected' : '' }}>0 - Lancar</option>
                <option value="0.5" {{ $latih->status_pembayaran == 0.5 ? 'selected' : '' }}>0.5 - Belum Pernah</option>
                <option value="1" {{ $latih->status_pembayaran == 1 ? 'selected' : '' }}>1 - Menunggak</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Lama Keanggotaan</label>
            <select name="lama_keanggotaan" class="form-select" required>
                <option value="0" {{ $latih->lama_keanggotaan == 0 ? 'selected' : '' }}>0 - <1 Tahun</option>
                <option value="0.5" {{ $latih->lama_keanggotaan == 0.5 ? 'selected' : '' }}>0.5 - 1-2 Tahun</option>
                <option value="1" {{ $latih->lama_keanggotaan == 1 ? 'selected' : '' }}>1 - >2 Tahun</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Jumlah Pinjaman (Normalized 0-1)</label>
            <input type="number" step="0.01" name="jumlah_pinjaman" class="form-control" 
                   value="{{ $latih->jumlah_pinjaman }}" min="0" max="1" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Jumlah Tabungan (Normalized 0-1)</label>
            <input type="number" step="0.01" name="jumlah_tabungan" class="form-control" 
                   value="{{ $latih->jumlah_tabungan }}" min="0" max="1" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Status Kelayakan</label>
            <select name="status_kelayakan" class="form-select" required>
                <option value="Layak" {{ $latih->status_kelayakan == 'Layak' ? 'selected' : '' }}>Layak</option>
                <option value="Tidak Layak" {{ $latih->status_kelayakan == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('latih.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection