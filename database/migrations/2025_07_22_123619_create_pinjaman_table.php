<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('pekerjaan');
            $table->integer('penghasilan');
            $table->integer('tabungan');
            $table->integer('pinjaman');
            $table->string('status')->default('pengajuan'); // status proses: pengajuan, uji
            $table->string('status_pinjaman')->default('belum diproses'); // status pinjaman: belum diproses, diterima, ditolak, lunas
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};
