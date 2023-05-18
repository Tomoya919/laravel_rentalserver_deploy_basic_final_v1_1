<?php
 
namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
 
// Requestをインポート（忘れずに！）
use Illuminate\Http\Request;
 
class LoginController extends Controller
{
 
    use AuthenticatesUsers;
 
    // ログイン後のリダイレクト先を変更
    protected $redirectTo = '/posts';
 
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
 
    // ログアウト後の動作をカスタマイズ
    protected function loggedOut(Request $request)
    {
        // ログイン画面にリダイレクト
        return redirect(route('login'));
    }
    
    public function username() {
        return 'name';
    }
}