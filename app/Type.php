<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Type extends Model
{
    protected $fillable = ['name','img_path'];

    public $timestamps = false;

    public function product(){
        return $this->hasMany('App\Product','type_id');
    }
}
