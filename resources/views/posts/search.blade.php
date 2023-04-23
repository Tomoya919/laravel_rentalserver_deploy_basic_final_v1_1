@if(count($posts) > 0)
    @if($keyword)
        <h2>検索結果：{{ $keyword }}</h2>
    @else
        <h2>投稿一覧：</h2>
    @endif

    <ul>
        @foreach($posts as $post)
            <li>
                {{ $post->user->name }}<br>
                {{ $post->comment }}<br>
                {{ $post->created_at }}
            </li>
        @endforeach
    </ul>
    {{ $posts->links() }}
@else
    <p>検索結果がありません。</p>
@endif
