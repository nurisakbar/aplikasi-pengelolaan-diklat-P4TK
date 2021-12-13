<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TarikDana extends Model
{
    protected $table = 'tarik_dana';
    protected $fillable = ['toko_id','tanggal','jumlah','user_id'];


    public function toko()
    {
        return $this->belongsTo(\App\Toko::class);
    }
}
