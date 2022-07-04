<!DOCTYPE html>
<html lang="ja">

<head>
</head>

<body>
  <div id="app">
    @extends('layouts.layout')
    @section('content')
    <section>
      <div class="container py-5 h-auto mt-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col ">
            <div class="card">
              <div class="card-body p-4">

                <div class="row">

                  <div class="col-lg-12">

                    <h5 class="mb-3">
                      <div href="#!" class="text-body"><i class="" class="font-weight-bold">注文内容の確認</i> </div>
                    </h5>
                    <div>

                      <hr>
                      <div class="d-flex">

                        <div>
                          <h5 class="font-weight-bold">お届け先情報</h5>
                        </div>
                        <a class="pl-4 py-0 d-flex align-items-center" href="{{route('detail.user')}}">編集</a>

                      </div>

                      <div class='d-flex'>
                        <div class='ml-2'>
                          <div class=' ml-3 py-1'> 氏名:{{Auth::user()->name}}</div>
                          <div class=' ml-3 py-1'>郵便番号:{{Auth::user()->postal_code}}</div>
                          <div class=' ml-3 py-1'>住所:{{$pref}}{{Auth::user()->city}}{{Auth::user()->town}}{{Auth::user()->building}}</div>
                          <div class=' ml-3 py-1'>電話番号:{{Auth::user()->phone_number}}</div>
                        </div>

                      </div>

                      <hr>


                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>

                        </div>

                      </div>

                      <h5 class="font-weight-bold">お届け商品</h5>
                      <div class="container">

                        <div class='row-lg-12 d-flex'>
                          <div class='col-lg-2 d-flex justify-content-center'></div>
                          <div class='col-lg-2 d-flex justify-content-center'>商品名</div>
                          <div class='col-lg-2 d-flex justify-content-center'>価格</div>
                          <div class='col-lg-2 d-flex justify-content-center'>小計</div>
                          <div class='col-lg-2 d-flex justify-content-center'></div>
                          <div class='col-lg-2'>小計</div>
                        </div>
                      </div>


               
                      @foreach($my_carts as $my_cart)
                      <div class="card mb-3 h-20">

                        <div class="card-body container ">
                         <input type="hidden" >
                          <div class='row-lg-12 row-sm-12 d-flex '>
                            <div class='col-lg-2 col-sm-2 mh-100 mw-100 d-flex justify-content-center align-items-center '> <img class='' width=100 height='100' src=" {{ \Storage::url($my_cart->product->img_path) }}" alt="..." /> </div>
                            <div class='col-lg-2 col-sm-2 d-flex justify-content-center align-items-center'>{{$my_cart->product->name}}</div>
                            <div class='col-lg-2 col-sm-2 d-flex justify-content-center align-items-center'>¥{{$my_cart->product->price}}</div>
                            <div class='col-lg-2 col-sm-2 d-flex justify-content-center align-items-center'>{{$my_cart->qty}}</div>
                            <div class='col-lg-2 col-sm-2 d-flex justify-content-center align-items-center'></div>
                            <div class='col-lg-2 col-sm-2 d-flex justify-content-start align-items-center'>¥{{$my_cart->qty*$my_cart->product->price}}</div>
                          </div>
                        </div>
                      </div>
                      @endforeach

                      <div class="py-2 d-flex pr-5 mr-5 justify-content-end font-weight-bold">お支払い:{{ $total ?? '' }}円</div>

                      <hr>
                      <a href="{{route('complete')}}">
                        <div class="d-flex justify-content-center"><button type='submit' class=" w-25 btn btn-info text-white" type="button">購入する</button></div>
                      </a>

                      <div class=" d-flex justify-content-center py-2"> <button class="w-25 btn btn-info text-white" type="button" onclick="location.href='{{ route('mycart') }}'">カートに戻る</button></div>



                    </div>



                  </div>


                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endsection


  </div>
</body>

</html>