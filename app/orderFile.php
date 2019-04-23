<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderFile extends Model
{
    public function myFile()
    {
        return $this->belongsTo(subCategoryFiles::class, 'file_id');
    }
}
