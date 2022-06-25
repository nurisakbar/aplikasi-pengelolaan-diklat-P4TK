<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewGtkKeahlian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::select("
        create view view_gtk_keahlian as 
        select g.id,g.nama_lengkap,kk.id as kompetensi_keahlian_id,pk.id as program_keahlian_id,kk.id as bidang_keahlian_id
        from gtk as g left join kompetensi_keahlian as kk on g.kompetensi_keahlian_id=kk.id
        left join program_keahlian as pk on pk.id=kk.program_keahlian_id
        left join bidang_keahlian as bk on bk.id=pk.bidang_keahlian_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test', function (Blueprint $table) {
            //
        });
    }
}
