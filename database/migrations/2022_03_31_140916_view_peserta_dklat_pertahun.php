<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ViewPesertaDklatPertahun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::select("
        create view view_jumlah_peserta_diklat_pertahun as 
        select count(dp.peserta_id) as jumlah_peserta,d.tahun
        from diklat_peserta as dp 
        join diklat_kelas as dk on dp.diklat_kelas_id=dk.id
        join diklat as d on dk.diklat_id=d.id
        where dp.status_kehadiran='Peserta'
        group by d.tahun");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
