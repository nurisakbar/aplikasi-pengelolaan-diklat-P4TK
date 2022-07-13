<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewGtksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::select("
        create view view_gtk as 
        select g.*,i.nama_instansi,ip.name as instansi_province,id.name as instansi_district,ir.name as instansi_regency,ip.id as instansi_province_id,ip.id as instansi_district_id,ir.id as instansi_regency_id
        from gtk as g join instansi as i on i.id=g.instansi_id
        left join provinces as ip on ip.id=i.province_id
        left join districts as id on id.id=i.district_id
        left join regencies as ir on ir.id=i.regency_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_gtks');
    }
}
