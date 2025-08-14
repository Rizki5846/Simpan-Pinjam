@extends('layouts.app')

@section('content')
<div class="container-fluid my-1 px-5">
    <div class="bg-white rounded shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary" style="font-family: 'Lora', serif;">
                📋 Data Latih
            </h2>
            @if (auth()->user()->level == 'Admin')
                <a href="{{ route('latih.create') }}" class="btn btn-success shadow-sm">
                    <i class="bi bi-person-plus-fill"></i> Tambah Anggota
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        @if ($latih->isEmpty())
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
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latih as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>Rp {{ number_format($item->penghasilan, 0, ',', '.') }}</td>
                                <td>
                                    @php $status = $item->status_pinjaman ?? $item->status_pembayaran; @endphp
                                    @if ($status === 'Lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @elseif ($status === 'Belum Lunas')
                                        <span class="badge bg-warning text-dark">Belum Lunas</span>
                                    @elseif ($status === 'Menunggak')
                                        <span class="badge bg-danger">Menunggak</span>
                                    @elseif ($status === 'Tidak Meminjam')
                                        <span class="badge bg-secondary">Tidak Meminjam</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $lama = $item->keanggotaan;
                                        if ($lama < 12) $kategori = 'Sebentar';
                                        elseif ($lama >= 12 && $lama <= 36) $kategori = 'Sedang';
                                        else $kategori = 'Lama';
                                    @endphp
                                    <span class="badge bg-info text-dark">{{ $kategori }} ({{ $lama }} bln)</span>
                                </td>
                                <td>Rp {{ number_format($item->pinjaman ?? $item->jumlah_pinjaman, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->tabungan ?? $item->jumlah_tabungan, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    @if ($item->status_kelayakan === 'Layak')
                                        <span class="badge bg-success">Layak</span>
                                    @elseif ($item->status_kelayakan === 'Tidak Layak')
                                        <span class="badge bg-danger">Tidak Layak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('anggota.edit', $item->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('latih.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
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
