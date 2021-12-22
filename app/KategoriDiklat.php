<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriDiklat extends Model
{
    protected $table = "kategori_diklat";

    protected $fillable = ['nama_kategori'];
}
