<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        //Postテーブルからのレコード情報を取得
        $list = Post::get();
        //bladeへ帰す際にデータを送る
        return view('posts.index', ['list' => $list]);
    }
    //  投稿の登録処理
    public function postCreate(Request $request)
    {
        //投稿フォームに書かれた投稿を受け取る
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'post' => 'required|min:1|max:150',
            ]);
        }
        $post = $request->input('newPost');
        $user_id = Auth::user()->id;
        //dd($user_id);
        //投稿の登録
        Post::create(['user_id' => $user_id, 'post' => $post]);
        return redirect('/top');
    }
    public function Delete($id)
    {
        post::where('id', $id)->delete();
        return redirect('/top');
    }
    public function show()
    {
        // Postモデル経由でpostsテーブルのレコードを取得
        $posts = Post::get();
        return view('yyyy', compact('posts'));
    }
}
