@extends('layouts.app')

@section('content')
<div class="container py-4">
    <form action="{{ route('Riwayat_Penghitungan.kirimKeDataUji') }}" method="POST">
        @csrf

        <div class="card shadow-sm p-4 bg-white rounded">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="bi bi-person-lines-fill me-1"></i> Data Anggota yang Layak
                </h4>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-send"></i> Kirim ke Data Latih
                    </button>
                    <a href="{{ route('Riwayat_Penghitungan.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Pekerjaan</th>
                            <th>Penghasilan</th>
                            <th>Tabungan</th>
                            <th>Pinjaman</th>
                            <th>Status Pinjaman</th>
                            <th>Status Kelayakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayathitungan as $index => $riwayathitungan)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="riwayathitungan_ids[]" value="{{ $rriwayathitungan->id }}">
                            </td>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $riwayathitungan->nik }}</td>
                            <td>{{ $riwayathitungan->nama }}</td>
                            <td>{{ $riwayathitungan->pekerjaan }}</td>
                            <td>Rp {{ number_format($riwayathitungan->penghasilan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($riwayathitungan->tabungan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($riwayathitungan->pinjaman, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ 
                                    $riwayathitungan->status_pinjaman == 'Lunas' ? 'success' : 
                                    ($riwayathitungan->status_pinjaman == 'Menunggak' ? 'danger' : 
                                    ($riwayathitungan->status_pinjaman == 'Belum Lunas' ? 'warning text-dark' : 'secondary')) }}">
                                    {{ $riwayathitungan->status_pinjaman }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-{{ $riwayathitungan->status_kelayakan == 'riwayathitungan' ? 'success' : 'danger' }}">
                                    {{ $riwayathitungan->status_kelayakan ?? '-' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">Tidak ada data anggota yang Layak.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('selectAll').addEventListener('change', function () {
        let checkboxes = document.querySelectorAll('input[name="anggota_ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
@endsection
