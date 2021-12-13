<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingGajiPokok extends Model
{
    protected $table = "setting_gaji_pokok";

    protected $fillable = ['keterangan','jumlah'];
}
