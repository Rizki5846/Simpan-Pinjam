@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Form Pengajuan Pinjaman</h2>
    
<form id="formPengajuan" method="POST" action="{{ route('pengajuan.store') }}">
    @csrf
    
    <!-- Input NIK -->
    <div class="mb-3">
        <label for="nik" class="form-label">NIK Anggota</label>
        <input type="text" class="form-control" id="nik" name="nik" 
               required maxlength="16" onblur="checkNik()">
        <div id="nikFeedback" class="invalid-feedback"></div>
    </div>

    <!-- Data Anggota (Auto-fill) -->
    <div class="card mb-3 d-none" id="anggotaData">
        <div class="card-header">Data Anggota</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Nama</th>
                    <td id="namaAnggota">-</td>
                </tr>
                <tr>
                    <th>Pekerjaan</th>
                    <td id="pekerjaanAnggota">-</td>
                </tr>
                <tr>
                    <th>Penghasilan</th>
                    <td id="penghasilanAnggota">Rp 0</td>
                </tr>
                <tr>
                    <th>Jumlah Tabungan</th>
                    <td id="tabunganAnggota">Rp 0</td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td id="statusAnggota">-</td>
                </tr>
                <tr>
                    <th>Lama Keanggotaan</th>
                    <td id="lamaAnggota">-</td>
                </tr>
                <tr class="table-info">
                    <th>Maksimal Pinjaman</th>
                    <td id="maksPinjaman">Rp 0</td>
                </tr>
            </table>
            <input type="hidden" name="maks_pinjaman" id="maksPinjamanInput">
        </div>
    </div>

    <!-- Input Jumlah Pinjaman -->
    <div class="mb-3">
        <label for="jumlah_pinjaman" class="form-label">Jumlah Pinjaman</label>
        <input type="number" class="form-control" id="jumlah_pinjaman" 
               name="jumlah_pinjaman" required>
        <small class="text-muted">Maksimal: <span id="maxPinjamanText">Rp 0</span></small>
    </div>

    <button type="submit" class="btn btn-primary">Ajukan Pinjaman</button>
</form>

<script>
function checkNik() {
    const nik = document.getElementById('nik').value;
    const feedback = document.getElementById('nikFeedback');
    const form = document.getElementById('formPengajuan');
    
    if (nik.length !== 16) {
        feedback.innerText = 'NIK harus 16 digit';
        form.classList.add('was-validated');
        return;
    }

    fetch('{{ route("pengajuan.check-nik") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ nik: nik })
    })
    .then(response => response.json())
    .then(data => {
        const anggotaData = document.getElementById('anggotaData');
        
        if (data.error) {
            feedback.innerText = data.error;
            anggotaData.classList.add('d-none');
        } else {
            // Isi data otomatis
            document.getElementById('namaAnggota').innerText = data.data.nama;
            document.getElementById('pekerjaanAnggota').innerText = data.data.pekerjaan;
            document.getElementById('penghasilanAnggota').innerText = formatRupiah(data.data.penghasilan);
            document.getElementById('tabunganAnggota').innerText = formatRupiah(data.data.jumlah_tabungan);
            document.getElementById('statusAnggota').innerText = data.data.status_pembayaran;
            document.getElementById('lamaAnggota').innerText = data.data.lama_keanggotaan;
            document.getElementById('maksPinjaman').innerText = formatRupiah(data.data.maks_pinjaman);
            document.getElementById('maxPinjamanText').innerText = formatRupiah(data.data.maks_pinjaman);
            document.getElementById('maksPinjamanInput').value = data.data.maks_pinjaman;
            
            anggotaData.classList.remove('d-none');
            feedback.innerText = '';
        }
        form.classList.add('was-validated');
    });
}

function formatRupiah(angka) {
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>
@endsection