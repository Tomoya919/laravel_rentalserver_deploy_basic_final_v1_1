@extends('layouts.logged_in')

@section('title', $title)

@section('content')
  <h1>{{ $title }}</h1>
  <form method="POST" action="{{ route('posts.store') }}">
      @csrf
      <div>
          <label>
            コメント:<br>
            <textarea name="comment" cols="30" rows="5"></textarea>
          </label>
      </div>
      <input type="submit" value="投稿">
  </form>
@endsection