<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public function followList(){//フォローリスト
        return view('follows.followList');
    }
    public function followerList(){//フォロワーリスト
        return view('follows.followerList');
    }
    public function follow(User $user){
        $follow = Auth::user();
            $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            $follower ->follow($user->id);
            return back();
        }
        //フォロー解除機能
        public function nofollow(User $user){
            $follower = Auth::user();
            $is_following=  $follower->isFollowing($user->id);
                        if($is_following) {
                $follower ->nofollow($user->id);
                return back();
            }
        }
    }
}
