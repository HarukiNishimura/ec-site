<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Type;
use App\Product;
use App\Cart;
use App\Http\Requests\CreateProduct;
use App\Http\Requests\CartRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;


class RegistrationController extends Controller
{

    public function createProductForm(CreateProduct $request)
    {

        if (isset($request->img_path)) {
            $path = $request->file('img_path')->store('public');
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'type_id' => $request->type_id,
                'stock' => $request->stock,
                'comment' => $request->comment,
                'img_path' => basename($path),
            ]);
        } else {
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'type_id' => $request->type_id,
                'stock' => $request->stock,
                'comment' => $request->comment,
            ]);
        };

        return redirect('/');
    }

    public function deleteProduct(Product $productId)
    {

        $productId->delete();
        return redirect('/');
    }

    public function editProductForm(Product $productId, CreateProduct $request)
    {
        if (isset($request->img_path)) {
            \Storage::disk('public')->delete($productId->img_path);
            $path = $request->file('img_path')->store('public');


            $productId->name = $request->name;
            $productId->price = $request->price;
            $productId->type_id = $request->type_id;
            $productId->stock = $request->stock;
            $productId->comment = $request->comment;
            $productId->img_path = basename($path);

            $productId->save();
        } else {
            $productId->name = $request->name;
            $productId->price = $request->price;
            $productId->type_id = $request->type_id;
            $productId->stock = $request->stock;
            $productId->comment = $request->comment;
            $productId->img_path;

            $productId->save();
        };

        return redirect()->route('detail.product', ['product' => $productId->id]);
    }

    public function mycartIn(CartRequest $request)
    {
        $user_id = Auth::id();
        $user_name = Auth::user()->name;
        $product_id = $request->product_id;
        $product = Product::where('id', $product_id)->first();

        $product_item = Cart::where('product_id', $product_id)->where('user_id', $user_id)->first();

       if($product['stock'] >=1){
        if (!isset($product_item)) {
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'qty' => $request->input('qty'),
                $message = 'カートに追加しました'
            ]);
        } elseif (isset($product_item)) {
            $product_item->qty += $request->input('qty');
            if ($product_item->qty > $product->stock) {
                $product_item->qty = $product->stock;
                $product_item->save();
                $message = "このアイテムは$product->stock 個までです";
            } else {
                $product_item->save();
                $message = "個数を追加しました。";
            }
        }
      }else{
        return redirect('/');
      }

        $my_carts = Cart::with('product')->where('user_id', $user_id)->get();

        $count = Cart::where('user_id', $user_id)->count();

        $total_price = 0;
        foreach ($my_carts as $my_cart) {

            $total_price += $my_cart->product->price * $my_cart->qty;
        }


        return view('my_cart', [
            'total' => $total_price,
            'my_carts' => $my_carts,
            'message' => $message,
            'count' => $count,

        ]);
    }

    public function deleteCart(Cart $cartId)
    {

        $cartId->forceDelete();
        return redirect()->route('mycart');
    }

    public function nextCart(Request $request)
    {
        var_dump($request);
        return view('next_cart');
    }

    public function detailUserForm(UserRequest $request)
    {

        $user = Auth::user();

        $columns = ['name', 'postal_code', 'city', 'town', 'building', 'phone_number'];

        foreach ($columns as $column) {
            $user->$column = $request->$column;
        }
        $user->save();

        return redirect()->route('register.cart');
    }

    public function complete()
    {
        $user_id = Auth::id();
        $carts = Cart::with('product')->where('user_id', $user_id)->get();
        $name=Auth::user()->name;
        
        foreach($carts as $cart){
            if($cart->product->stock>=1){
          
            $qty=$cart->qty;

           $product=Product::where('id',$cart->product->id)->first();

           $product->stock =$product->stock - $qty;

           $product->save();

           $cart->delete();
            }else{
                $cart->forceDelete();
              
              return redirect('/')->with('message', "{$cart->product->name}は売り切れたので購入できませんでした。");
            }

        };
        return view('complete', [
  

        ]);
    }
}
