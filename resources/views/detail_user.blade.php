@extends('layouts.layout')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center ">
    <div class="col col-md-offset-3 col-md-6">
      <nav class="card mt-5">
        <div class="card-header">お届け先情報変更</div>
        <div class="card-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          <form action="{{route('detail.userForm')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">氏名</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" />
            </div>
            <div class="form-group">
              <label for="postal_code">郵便番号</label>
              <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ Auth::user()->postal_code }}" />
            </div>
            <div class="form-group">
              <label for="pref_id">都道府県</label>
              <select class="form-control" id="pref_id" name="pref_id">
                <option value="{{ $prefId }}" selected>{{$pref}}</option>
                @foreach(config('pref') as $pref_id => $name)
                <option value="{{ $pref_id }}" {{ old('pref_id') === $pref_id ? "selected" : ""}}>{{ $name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="city">市区町村</label>
              <input type="text" class="form-control" id="city" name="city" value="{{ Auth::user()->city }}" />
            </div>
            <div class="form-group">
              <label for="town">町名番地等</label>
              <input type="text" class="form-control" id="town" name="town" value="{{ Auth::user()->town }}" />
            </div>
            <div class="form-group">
              <label for="building">建物等</label>
              <input type="text" class="form-control" id="building" name="building" value="{{ Auth::user()->building }}" />
            </div>
            <div class="form-group">
              <label for="phone_number">電話番号</label>
              <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{  Auth::user()->phone_number }}" />
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