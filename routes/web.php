<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KnnController;
use App\Http\Controllers\LatihController;
use App\Http\Controllers\UjiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenghitunganKnnController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\RiwayatHitunganController;
use App\Models\RiwayatHitunganController as ModelsRiwayatHitunganController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(AuthController::class)->group(function () {
	Route::get('register', 'register')->name('register');
	Route::post('register', 'registerSimpan')->name('register.simpan');

	Route::get('login', 'login')->name('login');
	Route::post('login', 'loginAksi')->name('login.aksi');

	Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('/', function () {
	if (auth()->check()) {
		return redirect()->route('dashboard');
		} else {
        return redirect()->route('login');
    }
	
});

Route::middleware('auth')->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
	//Route::get('/Riwayat_Hitungan/layak', [RiwayatPenghitunganController::class, 'tampilkanAnggotaLayak'])->name('riwayat_hitungan.Layak');
	//Route::post('/latih/kirim/{id}', [LatihController::class, 'store'])->name('latih.store');
	//Route::post('/Riwayat_Hitungan/kirim-ke-data-uji', [RiwayatPenghitunganController::class, 'kirimKeDataUji'])->name('riwayat_hitungan.kirimKeDataUjih');
	Route::get('/riwayat', [RiwayatController::class, 'index'])->name('Riwayat.index');

	// Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
	Route::resource('/laporan', LaporanController::class);
	//Route::get('/riwayat-hitungan/layak', [RiwayatPenghitunganController::class, 'layak'])->name('Riwayat_Hitungan.Layak');
	//Route::post('/riwayat-hitungan/kirim-ke-data-uji', [RiwayatPenghitunganController::class, 'kirimKeDataUji'])->name('Riwayat_Hitungan.kirimKeDataUji');
// Route::post('/penghitungan-knn/process', [PenghitunganKnnController::class, 'process'])->name('PenghitunganKnn.process');
// 	//Route::post('/riwayat-hitungan/kirim-ke-data-uji', [RiwayatPenghitunganController::class, 'kirimKeDataUji'])->name('Riwayat_Hitungan.kirimKeDataUji');
// Route::post('/penghitungan-knn/klasifikasi', [PenghitunganKnnController::class, 'klasifikasi'])->name('PenghitunganKnn.klasifikasi');
// Route::get('/penghitungan-knn', [PenghitunganKnnController::class, 'index'])->name('PenghitunganKnn.index');
// Route::get('/data-uji', [PenghitunganKnnController::class, 'pilihUji'])->name('dataUji.pilih');
// Route::post('/klasifikasi', [PenghitunganKnnController::class, 'klasifikasi'])->name('PenghitunganKnn.klasifikasi');
// Route::get('/riwayat-penghitungan', [RiwayatHitunganController::class, 'index'])->name('Riwayat_Penghitungan.index');
// Route::post('/penghitungan-knn/proses', [PenghitunganKnnController::class, 'proses'])->name('PenghitunganKnn.proses');
// Route::get('/penghitungan-knn', [PenghitunganKnnController::class, 'index'])
//        ->name('PenghitunganKnn.index');



// Rute untuk proses penghitungan
Route::post('/penghitungan-knn/hitung', [PenghitunganKnnController::class, 'hitung'])
       ->name('PenghitunganKnn.hitung');

Route::post('/latih/kirim', [LatihController::class, 'store'])->name('latih.store'); 
Route::delete('/latih/{id}', [LatihController::class, 'destroy'])->name('latih.destroy');

Route::resource('anggota', AnggotaController::class);
Route::post('/anggota/{id}/convert', [AnggotaController::class, 'convertToLatih'])
     ->name('anggota.convert');

// Route::controller(AnggotaController::class)->prefix('Anggota')->group(function () {
// 	Route::get('', 'index')->name('Anggota.index');
// 	Route::get('create', 'create')->name('Anggota.create');
// 	Route::post('create', 'store')->name('Anggota.create.store');
// 	Route::get('edit/{id}', 'edit')->name('Anggota.edit');
// 	Route::post('edit/{id}', 'update')->name('Anggota.tambah.update');
// 	Route::get('hapus/{id}', 'hapus')->name('Anggota.hapus');
// 	Route::resource('anggota', AnggotaController::class);
// 	Route::post('anggota/import', [AnggotaController::class, 'import'])->name('anggota.import');
// });
// Route::controller(RiwayatPenghitunganController::class)->prefix('riwayathitungan')->group(function () {
// 	Route::get('', 'index')->name('riwayathitungan.index');
// 	Route::get('create', 'create')->name('riwayathitungan.create');
// 	Route::post('create', 'store')->name('riwayathitungan.create.store');
// 	Route::get('edit/{id}', 'edit')->name('riwayathitungan.edit');
// 	Route::post('edit/{id}', 'update')->name('riwayathitungan.tambah.update');
// 	Route::get('hapus/{id}', 'hapus')->name('riwayathitungan.hapus');
// 	//Route::post('/Anggota/import', [HasilHitunganController::class, 'import'])->name('anggo.import');
// 	Route::get('/riwayat-hitungan', [RiwayatPenghitunganController::class, 'index'])->name('Riwayat_Hitungan.index');


// });
Route::controller(LatihController::class)->prefix('latih')->group(function () {
	Route::get('', 'index')->name('latih.index');
	Route::get('create', 'create')->name('latih.create');
	Route::post('create', 'store')->name('latih.create.store');
	Route::get('edit/{id}', 'edit')->name('latih.edit');
	Route::post('edit/{id}', 'update')->name('latih.tambah.update');
	Route::get('hapus/{id}', 'hapus')->name('latih.hapus');
});

   Route::resource('uji', UjiController::class)->middleware('auth');

Route::prefix('knn')->group(function () {
    Route::get('/', [KnnController::class, 'index'])->name('knn.index');
    Route::get('/{id}', [KnnController::class, 'show'])->name('knn.show');
    Route::get('/{id}/classify', [KnnController::class, 'classify'])->name('knn.classify');
    Route::get('/knn/riwayat', [KnnController::class, 'riwayat'])->name('knn.riwayat');
    });

// Route::controller(UjiController::class)->prefix('uji')->group(function () {
// 	Route::get('', 'index')->name('uji.index');
// 	Route::get('create', 'create')->name('uji.create');
// 	Route::post('create', 'store')->name('uji.create.store');
// 	Route::get('edit/{id}', 'edit')->name('uji.edit');
// 	Route::post('edit/{id}', 'update')->name('uji.tambah.update');
// 	Route::get('hapus/{id}', 'hapus')->name('uji.hapus');
// 	Route::post('/data-uji/{id}', [UjiController::class, 'store'])->name('uji.store');
	
// 	//Route::post('/uji/kirim/{id}', [UjiController::class, 'kirimDariPinjaman'])->name('uji.kirim');
	

// });



// Route::prefix('pinjaman')->name('pinjaman.')->group(function () {
//     Route::get('/', [PinjamanController::class, 'index'])->name('index');
//     Route::post('/{id}/update-status', [PinjamanController::class, 'updateStatus'])->name('updateStatus');
//     Route::post('/{id}/kirim-ke-uji', [PinjamanController::class, 'kirimKeUji'])->name('kirimKeUji');
// });
Route::prefix('pengajuan')->group(function () {
    Route::get('/', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/check-nik', [PengajuanController::class, 'checkNik'])->name('pengajuan.check-nik');
    Route::post('/', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/{id}', [PengajuanController::class, 'show'])->name('pengajuan.show');
    Route::put('/pengajuan/{pengajuan}/status', [PengajuanController::class, 'updateStatus'])
    ->name('pengajuan.update-status');
    Route::post('/pengajuan/{id}/convert-uji', [PengajuanController::class, 'convertToUji'])->name('pengajuan.convert.uji');

});
	
// Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
//     Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
//     Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
//     Route::get('/get-anggota', [PengajuanController::class, 'getAnggota'])->name('pengajuan.get-anggota');
// 	Route::post('/pengajuan/{id}/update-status', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');

// Route::controller(PengajuanController::class)->prefix('pengajuan')->group(function () {
// // 	Route::get('', 'index')->name('pengajuan.index');
// // 	Route::get('create', 'create')->name('pengajuan.create');
// // 	Route::post('create', 'store')->name('pengajuan.create.store');
// // 	Route::get('edit/{id}', 'edit')->name('pengajuan.edit');
// // 	Route::post('edit/{id}', 'update')->name('pengajuan.tambah.update');
// // 	Route::get('hapus/{id}', 'hapus')->name('pengajuan.hapus');
// // 	Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
// // 	// routes/web.php
// // Route::get('/check-anggota/{nik}', [PengajuanController::class, 'checkAnggota'])->name('check.anggota');




// });

});

Route::middleware(['auth'])->group(function () {
    // Route group for pinjaman features
    Route::prefix('pinjaman')->group(function () {
        // Show loan application form
        Route::get('/create', [PinjamanController::class, 'create'])
            ->name('pinjaman.create');
        
        // Get member data by NIK (AJAX)
        Route::post('/get-anggota', [PinjamanController::class, 'getAnggota'])
            ->name('pinjaman.getAnggota');
        
        // Store new loan application
        Route::post('/store', [PinjamanController::class, 'store'])
            ->name('pinjaman.store');
        
        // Show list of loan applications
        Route::get('/', [PinjamanController::class, 'index'])
            ->name('pinjaman.index');
        
        // Update loan application status
        Route::post('/{id}/update-status', [PinjamanController::class, 'updateStatus'])
            ->name('pinjaman.updateStatus');
        
        // Additional routes you might need:
        // Show loan details
        Route::get('/{id}', [PinjamanController::class, 'show'])
            ->name('pinjaman.show');
            
        // Edit loan application
        Route::get('/{id}/edit', [PinjamanController::class, 'edit'])
            ->name('pinjaman.edit');
            
        // Update loan application
        Route::put('/{id}', [PinjamanController::class, 'update'])
            ->name('pinjaman.update');
            
        // Delete loan application
        Route::delete('/{id}', [PinjamanController::class, 'destroy'])
            ->name('pinjaman.destroy');
		Route::post('/pinjaman/{id}/kirim-uji', [PinjamanController::class, 'kirimKeUji'])
			->name('pinjaman.kirimUji')
			->middleware('auth');
    });
	});




	


	


	



