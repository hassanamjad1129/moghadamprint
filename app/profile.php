<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $table = "user_profile";
    protected $primaryKey = "user_id";
}
