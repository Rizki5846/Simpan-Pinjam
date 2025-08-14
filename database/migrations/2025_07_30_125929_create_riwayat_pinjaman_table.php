<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_riwayat_pinjaman_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPinjamanTable extends Migration
{
    public function up()
{
    Schema::create('riwayat_pinjaman', function (Blueprint $table) {
        $table->id();
        
        // Gunakan tipe data yang sama dengan pinjaman.id
        $table->unsignedBigInteger('pinjaman_id');
        
        $table->enum('status_sebelum', ['belum diproses', 'diterima', 'ditolak', 'lunas', 'uji'])->nullable();
        $table->enum('status_sesudah', ['belum diproses', 'diterima', 'ditolak', 'lunas', 'uji']);
        $table->text('keterangan')->nullable();
        $table->timestamps();

        // Pastikan nama tabel benar di sini
        $table->foreign('pinjaman_id')
              ->references('id')
              ->on('pinjaman') // Nama tabel yang benar
              ->onDelete('cascade');
    });
}

    public function down()
    {
        Schema::dropIfExists('riwayat_pinjaman');
    }
}
