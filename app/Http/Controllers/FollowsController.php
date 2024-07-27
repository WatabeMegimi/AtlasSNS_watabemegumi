<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

//use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function followList()
    { //フォローリスト
        return view('follows.followList');
    }
    public function followerList()
    { //フォロワーリスト
        return view('follows.followerList');
    }
}
