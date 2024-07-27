@extends('layouts.login')

@section('content')

<form action="/search" method="post">
        @csrf
        <input type="text" name="keyword" class="form" placeholder="ユーザー名">
        <button type="submit" class="btn btn-success">検索</button>
        <div>{{$word}}</div>
</form>
@foreach($search_users as $search_user)
{{$search_user->username}}
@endforeach
<!-- 登録ユーザー表示 -->
<div class="user_display">
        <div class="user_contents">
                @foreach ($search_users as $user)
                <ul>
                        <!-- 登録アイコン -->
                        <li class="register_icon">
                                <img src="images/{{ $user->images }}" alt="登録アイコン">
                        </li>
                        <!-- 登録者名 -->
                        <li class="center_user_content">
                                {{ $user->username }}
                        </li>
                        @if (auth()->user()->isFollowing($user->id))
                        <li class="nofollow_btn">
                                <form action="{{ route('follow2', ['id' =>$user->id ]) }}" class="btn-text" method="post">@csrf
                                        <button type="submit" class="btn btn_danger">
                                                フォロー解除する</button>
                                </form>
                        </li>する
                        @else
                        <li class="follow_btn">
                                <form action="{{ route('follow1', ['id' =>$user->id ]) }}" class="btn-text" method="post">@csrf
                                        <button type="submit" class="btn btn-info">フォローする</button>
                                </form>
                        </li>@endif
                </ul>
                @endforeach
        </div>
</div>
@endsection
