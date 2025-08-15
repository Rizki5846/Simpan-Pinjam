<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_klasifikasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uji_id');
            $table->foreign('uji_id')->references('id')->on('data_uji')->onDelete('cascade');
            $table->string('prediksi_kelayakan');
            $table->decimal('confidence', 5, 2);
            $table->json('neighbors'); // Menyimpan data tetangga terdekat
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_klasifikasi');
    }
};
