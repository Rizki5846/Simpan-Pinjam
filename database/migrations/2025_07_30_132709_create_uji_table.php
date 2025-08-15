<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       Schema::create('data_uji', function (Blueprint $table) {
            $table->id();
            $table->decimal('pekerjaan', 3, 2);
            $table->decimal('penghasilan', 3, 2);
            $table->decimal('status_pembayaran', 3, 2);
            $table->decimal('lama_keanggotaan', 3, 2);
            $table->decimal('jumlah_pinjaman', 3, 2);
            $table->decimal('jumlah_tabungan', 3, 2);
            $table->enum('prediksi_kelayakan', ['Layak', 'Tidak Layak'])->nullable();
            $table->foreignId('pengajuan_id')->constrained('pengajuan');
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('uji');
    }
};