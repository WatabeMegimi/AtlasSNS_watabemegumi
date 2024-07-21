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
<div class="profile"></div>
{!! Form::open(['url' => ['/profile/{id}/update'],'method' => 'post', "enctype" => "multipart/form-date"]) !!}
{!! Form::hidden('id',$user->id) !!}
<ul>
  <li>
    {{ Form::label('ユーザー名') }}
    {{ Form::text('username',$user->username,['class' =>'input'] ) }}
  </li>
  <li>
    {{ Form::label('メールアドレス') }}
    {{ Form::text('mail',$user->mail,['class' => 'input'] ) }}
  </li>
  <li>
    {{ Form::label('パスワード') }}
    {{ Form::password('password',['class' => 'input'] ) }}
  </li>
  <li>
    {{ Form::label('パスワード確認',) }}
    {{ Form::password('password_confirmation',['class' => 'input'] ) }}
  </li>
  <li>
    {{ Form::label('自己紹介') }}
    {{ Form::text('bio',$user->bio,['class'=> 'input']) }}
  </li>
  <li>
    {{ Form::label('画像') }}
    {{ Form::file('image',['class'=>'input','id'=>'iconimage']) }}
  </li>
  <li>
    {{Form::submit('送信', ['class'=>'btn btn-primary btn-block'])}}
  </li>
</ul>
{!!Form::close()!!}


@endsection
