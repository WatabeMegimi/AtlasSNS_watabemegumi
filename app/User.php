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
        'username', 'mail', 'password', 'followed_id', 'following_id'
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
    public function followUsers()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id'); //->whileTimestamps();
    }
    //ユーザーをフォローしている人数の取得
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id'); //->whileTimestamps();
    }
    //フォローの人数
    public function isFollowing(Int $user_id) //Int=正数型の変数
    {
        return (bool) $this->follows()->where('followed_id', $user_id)->first(['follows.id']);
    }
    //フォロワーの人数
    public function isFollowed(Int $user_id) //Int=正数型の変数
    {
        return (bool) $this->followers()->where('following_id', $user_id)->first(['follows.id']);
    }
    //フォローする
    public function follow(Int $user_id)
    {
        return $this->following()->attach($user_id);
    }
    //フォロー解除する
    public function nofollow(Int $user_id)
    {
        return $this->following()->detach($user_id);
    }
}
