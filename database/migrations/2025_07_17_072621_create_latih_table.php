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
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('pekerjaan');
            $table->decimal('penghasilan', 15, 2);
            $table->decimal('jumlah_tabungan', 15, 2); // sama dengan anggota
            $table->decimal('jumlah_pinjaman', 15, 2); // sama dengan anggota
            $table->enum('status_pinjaman', ['Lunas', 'Belum Lunas', 'Menunggak', 'Tidak Meminjam']);
            $table->enum('status_kelayakan', ['Layak', 'Tidak Layak', '-']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('latih');
    }
	
};
