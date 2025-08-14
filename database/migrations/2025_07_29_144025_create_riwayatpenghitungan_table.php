<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayatpenghitungan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('pekerjaan');
            $table->integer('penghasilan');
            $table->string('status_pembayaran');
            $table->integer('jumlah_pinjaman');
            $table->integer('jumlah_tabungan');
            $table->string('hasil_klasifikasi')->nullable(); // DIBERI nullable
            $table->float('jarak_terdekat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayatpenghitungan');
    }
};
