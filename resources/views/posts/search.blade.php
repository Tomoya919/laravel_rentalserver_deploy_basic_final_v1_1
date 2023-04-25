@extends('layouts.logged_in')

@section('content')
    <form action="{{ route('posts.search') }}" method="GET">
      @csrf
      <input type="text" name="keyword" value="{{ old("keyword", $query) }}" placeholder="キーワードを入力してください">
      <button type="submit">検索</button>
    </form>
    @if(count($posts) > 0)
        <h2>おすすめユーザー</h2>
        <ul class="recommend_users">
          @forelse($recommend_users as $recommend_user)
            <li><a href="{{ route('users.show', $recommend_user) }}">{{ $recommend_user->name }}</a></li>
          @empty
            <li>他のユーザーが存在しません。</li>
          @endforelse
        </ul>
        @if($keyword)
            <h2>検索結果：{{ $keyword }}</h2>
        @else
            <h2>投稿一覧</h2>
        @endif
        <ul>
          @forelse($posts as $post)
            <li>
              {{ $post->user->name }}:
              {!! nl2br($post->comment) !!}<br>
              ({{ $post->created_at }})
              @if($user->isEditable($post))
                [<a href="{{ route('posts.edit', $post) }}">編集</a>]
              @endif
              @if($user->isEditable($post))
              <form action="{{ url('posts/'.$post->id) }}" method="post">
                @csrf 
                @method('delete')
                <button type="submit">削除</button>
              </form>
              @endif
            </li>
          @empty
              <p>投稿がありません。</p>
          @endforelse
        </ul>
    @else
        <h2>おすすめユーザー</h2>
        <ul class="recommend_users">
          @forelse($recommend_users as $recommend_user)
            <li><a href="{{ route('users.show', $recommend_user) }}">{{ $recommend_user->name }}</a></li>
          @empty
            <li>他のユーザーが存在しません。</li>
          @endforelse
        </ul>
        <p>検索結果がありません。</p>
    @endif
@endsection