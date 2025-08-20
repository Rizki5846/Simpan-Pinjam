@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Import Data Anggota</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('anggota.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">File Excel</label>
                    <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                    <small class="text-muted">Format yang didukung: .xlsx, .xls, .csv</small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Import
                </button>
                <a href="{{ route('anggota.downloadTemplate') }}" class="btn btn-success">
                    <i class="fas fa-download"></i> Download Template
                </a>
                <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Kembali</a>
            </form>

            <div class="mt-4">
                <h5>Petunjuk Import:</h5>
                <ul>
                    <li>Gunakan template yang disediakan</li>
                    <li>NIK harus 16 digit angka dan unik</li>
                    <li>Pekerjaan: PNS, Swasta, Wirausaha</li>
                    <li>Status Pembayaran: Lancar, Menunggak, Belum Pernah</li>
                    <li>Lama Keanggotaan: <1 Tahun, 1-2 Tahun, >2 Tahun</li>
                    <li>Data numerik tidak boleh negatif</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection