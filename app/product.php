<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public function subcategory()
    {
        return $this->belongsTo(subCategory::class, 'subcategory_id');
    }
}
