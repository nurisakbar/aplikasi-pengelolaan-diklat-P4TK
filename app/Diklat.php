<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gtk;

class Diklat extends Model
{
    protected $table = "diklat";

    protected $fillable = ['nama_diklat','tahun','status_aktif','kompetensi_keahlian','quota','departement','kategori_diklat_id'];

    public function peserta()
    {
        return $this->hasMany(DiklatPeserta::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriDiklat::class,'kategori_diklat_id','id');
    }
}
