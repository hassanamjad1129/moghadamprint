<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    public function cities(){
      return $this->hasMany(city::class);
    }
}
