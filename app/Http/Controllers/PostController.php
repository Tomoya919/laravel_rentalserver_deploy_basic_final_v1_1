<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;
use App\User;
 
class PostController extends Controller
{
    // 投稿一覧
    public function index(Request $request){
        $user = \Auth::user();
        $query = $request->input('keyword');
        $posts = $user->posts()->latest()->get();
        $follow_user_ids = $user->follow_users->pluck('id');
        $user_posts = $user->posts()->orWhereIn('user_id', $follow_user_ids )->latest()->get();
        return view('posts.index', [
          'title' => '投稿一覧',
          'user' => $user,
          'posts' => $user_posts,
        //   'results' => $results,
          'query' => $query,
          'recommend_users' => User::recommend($user->id)->get(),
        ]);
    }
 
    // 新規投稿フォーム
    public function create()
    {
        return view('posts.create', [
          'title' => '新規投稿',
        ]);
    }
 
    // 投稿追加処理
    public function store(PostRequest $request){
      Post::create([
        'user_id' => \Auth::user()->id,
        'comment' => $request->comment,
      ]);
      session()->flash('success', '投稿を追加しました');
      return redirect()->route('posts.index');
    }
 
    // 投稿編集フォーム
    public function edit($id)
    {
        // ルーティングパラメータで渡されたidを利用してインスタンスを取得
        $post = Post::find($id);
        return view('posts.edit', [
          'title' => '投稿編集',
          'post'  => $post,
        ]);
    }
 
    // 投稿更新処理
    public function update($id, PostRequest $request)
    {
        $post = Post::find($id);
        $post->update($request->only(['comment']));
        session()->flash('success', '投稿を編集しました');
        return redirect()->route('posts.index');
    }
 
    // 投稿削除処理
    public function destroy($id)
    {
        $post = Post::find($id);
 
        $post->delete();
        session()->flash('success', '投稿を削除しました');
        return redirect()->route('posts.index');
    }
      
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', [
          'title' => '投稿詳細',
          'post'  => $post,
        ]);
    }
    
    public function search(Request $request)
    {
        $user = \Auth::user();
        $query = $request->input('keyword');
        $keyword = $request->input('keyword');
    
        if ($keyword) {
            $posts = Post::where('comment', 'LIKE', "%$keyword%")
                ->where('user_id', '!=', auth()->user()->id) // 自分以外のユーザーの投稿のみを取得
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $userIds = auth()->user()->follow_users()->pluck('users.id')->toArray();
            $userIds[] = auth()->user()->id;
    
            $posts = Post::whereIn('user_id', $userIds)
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
    
        return view('posts.search', compact('keyword', 'posts'),[
                'user' => $user,
                'title' => '投稿一覧',
                'query' => $query,
                'recommend_users' => User::recommend($user->id)->get(),
            ]);
    }

}