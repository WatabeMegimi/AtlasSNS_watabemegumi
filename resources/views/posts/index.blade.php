@extends('layouts.login')
@if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif

@section('content')
<div class="container">
<h2>機能を実装していきましょう。</h2>
{!! Form::open(['url' => '/top']) !!}
{{Form::token()}}
<div class="form-group">
  {{ Form::input('text','newPost',null,['class' => 'form-control','placeholder' => '投稿内容を入力してください
']) }}
</div>
<button type="submit" class="btn btn-success pull-right"><img src="images/post.png" alt="送信"></button>
  {!! Form::close() !!}
</div>
<div>
  <tr>
  @foreach($list as $list)
    <td>{{ $list->user_id }}</td>
    <td>{{ $list->post }}</td>
    <td>{{ $list->create_at }}</td>
    <td><a class="btn btn-danger" href="/post/{{$list->id}}/top" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>
  </tr>
@endforeach
@endsection
