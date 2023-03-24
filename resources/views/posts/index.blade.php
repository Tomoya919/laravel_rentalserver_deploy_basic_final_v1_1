@extends('layouts.logged_in')

@section('title', $title)

@section('content')
  <h1>{{ $title }}</h1>
  <a href="{{route('posts.create')}}">新規投稿</a>
  <ul>
      @forelse($user->posts as $post)
          <li>
            {{ $post->user->name }}:
            {!! nl2br($post->comment) !!}<br>
            ({{ $post->created_at }})
            @if($user->isEditable($post))
              [<a href="{{ route('posts.edit', $post) }}">編集</a>]
            @endif
            <form action="{{ url('posts/'.$post->id) }}" method="post">
              @csrf 
              @method('delete')
              <button type="submit">削除</button>
            </form>
          </li>
      @empty
          <p>投稿がありません。</p>
      @endforelse
  </ul>
@endsection