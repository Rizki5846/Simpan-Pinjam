@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Detail Pengajuan Pinjaman</h4>
                <a href="{{ route('pengajuan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Data Pemohon</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">NIK</th>
                            <td>{{ $pengajuan->nik }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ $pengajuan->nama }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td>{{ $pengajuan->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <th>Penghasilan</th>
                            <td>Rp {{ number_format($pengajuan->penghasilan, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Informasi Pinjaman</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Jumlah Pinjaman</th>
                            <td>Rp {{ number_format($pengajuan->jumlah_pinjaman, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Tabungan</th>
                            <td>Rp {{ number_format($pengajuan->jumlah_tabungan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Status Pembayaran</th>
                            <td>{{ $pengajuan->status_pembayaran }}</td>
                        </tr>
                        <tr>
                            <th>Lama Keanggotaan</th>
                            <td>{{ $pengajuan->lama_keanggotaan }}</td>
                        </tr>
                        <tr>
                            <th>Status Pengajuan</th>
                            <td>
                                <span class="badge bg-{{ $pengajuan->status == 'Disetujui' ? 'success' : ($pengajuan->status == 'Ditolak' ? 'danger' : 'warning') }}">
                                    {{ $pengajuan->status }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mt-4">
    @if (auth()->user()->level == 'Admin')
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Proses Pengajuan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pengajuan.update-status', $pengajuan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Persetujuan</label>
                    <select class="form-select" name="status" id="statusSelect" required>
                        <option value="">Pilih Status</option>
                        <option value="Disetujui" {{ $pengajuan->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ $pengajuan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
            </div>

            <div class="mb-3" id="alasanField" style="display: none;">
                <label for="alasan_penolakan" class="form-label">Alasan Penolakan</label>
                <textarea class="form-control" name="alasan_penolakan" rows="3">{{ old('alasan_penolakan', $pengajuan->alasan_penolakan) }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Status
                </button>
            </div>
        </form>
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('statusSelect');
    const alasanField = document.getElementById('alasanField');

    // Tampilkan field alasan jika status Ditolak
    statusSelect.addEventListener('change', function() {
        alasanField.style.display = this.value === 'Ditolak' ? 'block' : 'none';
    });

    // Inisialisasi tampilan awal
    if (statusSelect.value === 'Ditolak') {
        alasanField.style.display = 'block';
    }
});
</script>
@endpush

            
        </div>
        <div class="card-footer text-muted">
            <small>Diajukan pada: {{ $pengajuan->created_at->format('d F Y H:i') }}</small>
        </div>
    </div>
</div>
@endsection