@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data uji</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($uji as $key => $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pengajuan->nik }}</td>
                            <td>{{ $item->pengajuan->nama }}</td>
                            <td>
                                @php
                                    $pekerjaan = match(true) {
                                        $item->pekerjaan == 1.0 => 'PNS',
                                        $item->pekerjaan == 0.5 => 'Swasta',
                                        default => 'Wirausaha'
                                    };
                                @endphp
                                {{ $pekerjaan }} ({{ $item->pekerjaan }})
                            </td>
                            <td>{{ number_format($item->penghasilan, 2) }}</td>
                            <td>
                                @php
                                    $status = match(true) {
                                        $item->status_pembayaran == 0.0 => 'Lancar',
                                        $item->status_pembayaran == 0.5 => 'Belum Pernah',
                                        default => 'Menunggak'
                                    };
                                @endphp
                                {{ $status }} ({{ $item->status_pembayaran }})
                            </td>
                            <td>
                                @php
                                    $lama = match(true) {
                                        $item->lama_keanggotaan == 0.3 => '>2 Tahun',
                                        $item->lama_keanggotaan == 0.5 => '1-2 Tahun',
                                        default => '<1 Tahun'
                                    };
                                @endphp
                                {{ $lama }} ({{ $item->lama_keanggotaan }})
                            </td>
                            <td>{{ $item->jumlah_pinjaman}}</td>
                            <td>{{ $item->jumlah_tabungan}}</td>
                            <td>
                                <span class="badge badge-{{ $item->status_kelayakan == 'Layak' ? 'success' : 'danger' }}">
                                    {{ $item->status_kelayakan }}
                                </span>
                            </td>
                            <td>
                                {{-- <a href="{{ route('latih.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('latih.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection