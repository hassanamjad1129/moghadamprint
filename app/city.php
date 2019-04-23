<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    public function sendMethods(){
      return $this->hasMany(sendMethod::class);
    }
  
  public function deliveries(){
    return $this->hasMany(deliverie::class);
  }
}
