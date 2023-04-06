@extends('layouts.default')
 
@section('header')
<header>
    <ul class="header_nav_1">
        <li class="header_logo">
          <a href="{{ route('posts.index') }}">
            <p>ブログサイト</p>
          </a>
        </li>
        <div class="header_link">
          <li>
            <a href="{{route('follows.index')}}">フォローユーザー一覧</a>
          </li>
          <li>
            <a href="{{route('posts.create')}}">新規投稿</a>
          </li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <input type="submit" value="ログアウト">
            </form>
          </li>
        </div>
    </ul>
    <p>{{ Auth::user()->name }}さん、こんにちは！</p>
</header>
@endsection