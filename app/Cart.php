<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'product_id', 'user_id', 'qty', 'deleted_at',
    ];


    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
