<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
class gallery extends Model{
    public function category(){
      return $this->belongsTo(galleryCategory::class,'category_id');
    }
}

