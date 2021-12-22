<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiklatPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diklat_peserta', function (Blueprint $table) {
            $table->id();
            $table->string('nopes');
            $table->integer('diklat_kelas_id');
            $table->integer('diklat_id');
            $table->string('status_kehadiran')->default('Menunggu Konfirmasi'); // Menunggu Konfirmasi , Terkonfirmasi, Batal
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('diklat_pesertas');
    }
}
