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

                    <h5 class="mb-3"><a href="#!" class="text-body"><i class=" me-2"></i>{{Auth::user()->name}}さんのカート</a></h5>
                    <div>
                      <p class="mb-0 "><span class="text-muted">{{ $message ?? '' }}</span> </p>

                      <hr>
                      @if(count($my_carts)<=0) <div>
                        <h5>カートに商品がありません</h5>
                    </div>

                    @else
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <div>

                      </div>

                    </div>


                    <div class="container">
                      <div class='row-lg-12 d-flex'>
                        <div class='col-lg-2 '></div>
                        <div class='col-lg-2 d-flex justify-content-center'>商品名</div>
                        <div class='col-lg-2 d-flex justify-content-center'>価格</div>
                        <div class='col-lg-2 d-flex justify-content-center'>個数</div>
                        <div class='col-lg-2 d-flex justify-content-center'>小計</div>
                        <div class='col-lg-2'></div>
                      </div>
                    </div>


                    @csrf
                    @foreach($my_carts as $my_cart)
                    <div class="card mb-3 h-20">

                      <div class="card-body container ">

                        <div class='row-lg-12 row-sm-12 d-flex '>
                          <div class='col-lg-2 col-sm-2 mh-100 mw-100 d-flex justify-content-center align-items-center '> <img class='' width=100 height='100' src=" {{ \Storage::url($my_cart->product->img_path) }}" alt="..." /> </div>
                          <div class='col-lg-2 col-sm-2 d-flex justify-content-center align-items-center'>{{$my_cart->product->name}}</div>
                          <div class='col-lg-2 col-sm-2 d-flex justify-content-center align-items-center'>¥{{$my_cart->product->price}}</div>
                          <div class='col-lg-2 col-sm-2 d-flex justify-content-center align-items-center'>{{$my_cart->qty}}</div>
                          <div class='col-lg-2 col-sm-2 d-flex justify-content-center align-items-center'>¥{{$my_cart->qty*$my_cart->product->price}}</div>
                          <div class='col-lg-2 col-sm-2 d-flex justify-content-center align-items-center'><a href="{{route('delete.cart',['cartId'=>$my_cart->id])}}">削除</a></div>
                        </div>
                      </div>
                    </div>
                    @endforeach

                    <div class="py-2 d-flex pr-5 justify-content-end font-weight-bold">合計:{{ $total ?? '' }}円</div>

                    <hr>
                    <a href="{{route('register.cart')}}">
                      <div class="d-flex justify-content-center"><button type='submit' class=" w-25 btn btn-info text-white" type="button">レジに進む</button></div>
                    </a>
                    <div class="d-flex justify-content-center"><button class="w-25 my-3 btn btn-info text-white" type="button" onclick="location.href='/'">買い物を続ける</button></div>


                  </div>

                  @endif

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