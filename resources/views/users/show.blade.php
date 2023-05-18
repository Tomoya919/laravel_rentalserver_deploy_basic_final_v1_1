@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  
  <dl>
    <dt>名前</dt>
    <dd>{{ $user->name }}</dd>
    <dd>
      @if(Auth::user()->isFollowing($user))
        <form method="post" action="{{route('follows.destroy', $user)}}" class="follow">
          @csrf
          @method('delete')
          <input type="submit" value="フォロー解除">
        </form>
      @else
        <form method="post" action="{{route('follows.store')}}" class="follow">
          @csrf
          <input type="hidden" name="follow_id" value="{{ $user->id }}">
          <input type="submit" value="フォローする">
        </form>
      @endif
    </dd>
  </dl>
  <ul>
    @forelse($posts as $post)
      <li>
        {{ $post->user->name }}:
        {!! nl2br($post->comment) !!}<br>
        ({{ $post->created_at }})
      </li>
    @empty
        <p>投稿がありません。</p>
    @endforelse
  </ul>
@endsection