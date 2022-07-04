<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $fillable =['name','price','type_id','img_path','comment','stock'];

    public function type(){
        return $this->belongsTo('App\Type','type_id','id');
    }
    public function cart(){
        return $this->hasMany('APP\Cart',);
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
 
    public function likes() {
        return $this->hasMany('App\Like');
    }

    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('product_id', $this->id)->first() !==null;
    }
}
