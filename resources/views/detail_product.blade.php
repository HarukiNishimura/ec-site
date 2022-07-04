<!DOCTYPE html>
<html lang="ja">

<body>
    <div id="app">
        @extends('layouts.layout')
        @section('content')
            <section class="py-5 my-5 d-flex justify-content-center">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-6">
                            @if ($product['img_path'] != null)
                                <img class="card-img-top" width=450 height=450 src="{{ \Storage::url($product->img_path) }}"
                                    alt="..." />
                            @elseif($product['img_path'] == null)
                                <img class="card-img-top" width=450 height=450 src="/images/noimage.png" alt="..." />
                            @endif
                        </div>

                        <div class="col-lg-6 d-flex  w-100">
                            <div class="row ">
                                <div class="row col-lg-12">
                                    @can('admin-higher')
                                        <div class="col-lg-8 py-3">
                                            <h3>{{ $product->name }}</h3>
                                        </div>
                                        <div class="col-lg-4 py-3">
                                            <a href="{{ route('delete.product', ['productId' => $product->id]) }}"><button
                                                    class="btn btn-danger mt-3"
                                                    onClick="delete_alert(event);return false;">商品削除</button></a>
                                            <a href="{{ route('edit.product', ['productId' => $product->id]) }}"><button
                                                    class="btn btn-primary  mt-3 ">商品編集</button></a>
                                        </div>
                                    @else
                                        <div class="col-lg-12 py-3">
                                            <h3>{{ $product->name }}</h3>
                                        </div>
                                    @endcan
                                </div>
                                <div class="col-lg-12 py-3 d-flex">
                                    <h4>¥{{ $product->price }}</h4>
                                </div>
                                <div class="col-lg-12 py-3 border-top border-bottom">{!! nl2br(htmlspecialchars($product->comment)) !!}</div>
                                @if ($product['stock'] >= 1)
                                    <div class="col-lg-12 d-flex align-items-end pt-1">

                                        <form class="w-100" action="{{ route('mycart.in') }}" method="post">
                                            @csrf

                                            <input type="hidden" name='product_id' id='product_id'
                                                value="{{ $product->id }}">


                                            <div class="d-flex">
                                                <input id="qty" min="1" max="{{ $product->stock }}"
                                                    name="qty" value="1" type="number"
                                                    class="form-control form-control-sm my-2 w-25" />
                                                <div class="text-muted pl-3 pt-1 d-flex align-items-center">
                                                    ※残り{{ $product->stock }}点</div>
                                            </div>
                                            @auth
                                                <button type="submit" class="btn btn-primary btn-lg w-100">カートに入れる</button>
                                            @endauth
                                            @guest
                                                <div class="modal fade " id="testModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="basicModal" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content ">
                                                            <div class="">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">
                                                                        <h1>&times;</h1>
                                                                    </span>
                                                                </button>
                                                                <h4>
                                                                    <div class="modal-title" id="myModalLabel">
                                                                        <div class="d-flex justify-content-center mt-5"><i
                                                                                class=" fa fa-shopping-cart fa-4x"
                                                                                aria-hidden="true"></i></div>
                                                                    </div>
                                                                </h4>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <label
                                                                    class="d-flex justify-content-center py-3">会員登録してアイテムをカートに入れよう</label>
                                                            </div>
                                                            <div class="modal-footer ">
                                                                <a type="button" href="{{ route('register') }}"
                                                                    class="btn btn-primary w-100">会員登録する</a>
                                                                <a type="button" href="{{ route('login') }}"
                                                                    class="btn btn-primary w-100">アカウントをお持ちの方</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a type='button' data-toggle="modal" data-target="#testModal"
                                                    class="btn btn-primary btn-lg w-100">カートに入れる</a>
                                        </div>

                                    @endguest

                                    </form>
          
                            </div>
                            
                        @else
                            <div class="text-danger col-lg-12 d-flex align-items-end  pt-1">
                                <h3 class="d-flex justify-content-center w-100">Sold Out</h3>
                            </div>
                            @endif
                        </div>

                    </div>

                </div>

            </section>
            <div class="pt-4">
            <footer class="py-5 bg-dark ">
                <div class="container">
                    <p class="m-0 text-center text-white">Copyright &copy; Atelier Marry 2022</p>
                </div>
            </footer>
          </div>
        @endsection
    </div>

</body>

</html>
