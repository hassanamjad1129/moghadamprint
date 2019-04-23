<?php

namespace App;
use App\orderItem;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public function items(){
      return $this->hasMany(orderItem::class,'order_id');
    }
}
