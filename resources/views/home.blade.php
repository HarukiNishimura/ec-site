<!DOCTYPE html>
<html lang="ja">

<head>
</head>

<body>
    <div id="app">
        @extends('layouts.layout')
        @section('content')
            <header class="bg-white py-5 border-bottom">
                <div class="container-fluid px-4 px-lg-5 my-5 pt-3">
                    <div class="text-center text-white">
                        <h1 class="display-4 fw-bolder  "><img class="" src="{{ asset('images/logo.png') }}"></h1>
                    </div>
                </div>
            </header>
            @if (session('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif

            <div class="modal fade " id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    <h1>&times;</h1>
                                </span>
                            </button>
                            <h4>
                                <div class="modal-title" id="myModalLabel">
                                    <div class="d-flex justify-content-center mt-5"><i class=" fa fa-heart liked fa-4x"
                                            aria-hidden="true"></i></div>
                                </div>
                            </h4>
                        </div>
                        <div class="modal-body ">
                            <label class="d-flex justify-content-center py-3">会員登録してアイテムをいいねしよう</label>
                        </div>
                        <div class="modal-footer ">
                            <a type="button" href="{{ route('register') }}" class="btn btn-primary w-100">会員登録する</a>
                            <a type="button" href="{{ route('login') }}" class="btn btn-primary w-100">アカウントをお持ちの方</a>
                        </div>
                    </div>
                </div>
            </div>
            <section class="py-5 border-bottom">
                <div class="container">
                    <div class=" d-flex justify-content-center py-5">
                        <h2 class=" border-bottom border-dark">Category</h2>
                    </div>
                    <div class=" row d-flex justify-content-around">
                        @foreach ($categories as $category)
                            <div class="col-sm-6 col-lg-4 ">
                                <a class="" href="{{ route('category.product', ['type' => $category->id]) }}">
                                    <img class="m-2 card-img " width="350" height="200"
                                        src="/images/{{ $category->img_path }}">
                                    <div
                                        class="card-img-overlay d-flex align-items-center justify-content-center opacity=0.5">
                                        <h3 class="text-white ">{{ $category->name }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="py-5 "id='area1'>
                <div class="container px-4 px-lg-5 mt-5">
                    <div class="row">

                        <div class=" col-lg-4 d-flex justify-content-end  h-50">
                            @can('admin-higher')
                                <button class="w-100  py-2 btn btn-info text-white" type="button"
                                    onclick="location.href='{{ route('create.product') }}'">商品登録</button>
                            @endcan

                        </div>

                        <div class=" col-lg-4 " id='area1'>
                            <h3 class=" d-flex justify-content-center pt-2">
                                <p class="border-bottom border-dark">All Items</p>
                            </h3>
                        </div>
                        <div class=" col-lg-4 ">
                            <form action="{{ url('/') }}" class="d-flex pt-2 justify-content-end" method="GET">
                                <p><input type="text" placeholder="キーワードを入力" name="keyword" value="{{ $keyword }}">
                                </p>
                                <p class="pl-2"><input type="submit" value="検索"></p>
                            </form>
                        </div>
                    </div>

                    @if ($products->count())
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                            @foreach ($products as $product)
                                <div class="col col-sm-6 col-lg-3 my-3 ">
                                    <a class="text-decoration-none"
                                        href="{{ route('detail.product', ['product' => $product->id]) }}">

                                        <div class="card h-100">
                                            <!-- Product image-->
                                            @if ($product['img_path'] != null)
                                                <img class="card-img-top" width=100 height=250
                                                    src="{{ \Storage::url($product->img_path) }}" alt="..." />
                                            @elseif($product['img_path'] == null)
                                                <img class="card-img-top" width=100 height=250 src="/images/noimage.png"
                                                    alt="..." />
                                            @endif
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                                                    <!-- Product price-->
                                                    ¥{{ $product->price }}
                                                    @if ($product['stock'] <= 0)
                                                        <div class='text-danger'>Sold Out</div>
                                                    @endif

                                                </div>

                                    </a>


                                </div>


                                @auth

                                    @if (!$product->isLikedBy(Auth::user()))
                                        <span class="likes w-25 rounded-pill border mousepointer-hand">
                                            <i class=" pr-3 fas fa-heart like-toggle"
                                                data-product-id="{{ $product->id }}"></i>
                                            <span class="like-counter">{{ $product->likes_count }}</span>
                                        </span>
                                    @else
                                        <span class="likes w-25 rounded-pill border mousepointer-hand">
                                            <i class="fas pr-3 fa-heart heart like-toggle liked"
                                                data-product-id="{{ $product->id }}"></i>
                                            <span class="like-counter">{{ $product->likes_count }}</span>
                                        </span>
                                    @endif
                                @endauth
                                @guest
                                    <a class="mousepointer-hand text-decoration-none text-dark"data-toggle="modal"
                                        data-target="#testModal">
                                        <span class="likes w-25 pr-3 rounded-pill border">

                                            <i class="fas fa-heart heart "></i>
                                            <span class="like-counter">{{ $product->likes_count }}</span>
                                    </a>
                                    </span>
                                    </a>
                                @endguest

                        </div>
                </div>
                @endforeach
            @else
                <p class="py-5 d-flex justify-content-center">見つかりませんでした。</p>
                @endif

            </section>
            <div class="d-flex justify-content-center">{{ $products->links() }}</div>
            <!-- Footer-->
            <footer class="py-5 bg-dark bottom">
                <div class="container">
                    <p class="m-0 text-center text-white ">Copyright &copy; Atelier Marry 2022</p>
                </div>
            </footer>
        @endsection
    </div>
</body>

</html>
