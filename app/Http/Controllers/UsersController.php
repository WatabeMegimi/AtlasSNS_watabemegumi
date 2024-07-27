<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function profile()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!empty($keyword)) {
            $word = '検索ワード;' . $keyword;
            $search_users = User::where('username', 'like', '%' . $keyword . '%')->get();
        } else {
            $word = '';
            $search_users = User::all();
        }
        return view('users.search', compact('search_users', 'word'));
    }
    public function update(Request $request)
    {
        // dd($request);
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'username' => 'required|min:2|max:12',
                'mail' => 'required|string|email|unique:users,mail,' . Auth::user()->id . '|min:5|max:40',
                'password' => 'required|alpha_num|min:8|max:20|confirmed',
                'password_confirmation' => 'required|alpha_num|min:8|max:20',
                'bio' => 'max:150',
                'images' => 'file|mimes:jpg,png,bmp,gif,svg',
            ]);
            $user = Auth::user();
            $image = Auth::user()->images;
            if ($request->hasFile('images')) {
                $image = $request->file('images')->store('public/images');
                $user->images = basename($image);
            }
            $user->username = $request->username;
            $user->mail = $request->mail;
            $user->password = bcrypt($request->password);
            $user->bio = $request->bio;
            $user->save();

            return redirect('/profile');
        }
    }
    public function follow($id)
    {
        $follower = Auth::user();
        // $follower = auth()->user();
        $is_following = $follower->isFollowing($id);
        if ($is_following) { //もしフォローしていなければ
            $follower->follow($id); //フォローする
            return back();
        }
    }
    //フォロー解除機能
    public function nofollow($id)
    {
        $follower = Auth::user();
        // $follower = auth()->user(); //フォローしているのか？
        $is_following =  $follower->isFollowing($id);
        if ($is_following) { //もしフォローしていれば
            $follower->nofollow($id); //フォロー解除する
            return back();
        }
    }
    // public function followingList(User $user)
    // {
    //     $following = $user->following;
    //     return view('users.following_list', compact('following'));
    // }
    // public function followerList(User $user)
    // {
    //     $followers = $user->followers;
    //     return view('users.followers_list', compact('followers'));
    // }
}


    //public function login(){
    //return view('users.login');
    //}
