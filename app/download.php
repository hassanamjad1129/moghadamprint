<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class download extends Model
{
    public function category()
    {
        return $this->belongsTo(downloadCategory::class, 'category_id');
    }
}
