@extends('layouts.layout')

@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="card mt-5">
          <div class="card-header">商品追加</div>
          <div class="card-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{route('create.product.form')}}" enctype="multipart/form-data" method="POST">
              @csrf
              <div class="form-group">
                <label for="name">商品名</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
              </div>
              <div class="form-group">
                <label for="price">価格</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" />
              </div>
              <div class="form-group">
                <label for="type_id">カテゴリー</label>
                <select class="form-control" id="type_id" name="type_id">
               <option value=1>ブローチ</option>
               <option value=2>ネックレス</option>
               <option value=3>リング</option>
              </select>
              </div>
              <div class="form-group">
                <label for="stock">在庫数</label>
                <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" />
              </div>
              <div class="form-controll">
                <label for="img_path">画像</label>
                <input type="file"  class="" id="img_path" name="img_path" value="{{ old('img_path') }}" />
              </div>
              
              <div class="form-group">
                <label for="comment">商品説明</label>
                <textarea class='form-control' id='comment' name='comment' value="{{ old('comment') }}">{{old('comment')}}</textarea>
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