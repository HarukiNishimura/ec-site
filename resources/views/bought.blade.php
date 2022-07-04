<!DOCTYPE html>
<html lang="ja">

<head>
</head>

<body>
  <div id="app">
    @extends('layouts.layout')
    @section('content')
    @if(count($softDeletes)>0)
    <div class="my-3">a</div>
    <table class='table  mt-5 border-bottom '>
      <thead>
        <tr>
          <th scope='col'></th>
          <th scope='col'>商品名</th>
          <th scope='col'>金額</th>
          <th scope='col'>個数</th>
          <th scope='col'>小計</th>
          <th scope='col'class=" justify-content-center">購入日</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに収入を表示する -->
        @foreach($softDeletes as $softDelete)
        
        <tr>
          <th scope='col' class="d-flex justify-content-center"><img class='' width=50 height='50' src=" {{ \Storage::url($softDelete->product->img_path) }}" alt="..." /> </th>
          <th scope='col'>{{ $softDelete->product->name}}</th>
          <th scope='col'>{{ $softDelete->product->price}}</th>
          <th scope='col'>{{ $softDelete->qty}}</th>
          <th scope='col'>{{ $softDelete->qty*$softDelete->product->price}}</th>
          <th scope='col' class=" justify-content-center">{{ $softDelete->deleted_at}}</th>
          
          @endforeach
      </tbody>
      @elseif(count($softDeletes)<=0)
      <div class='py-2'>a</div>
      <div class="d-flex jusitfy-content-center py-5"><h5>購入履歴がありません。</h5></div>
      @endif
  </div>
</body>

</html>