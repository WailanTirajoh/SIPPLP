<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtletSekolah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atlet_sekolah', function (Blueprint $table) {
            $table->id();
            $table->date('tahun_mulai');
            $table->date('tahun_selesai')->nullable();
            $table->foreignId('atlet_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('sekolah_id')->constrained()->onDelete('CASCADE');
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
        Schema::dropIfExists('atlet_sekolah');
    }
}
