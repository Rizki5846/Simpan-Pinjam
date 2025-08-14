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
    public function up(): void
    {
        Schema::table('latih', function (Blueprint $table) {
            $table->integer('lama_keanggotaan_tahun')->nullable()->after('status_pinjaman');
            $table->integer('lama_keanggotaan_bulan')->nullable()->after('lama_keanggotaan_tahun');
        });
    }

    public function down(): void
    {
        Schema::table('latih', function (Blueprint $table) {
            $table->dropColumn(['lama_keanggotaan_tahun', 'lama_keanggotaan_bulan']);
        });
    }
};
