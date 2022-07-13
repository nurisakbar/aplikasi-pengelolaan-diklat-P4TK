<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToGtk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gtk', function (Blueprint $table) {
            $table->index(['village_id', 'district_id','province_id','instansi_id','kompetensi_keahlian_id'],'index_relation');
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
