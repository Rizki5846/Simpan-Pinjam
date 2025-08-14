@extends('layouts.app')

@section('title', 'Data Petani')

@section('content')

  <!-- Title for Report Kebutuhan -->
   @if (auth()->user()->level == 'Admin')
  <div class="container-fluid mt-4">
    <h3 class="font-weight-bold text-dark">Report Kebutuhan</h3>
  </div>
  @endif

  @if (auth()->user() && auth()->user()->level == 'petani')
    <div class="container-fluid mt-4">
        <h3 class="font-weight-bold text-dark">Kebutuhan Petani</h3>
    </div>
@endif

  <!-- Main Content Container with Sidebar -->
  <div class="container-fluid mt-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3 bg-gradient-primary">
        <h6 class="m-0 font-weight-bold text-dark">Data Benih</h6>
      </div>
      <div class="card-body">
        @if (auth()->user()->level == 'petani')
          <a href="" class="btn btn-success mb-3"><i class="fas fa-plus"></i>Tambah Kebutuhan</a>
        @endif

        <!-- Table inside a responsive container -->
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover w-100" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Kebutuhan Benih</th>
                <th>Jumlah</th>
                @if (auth()->user()->level == 'Admin')
                  <th>Aksi</th>
                @endif
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($report as $d)
                <tr>
                  <th>{{ $loop->iteration }}</th>
                  <td>{{ $d->nama_petani }}</td>
                  <td>{{ $d->alamat }}</td>
                  <td>{{ $d->no_tlp }}</td>
                  <td>{{ $d->benih }}</td>
                  <td>{{ $d->jumlah_benih }}</td>
                  @if (auth()->user()->level == 'Admin')
                    <td>
                      @if ($d->keterangan != 'diterima')
                        <form action="{{ route('report.updateStatus', $d->id) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn btn-sm btn-primary" title="Setujui Report">
                            <i class="fas fa-check"></i> Setujui
                          </button>
                        </form>
                      @endif
                    </td>
                  @endif
                  <td>
                    @if ($d->keterangan == 'diterima')
                      <span class="badge badge-success">Diterima</span>
                    @else
                      <span class="badge badge-secondary">Belum Diterima</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

   <!-- PUPUK -->
  <div class="container-fluid mt-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3 bg-gradient-primary">
        <h6 class="mm-0 font-weight-bold text-dark">Data Pupuk</h6>
      </div>
      <div class="card-body">
        @if (auth()->user()->level == 'petani')
          <a href="#" class="btn btn-success mb-3"><i class="fas fa-plus"></i>Tambah Kebutuhan</a>
        @endif

        <!-- Table inside a responsive container -->
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover w-100" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Kebutuhan Pupuk</th>
                <th>Jumlah</th>
                @if (auth()->user()->level == 'Admin')
                  <th>Aksi</th>
                @endif
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pupuk as $d)
                <tr>
                  <th>{{ $loop->iteration }}</th>
                  <td>{{ $d->nama_petani }}</td>
                  <td>{{ $d->alamat }}</td>
                  <td>{{ $d->no_tlp }}</td>
                  <td>{{ $d->pupuk }}</td>
                  <td>{{ $d->jumlah_pupuk }}</td>
                  @if (auth()->user()->level == 'Admin')
                    <td>
                      @if ($d->keterangan != 'diterima')
                        <form action="{{ route('report.updateStatusPupuk', $d->id) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn btn-sm btn-primary" title="Setujui Report">
                            <i class="fas fa-check"></i> Setujui
                          </button>
                        </form>
                      @endif
                    </td>
                  @endif
                  <td>
                    @if ($d->keterangan == 'diterima')
                      <span class="badge badge-success">Diterima</span>
                    @else
                      <span class="badge badge-secondary">Belum Diterima</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
   <!-- Obat -->
  <div class="container-fluid mt-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3 bg-gradient-primary">
        <h6 class="m-0 font-weight-bold text-dark">Data Obat-Obatan</h6>
      </div>
      <div class="card-body">
        @if (auth()->user()->level == 'petani')
          <a href="#" class="btn btn-success mb-3"><i class="fas fa-plus"></i>Tambah Kebutuhan</a>
        @endif

        <!-- Table inside a responsive container -->
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover w-100" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Kebutuhan Obat</th>
                <th>Jumlah</th>
                @if (auth()->user()->level == 'Admin')
                  <th>Aksi</th>
                @endif
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($obat as $d)
                <tr>
                  <th>{{ $loop->iteration }}</th>
                  <td>{{ $d->nama_petani }}</td>
                  <td>{{ $d->alamat }}</td>
                  <td>{{ $d->no_tlp }}</td>
                  <td>{{ $d->obat }}</td>
                  <td>{{ $d->jumlah_obat }}</td>
                  @if (auth()->user()->level == 'Admin')
                    <td>
                      @if ($d->keterangan != 'diterima')
                        <form action="{{ route('report.updateStatusObat', $d->id) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn btn-sm btn-primary" title="Setujui Report">
                            <i class="fas fa-check"></i> Setujui
                          </button>
                        </form>
                      @endif
                    </td>
                  @endif
                  <td>
                    @if ($d->keterangan == 'diterima')
                      <span class="badge badge-success">Diterima</span>
                    @else
                      <span class="badge badge-secondary">Belum Diterima</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>