<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingBonus extends Model
{
    protected $table = "setting_bonus";

    protected $fillable = ['dari','sampai','bonus'];
}
