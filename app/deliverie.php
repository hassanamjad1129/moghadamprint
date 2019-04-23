<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deliverie extends Model
{
    public function orderItems(){
      return $this->belongsToMany(orderItem::class,'deliveries_order','deliverie_id','order_item_id');
    }
  
  public function sendMethod(){
    return $this->belongsTo(sendMethod::class);
  }
  
  public function user(){
    return $this->belongsTo(User::class);
  }
}
