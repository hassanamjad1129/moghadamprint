<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderItem extends Model
{
    public function order()
    {
        return $this->belongsTo(order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }

    public function files()
    {
        return $this->hasMany(orderFile::class, 'item_id');
    }
  
    public function user(){
      return $this->belongsTo(User::class,'user_id');
    }
  
    public function itemServices(){
      return $this->hasMany(itemService::class,'item_id');
    }
}
