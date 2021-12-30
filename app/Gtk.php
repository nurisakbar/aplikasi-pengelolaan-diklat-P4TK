<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gtk extends Model
{
    protected $primaryKey = "id";

    protected $table = "gtk";

    protected $fillable = ['nomor_ukg','nama_lengkap','instansi_id','jenis_kelamin','nomor_hp','email'];


    public function instansi()
    {
        return $this->belongsTo(\App\Instansi::class, 'instansi_id', 'id');
    }
}
