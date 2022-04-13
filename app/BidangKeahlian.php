<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidangKeahlian extends Model
{
    protected $table = "bidang_keahlian";

    protected $fillable = ['nama_bidang_keahlian','jenis'];

    public function programKeahlian()
    {
        return $this->hasMany(\App\ProgramKeahlian::class);
    }

    public function diklat()
    {
        return $this->hasMany(\App\Diklat::class, 'bidang_keahlian_id', 'id');
    }
}
