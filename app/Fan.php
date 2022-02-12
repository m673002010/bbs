<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    public function fuser(){
        return $this->hasOne(\App\User::class, "id", "fan_id");
    }

    public function suser(){
        return $this->hasOne(\App\User::class, "id", "star_id");
    }
}
