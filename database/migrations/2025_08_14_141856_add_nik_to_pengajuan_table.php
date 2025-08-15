<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            // Tambahkan kolom baru
            $table->string('nik', 16)->after('id');
            
            // Tambahkan foreign key
            $table->foreign('nik')->references('nik')->on('anggota')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropForeign(['nik']);
            $table->dropColumn('nik');
        });
    }
};