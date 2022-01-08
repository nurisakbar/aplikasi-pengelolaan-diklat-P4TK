<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CleanTableGtk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gtk', function (Blueprint $table) {
            $table->dropColumn('asal_sekolah');
            $table->dropColumn('nama_komunitas');
            $table->dropColumn('tipe_komunitas');
            $table->dropColumn('jenjang');
            $table->dropColumn('komunitas_negeri');
            $table->dropColumn('is_id');
            $table->dropColumn('status_anggota');
            $table->dropColumn('alamat_sekolah');
            $table->dropColumn('instansi_id');
            $table->dropColumn('dapodik_sekolah_id');
            $table->dropColumn('is_aktif_sekolah');
            $table->dropColumn('bentuk_pendidikan');
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
