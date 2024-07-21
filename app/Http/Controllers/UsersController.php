<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
            if ($request->hasFile('images')) {
                $image = $request->file('images')->store('public/images');
                $user->username = $request->username;
                $user->mail = $request->mail;
                $user->password = bcrypt($request->password);
                $user->bio = $request->bio;
                $user->images = basename($image);
                $user->save();

                return redirect('/top');

                //バリデーションが成功した場合、ここで画像をアップロードする
                //     //画像のオリジナルネームを習得
                //     $imageName = time() . '_' . $image->getClientOriginalName();
                //     $path = $image->storeAs('public', $imageName);
                //     //画像が正常に保存されたら、成功メッセージを表示するなどの適切処理を行う
                //     return back()->with('success', '画像がアップロードされました。');
                // }else {
                //     $path = null;
                // }
            }
        }
    }
    //public function login(){
    //return view('users.login');
    //}
}
