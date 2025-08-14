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
        Schema::table('riwayatpenghitungan', function (Blueprint $table) {
            $table->json('detail_hasil')->nullable()->after('jarak_terdekat');
        });
    }

    public function down()
    {
        Schema::table('riwayatpenghitungan', function (Blueprint $table) {
            $table->dropColumn('detail_hasil');
        });
    }
};
