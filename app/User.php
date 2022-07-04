<?php

namespace App;

use App\Notifications\PasswordResetUserNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Passwords\CanResetPassword;
class User extends Authenticatable implements MustVerifyEmail 

{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','postal_code','pref_id','city','town','building','phone_number','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function cart(){
        return $this->hasMany('App\Cart');
    }

     
    // 
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    // ユーザーがいいねしている投稿
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    

    

    
}
