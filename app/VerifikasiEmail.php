<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifikasiEmail extends Model
{
    protected $table = "verifikasi_email";

    protected $fillable = ['nama_lengkap','email','nik','tanggal_lahir','token'];
}
