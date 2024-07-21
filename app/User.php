<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //ユーザーがフォローしている人数の取得
    public function followUsers(){
        return $this->belongsToMany(User::Class,'follows','following_id','followed_id')->whileTimestamps();
    }
    //ユーザーをフォローしている人数の取得
    public function follows(){
        return $this->belongsToMany(User::Class,'follows','following_id','followed_id')->whileTimestamps();
    }
    //フォローの人数
    public function isFollowing($user_id){
        return (boolean) $this->follows()->where('followed_id',$user_id)->fist();
    }
    //フォロワーの人数
    public function isFollowed($user_id){
        return(boolean) $this->followers()->where('following_id',$user_id)->first(['follows.id']);
    }
}
