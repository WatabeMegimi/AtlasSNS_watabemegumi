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
@endsection
