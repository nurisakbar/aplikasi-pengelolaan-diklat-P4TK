<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gtk extends Model
{
    protected $primaryKey = "nopes";

    protected $table = "gtk";

    protected $fillable = ['nopes','nama_gtk','sekolah_id','kelamin','umur','simkb_nomor_hp','simkb_email'];


    public function instansi(){
        return $this->belongsTo(\App\Instansi::class,'sekolah_id','instansi_id');
    }
}
