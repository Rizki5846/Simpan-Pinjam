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
            $table->enum('pekerjaan', ['PNS', 'Swasta', 'Wirausaha']);
            $table->decimal('penghasilan', 15, 2);
            $table->decimal('jumlah_tabungan', 15, 2);
            $table->decimal('jumlah_pinjaman', 15, 2)->default(0);
            $table->enum('status_pembayaran', ['Lancar', 'Menunggak', 'Belum Pernah']);
            $table->enum('lama_keanggotaan', ['<1 Tahun', '1-2 Tahun', '>2 Tahun']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}
