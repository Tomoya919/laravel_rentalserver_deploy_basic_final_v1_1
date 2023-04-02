<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostImageRequest;
use App\User;
 
class PostController extends Controller
{
    // 投稿一覧
    public function index(){
        $user = \Auth::user();
        $posts = $user->posts()->latest()->get();
        return view('posts.index', [
          'title' => '投稿一覧',
          'user' => $user,
          'posts' => $posts,
          'recommend_users' => User::recommend($user->id)->get()
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
 
    // 投稿詳細
    public function show($id)
    {
        return view('posts.show', [
          'title' => '投稿詳細',
        ]);
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
}