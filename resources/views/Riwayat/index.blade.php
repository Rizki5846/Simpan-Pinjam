@extends('layouts.app') {{-- atau sesuaikan dengan layout kamu --}}

@section('content')
<div class="container">
    <h2 class="mb-4">Riwayat Pinjaman Saya</h2>

    @if ($pinjaman->isEmpty())
        <div class="alert alert-info">
            Belum ada data pinjaman.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Pinjaman</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        {{-- Tambahkan kolom lain jika diperlukan --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pinjaman as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama ?? '-' }}</td>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($item->status) }}</td>
                        </tr>

                        {{-- Jika ingin menampilkan riwayat detail --}}
                        @if($item->riwayat && $item->riwayat->count())
                            <tr>
                                <td colspan="5">
                                    <strong>Riwayat:</strong>
                                    <ul>
                                        @foreach ($item->riwayat as $r)
                                            <li>{{ $r->keterangan ?? 'Tidak ada keterangan' }} - {{ $r->created_at->format('d-m-Y H:i') }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
