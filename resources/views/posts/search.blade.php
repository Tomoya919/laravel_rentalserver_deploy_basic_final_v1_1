@extends('layouts.logged_in')

@section('content')
    <div>
        @if($posts->count() > 0)
            <h2>検索結果: {{ $search_keyword }}</h2>
            <ul>
                @foreach($posts as $post)
                    <li>{{ $post->comment }}</li>
                @endforeach
            </ul>
        @else
            <p>該当する投稿がありません。</p>
        @endif
    </div>
@endsection