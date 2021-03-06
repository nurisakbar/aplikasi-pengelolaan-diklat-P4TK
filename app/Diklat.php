<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gtk;
use App\ProgramKeahlian;

class Diklat extends Model
{
    protected $table = "diklat";

    protected $fillable = ['bidang_keahlian_id','kompetensi_keahlian_id','nama_diklat', 'tahun', 'status_aktif', 'quota', 'departemen_id', 'kategori_diklat_id', 'tanggal_mulai', 'tanggal_selesai','jenis','program_keahlian_id','pola_diklat','description','image','tempat'];

    public function peserta()
    {
        return $this->hasMany(DiklatPeserta::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriDiklat::class, 'kategori_diklat_id', 'id');
    }

    public function programKeahlian()
    {
        return $this->belongsTo(ProgramKeahlian::class, 'program_keahlian_id', 'id');
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }
}
