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
            $table->string('nik');
            $table->string('nama');
            $table->string('pekerjaan');
            $table->integer('penghasilan');
            $table->integer('tabungan');
            $table->integer('pinjaman');
            $table->string('status_pinjaman')->nullable();
            $table->string('status_persetujuan')->default('sedang proses'); // Tambahkan ini
            $table->text('catatan')->nullable(); // Opsional: untuk catatan persetujuan
            $table->unsignedBigInteger('user_id')->nullable();
            
            $table->unsignedBigInteger('anggota_id')->nullable();
            $table->foreign('anggota_id')
                ->references('id')
                ->on('anggota')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
