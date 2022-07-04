<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use App\Type;
use App\Product;
use App\Cart;
use App\Like;

       

class ShopController extends Controller
{
    public function index(Request $request)
    {

        $keyword = $request->input('keyword');
        $query = Product::query();
       

        if (!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%")
                ->orWhere('comment', 'LIKE', "%{$keyword}%");

                     
        }
       
        

        $allCategories = DB::table('types')->get()->all();
        $users = DB::table('users')->get()->all();

        $user_id = Auth::id();
        $count = Cart::where('user_id', $user_id)->count();

        
        $products = $query->withCount('likes')->orderBy('id','asc')->paginate(8);
        $like_model = new Like;
    


        return view('home', [
            'like_model'=>$like_model,
            'keyword'=>$keyword,
            'products' => $products,
            'categories' => $allCategories,
            'users' => $users,
            'count' => $count,
        ]);
    }

    public function detailProduct(Product $product)
    {

        $user_id = Auth::id();
        $my_carts = Cart::where('user_id', $user_id)->get();
        $count = Cart::where('user_id', $user_id)->count();
        return view('detail_product', [
            'product' => $product,

            'count' => $count,
        ]);
    }

    public function categoryProduct(Type $type)
    {

        $types = Product::where('type_id', '=', $type->id)->withCount('likes')->orderBy('id','asc')->Paginate(6);
        $user_id = Auth::id();
        $count = Cart::where('user_id', $user_id)->count();

        return view('category_product', [
            'type' => $type,
            'products' => $types,
            'count' => $count,

        ]);
    }

    public function createProduct()
    {

        return view(
            'create_product'

        );
    }

    public function editProduct(Product $productId)
    {
        return view('edit_product', [
            'product' => $productId,
        ]);
    }

    public function myCart()
    {
        $user_id = Auth::id();

        $count = Cart::where('user_id', $user_id)->count();

        $my_carts = Cart::with('product')->where('user_id', $user_id)->get();


        $total_price = 0;
        foreach ($my_carts as $my_cart) {

            $total_price += $my_cart->product->price * $my_cart->qty;
        }

        return view('my_cart', [
            'my_carts' => $my_carts,
            'count' => $count,
            'total' => $total_price,
        ]);
    }

    public function registerCart()
    {
        $user_id = Auth::id();

        $count = Cart::where('user_id', $user_id)->count();

        $my_carts = Cart::with('product')->where('user_id', $user_id)->get();

        $total_price = 0;
        foreach ($my_carts as $my_cart) {

            $total_price += $my_cart->product->price * $my_cart->qty;
        }

        $config = config('pref');
        $pref = $config[Auth::user()->pref_id];


        return view('register_cart', [

            'my_carts' => $my_carts,

            'count' => $count,

            'total' => $total_price,

            'pref' => $pref,
        ]);
    }

    public function detailUser()
    {

        $user = Auth::user()->get();

        $config = config('pref');
        $prefId = Auth::user()->pref_id;

        $pref = $config[Auth::user()->pref_id];

        //var_dump(Auth::user()->pref_id);

        return view('detail_user', [
            'user' => $user,
            'prefId' => $prefId,
            'pref' => $pref,
        ]);
    }

    public function bought()
    {
        $user_id = Auth::id();

        $count = Cart::where('user_id', $user_id)->count();

        $softDeletes = Cart::with('product')->onlyTrashed()
            ->where('user_id', $user_id)
            ->get();

        foreach($softDeletes as $softDelete){
            if(empty($softDelete->product)){
                $softDelete->forceDelete();

                return redirect()->route('bought');
            }
        }
       
        return view('bought', [
            'softDeletes' => $softDeletes,
            'count' => $count,
        ]);
    }
    
    public function like(Request $request)
    {
        $user_id = Auth::user()->id; //1.ログインユーザーのid取得
        $product_id = $request->product_id; //2.投稿idの取得
        $already_liked = Like::where('user_id', $user_id)->where('product_id', $product_id)->first(); //3.
    
        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $like = new Like; //4.Likeクラスのインスタンスを作成
            $like->product_id = $product_id; //Likeインスタンスにreview_id,user_idをセット
            $like->user_id = $user_id;
            $like->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Like::where('product_id', $product_id)->where('user_id', $user_id)->delete();
        }
        //5.この投稿の最新の総いいね数を取得
        $product_likes_count = Product::withCount('likes')->findOrFail($product_id)->likes_count;
        $param = [
            'product_likes_count' => $product_likes_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }

   
}
    

