<!DOCTYPE html>
<html lang="ja">
<head>
</head>
<body>
  <div id="app">
@extends('layouts.layout')
        @section('content')
  <div class="pt-5 mt-5 d-flex justify-content-center"><h5>{{Auth::user()->name}}さんご購入ありがとうございました。</h5></div>
  

  <div class=" d-flex justify-content-center py-2 pt-4"  > <button class="w-25 btn btn-info text-white" type="button" onclick="location.href='/'">ショッピングを続ける</button></div>

   </div>
  </body>
</html>