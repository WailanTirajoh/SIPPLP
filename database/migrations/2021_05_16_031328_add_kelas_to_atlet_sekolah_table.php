<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKelasToAtletSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atlet_sekolah', function (Blueprint $table) {
            $table->enum('masuk_kelas', ['1', '2', '3']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atlet_sekolah', function (Blueprint $table) {
            $table->enum('masuk_kelas', ['1', '2', '3']);
        });
    }
}
