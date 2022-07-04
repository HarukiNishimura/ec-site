<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RegistrationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes(['verify' => true]);

Route::get('/',[ShopController::class,'index'])->name('posts.index');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/category/{type}',[ShopController::class,'categoryProduct'])->name('category.product');
Route::get('/detail/{product}',[ShopController::class,'detailProduct'])->name('detail.product');


//一般ログインユーザー
Route::group(['middleware' => 'auth'], function () {
    Route::post('/mycart',[RegistrationController::class,'mycartIn'])->name('mycart.in');
    Route::get('/mycart',[ShopController::class,'mycart'])->name('mycart');

    Route::get('/deleteCart/{cartId}',[RegistrationController::class,'deleteCart'])->name('delete.cart');

    Route::get('/register/cart',[ShopController::class,'registerCart'])->name('register.cart');

    Route::get('/detail_user',[ShopController::class,'detailUser'])->name('detail.user');

    Route::post('/detail_user_form',[RegistrationController::class,'detailUserForm'])->name('detail.userForm');

    Route::get('/complete',[RegistrationController::class,'complete'])->name('complete');

    Route::get('/bought',[ShopController::class,'bought'])->name('bought');

    Route::post('/like',[ShopController::class,'like'])->name('products.like');;
});



  // 管理者以上
Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
    Route::get('/createProduct',[ShopController::class,'createProduct'])->name('create.product');
    Route::post('/createProduct',[RegistrationController::class,'createProductForm'])->name('create.product.form');
    
    Route::get('/delete/{productId}',[RegistrationController::class,'deleteProduct'])->name('delete.product');

    Route::get('/edit/form/{productId}',[ShopController::class,'editProduct'])->name('edit.product');
    Route::post('/edit/form/{productId}',[RegistrationController::class,'editProductForm'])->name('edit.product.form');
  });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
