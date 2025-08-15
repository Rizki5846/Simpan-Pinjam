<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('pekerjaan', ['PNS', 'Swasta', 'Wirausaha']);
            $table->decimal('penghasilan', 15, 2);
            $table->decimal('jumlah_tabungan', 15, 2);
            $table->decimal('jumlah_pinjaman', 15, 2);
            $table->enum('status_pembayaran', ['Lancar', 'Menunggak', 'Belum Pernah']);
            $table->enum('lama_keanggotaan', ['<1 Tahun', '1-2 Tahun', '>2 Tahun']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
