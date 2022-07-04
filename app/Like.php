<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
     
    
     public function user()
    {
        return $this->belongsTo('App\User');
    }

    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }



    public function like_exist($id, $product_id)
    {

        $exist = Like::where('user_id', '=', $id)->where('product_id', '=', $product_id)->get();

    // レコード（$exist）が存在するなら
        if (!$exist->isEmpty()) {
            return true;
        } else {
        // レコード（$exist）が存在しないなら
            return false;
        }
    }
}
