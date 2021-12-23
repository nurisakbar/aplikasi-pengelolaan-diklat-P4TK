<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidangKeahlian extends Model
{
    protected $table = "bidang_keahlian";

    protected $fillable = ['nama_bidang_keahlian'];
}
