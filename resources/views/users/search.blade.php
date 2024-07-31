@extends('layouts.login')

@section('content')

<form action="/search" method="post">
        @csrf
        <input type="text" name="keyword" class="form" placeholder="ユーザー名">
        <button type="submit" class="btn btn-success">検索</button>
        <div>{{$word}}</div>
</form>
<!-- 登録ユーザー表示 -->
<div class="user_display">
        <div class="user_contents">
                @foreach ($search_users as $user)
                <!-- 登録アイコン -->
                <div class="register_icon">
                        <img src="images/{{ $user->images }}" alt="登録アイコン">
                </div>
                <!-- 登録者名 -->
                <div class="center_user_content">
                        {{ $user->username }}
                </div>
                @if(!Auth::user()->isFollowing($user->id))
                <form action="{{ route('follow1', ['id' =>$user->id ]) }}" class="btn-text" method="post">@csrf
                        <button type="submit" class="btn btn-info">フォローする</button>
                </form>
                @else
                <form action="{{ route('follow2', ['id' =>$user->id ]) }}" class="btn-text" method="post">@csrf
                        <button type="submit" class="btn btn_danger">
                                フォロー解除する</button>
                </form>
                @endif
                @endforeach
        </div>
</div>
@endsection
