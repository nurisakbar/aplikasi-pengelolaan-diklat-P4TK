<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlamatToNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gtk', function (Blueprint $table) {
            $table->string('domisi_alamat_jalan')->nullable()->change();
            $table->string('nik')->nullable()->change();
            $table->string('nuptk')->nullable()->change();
            $table->string('nomor_ukg')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gtk', function (Blueprint $table) {
            //
        });
    }
}
