<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sendMethod extends Model
{
    public $timestamps = false;
  
  public function deliveries(){
    return $this->hasMany(deliverie::class);
  }
}
