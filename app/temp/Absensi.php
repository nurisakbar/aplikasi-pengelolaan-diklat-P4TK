<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = "absensi";

    protected $fillable = ['status_kehadiran', 'user_id','tanggal','keterangan'];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
