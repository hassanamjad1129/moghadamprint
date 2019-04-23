<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemService extends Model
{
    public function service(){
      return $this->belongsTo(service::class,'service_id');
    }
  
    public function item(){
      return $this->belongsTo(orderItem::class,'item_id');
    }
}
