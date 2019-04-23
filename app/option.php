<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class option extends Model{
    protected $primaryKey = 'option_name';
    public $increment=false;
    public $keyType="string";
    public $timestamps=false;
}