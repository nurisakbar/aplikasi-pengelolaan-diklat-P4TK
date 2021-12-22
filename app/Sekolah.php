<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = "sekolah";

    protected $fillable = ['nama_sekolah','jenjang','nopes_ketua','district_id','alamat','komunitas_id','is_id'];

    public function district()
    {
        return $this->belongsTo(\App\District::class);
    }
}
