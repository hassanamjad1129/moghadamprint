<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class priceCategory extends Model
{
  public $table="price_category";
  
  public function hasChild(){
    return priceCategory::where('parent_id',$this->id)->count();
  } 
  
  public function parentObject(){
    return $this->belongsTo(priceCategory::class,'parent_id');
  }
  public function fileObject(){
    return $this->hasOne(priceFile::class,'category_id');
  }
  
  public function slideshows(){
    return $this->hasMany(slideshow::class,'category_id');
  }
  
}
?>