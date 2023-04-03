<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserImageRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($id){
        $user = User::find($id);
        $posts = $user->posts()->latest()->get();
        
        return view('users.show',[
            'title' => 'プロフィール',
            'user' => $user,
            'posts' => $posts,
            'recommended_user' => User::recommend($user->id)->get()->first(),
        ]);
    }
    
    public function edit() {
        $user = \Auth::user();
        
        return view('users.edit', [
            'title' => 'プロフィール編集',
            'user' => $user,
        ]);
    }
    
    public function update(UserRequest $request) {
        $user = \Auth::user();
        $user->update($request->only(['name', 'email', 'profile']));

        session()->flash('success', 'プロフィールを編集しました');
        return redirect()->route('users.show', $user);

    }
}