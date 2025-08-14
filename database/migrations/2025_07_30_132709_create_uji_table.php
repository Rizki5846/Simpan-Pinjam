<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('uji', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->string('pekerjaan');
            $table->decimal('penghasilan', 12, 2);
            $table->decimal('tabungan', 12, 2);
            $table->decimal('pinjaman', 12, 2);
            $table->string('status_pinjaman')->nullable();
            $table->string('status_persetujuan')->default('sedang proses');
            $table->text('catatan')->nullable();
            
            // Foreign keys
            $table->foreignId('anggota_id')->nullable()->constrained('anggota')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('pangajuan_id')->nullable()->constrained('pengajuan')->onDelete('set null');
            
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('uji');
    }
};