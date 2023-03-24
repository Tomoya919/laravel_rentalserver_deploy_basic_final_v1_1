@extends('layouts.not_logged_in')
 
@section('content')
  <h1>ログイン</h1>
 
  <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="form-group_row">
          <label for="name">ユーザー名:</label>
          <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
      </div>
      
      <div>
          <label>
            パスワード:
            <input type="password" name="password" >
          </label>
      </div>
 
      <input type="submit" value="ログイン">
  </form>
@endsection