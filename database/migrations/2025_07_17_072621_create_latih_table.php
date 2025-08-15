<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('latih', function (Blueprint $table) {
        $table->id();
        $table->decimal('pekerjaan', 3, 2); // 0, 0.5, 1
        $table->decimal('penghasilan', 3, 2); // 0-1 (normalized)
        $table->decimal('status_pembayaran', 3, 2); // 0, 0.5, 1
        $table->decimal('lama_keanggotaan', 3, 2); // 0, 0.5, 1
        $table->decimal('jumlah_pinjaman', 3, 2); // 0-1 (normalized)
        $table->decimal('jumlah_tabungan', 3, 2); // 0-1 (normalized)
        $table->enum('status_kelayakan', ['Layak', 'Tidak Layak']);
        $table->foreignId('anggota_id')->constrained('anggota');
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('latih');
    }
	
};
