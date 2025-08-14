@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Proses Uji</h2>
    
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Data Pemohon</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>NIK</th>
                            <td>{{ $uji->nik }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $uji->nama }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td>{{ $uji->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <th>Penghasilan</th>
                            <td>Rp {{ number_format($uji->penghasilan, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Data Pinjaman</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Jumlah Pinjaman</th>
                            <td>Rp {{ number_format($uji->pinjaman, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Tabungan</th>
                            <td>Rp {{ number_format($uji->tabungan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge 
                                    @if($uji->status_persetujuan == 'diterima') bg-success
                                    @elseif($uji->status_persetujuan == 'ditolak') bg-danger
                                    @else bg-warning text-dark @endif">
                                    {{ ucfirst($uji->status_persetujuan) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Update Status Uji</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('uji.update', $uji->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="status_persetujuan" class="form-label">Status</label>
                    <select class="form-select" id="status_persetujuan" name="status_persetujuan" required>
                        <option value="sedang proses" {{ $uji->status_persetujuan == 'sedang proses' ? 'selected' : '' }}>Sedang Proses</option>
                        <option value="diterima" {{ $uji->status_persetujuan == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ $uji->status_persetujuan == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ $uji->catatan }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Status
                </button>
            </form>
        </div>
    </div>
</div>
@endsection