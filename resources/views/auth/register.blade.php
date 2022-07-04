@extends('layouts.layout')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col col-md-offset-3 col-md-6 pt-5 mt-5">
        <nav class="card">
          <div class="card-header">新規会員登録</div>
          <div class="card-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('register') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
              </div>
              <div class="form-group">
                <label for="name">ユーザー名</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
              </div>
              <div class="form-group">
                <label for="postal_code">郵便番号</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" />
              </div>
              <div class="form-group">
                <label for="pref_id">都道府県</label>
                <select class="form-control" id="pref_id" name="pref_id">
                @foreach(config('pref') as $pref_id => $name)
               <option value="{{ $pref_id }}" {{ old('pref_id') === $pref_id ? "selected" : ""}}>{{ $name }}</option>
               @endforeach
              </select>
              </div>
              <div class="form-group">
                <label for="city">市区町村</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" />
              </div>
              <div class="form-group">
                <label for="town">町名番地等</label>
                <input type="text" class="form-control" id="town" name="town" value="{{ old('town') }}" />
              </div>
              <div class="form-group">
                <label for="building">建物等</label>
                <input type="text" class="form-control" id="building" name="building" value="{{ old('building') }}" />
              </div>
              <div class="form-group">
                <label for="phone_number">電話番号</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" />
              </div>
              <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
              </div>
              <div class="form-group">
                <label for="password-confirm">パスワード（確認）</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" value="{{ old('password-confirm') }}">
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection