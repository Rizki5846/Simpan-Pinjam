@extends('layouts.app')

@section('content')
<div class="container-fluid my-1 px-5">
    <div class="bg-white rounded shadow-sm p-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h2 class="fw-bold text-primary" style="font-family: 'Lora', serif;">
                📋 Data Anggota Koperasi
            </h2>

            <div class="d-flex flex-wrap gap-2">
                @if (auth()->user()->level == 'Admin')
                    <a href="{{ route('anggota.create') }}" class="btn btn-success shadow-sm">
                        <i class="bi bi-person-plus-fill"></i> Tambah Anggota
                    </a>
                @endif

                @if (auth()->user()->level == 'Admin')
                    <form action="{{ route('anggota.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                        @csrf
                        <input type="file" name="file_excel" class="form-control form-control-sm" required>
                        <button class="btn btn-primary btn-sm" type="submit">
                            <i class="bi bi-upload"></i> Import Excel
                        </button>
                    </form>
                @endif
            </div>
        </div>

        {{-- Alert sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        {{-- Jika data kosong --}}
        @if ($anggota->isEmpty())
            <div class="alert alert-warning text-center shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i> Tidak ada data anggota koperasi.
            </div>
        @else
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-bordered table-hover align-middle mb-0 small">
                    <thead class="table-light text-center">
                        <tr class="table-primary">
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Pekerjaan</th>
                            <th>Penghasilan</th>
                            <th>Status Pembayaran</th>
                            <th>Keanggotaan</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Jumlah Tabungan</th>
                            <th>Status Kelayakan</th>
                            {{-- Kalau mau tambahkan lama keanggotaan nanti --}}
                            {{-- <th>Lama Keanggotaan</th> --}}
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $index => $ang)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $ang->nik }}</td>
                                <td>{{ $ang->nama }}</td>
                                <td>{{ $ang->pekerjaan }}</td>
                                <td class="text-end">Rp {{ number_format($ang->penghasilan, 2, ',', '.') }}</td>
                                <td class="text-center">{{ $ang->status_pinjaman }}</td>
                                <td>
                                     @php
                                    if ($ang->lama_keanggotaan < 12) $kategori = 'Sebentar';
                                    elseif ($ang->lama_keanggotaan <= 36) $kategori = 'Sedang';
                                    else $kategori = 'Lama';
                                @endphp
                                <span class="badge bg-info text-dark">{{ $kategori }} ({{ $ang->lama_keanggotaan }} bln)</span>
                                </td>
                                <td class="text-end">Rp {{ number_format($ang->jumlah_pinjaman, 2, ',', '.') }}</td>
                                <td class="text-end">Rp {{ number_format($ang->jumlah_tabungan, 2, ',', '.') }}</td>
                                <td class="text-center">{{ $ang->status_kelayakan }}</td>
                                
                                <td class="text-center">
                                    <a href="{{ route('anggota.edit', $ang->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('anggota.destroy', $ang->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
