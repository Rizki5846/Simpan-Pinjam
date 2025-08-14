<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaTable extends Migration
{
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('pekerjaan');
            $table->decimal('penghasilan', 15, 2);
            $table->string('status_pinjaman');
            $table->decimal('jumlah_pinjaman', 15, 2); // sama
            $table->decimal('jumlah_tabungan', 15, 2); // sama
            $table->string('status_kelayakan');
            $table->integer('lama_keanggotaan_tahun')->nullable();
            $table->integer('lama_keanggotaan_bulan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}
