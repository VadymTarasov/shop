<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[\App\Http\Controllers\ProductController::class, 'shopIndex'])->name('home');

Route::get('pet-shop/index',[\App\Http\Controllers\ProductController::class, 'shopIndex'])
    ->name('pet-shop/index');

Route::get('pet-shop/shop-page',[\App\Http\Controllers\ProductController::class, 'shopList'])
    ->name('pet-shop/shop-page'); //вызовается контроллер и вызывается метод

Route::get('pet-shop/contact', function (){
    return view('pet-shop/contact');
})->name('pet-shop/contact');

Route::get('pet-shop/about-us',[\App\Http\Controllers\PetController::class, 'about'])
    ->name('pet-shop/about-us');

Route::get('pet-shop/product-details', [\App\Http\Controllers\ProductController::class, 'productDetails'])
    ->name('pet-shop/product-details');
//корзина
Route::get('pet-shop/add-cart', [\App\Http\Controllers\ProductController::class,'addCart'])
    ->name('pet-shop/add-cart');
//подключаю корзину сам
Route::get('pet-shop/cart', function (){
    return view('pet-shop/cart');
})->name('pet-shop/cart');
//подкл. страничку регистрации
Route::get('pet-shop/my-account', [\App\Http\Controllers\ProductController::class,'profile'])
    ->name('pet-shop/my-account')->middleware('auth');

Route::get('pet-shop/checkout', [\App\Http\Controllers\ProductController::class,'checkout'])
    ->name('pet-shop/checkout')->middleware('auth');

Route::post('pet-shop/make-order', [\App\Http\Controllers\ProductController::class,'makeOrder'])
    ->name('pet-shop/make-order')->middleware('auth');



//регистрация на гл стр ларавель
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';

//админ. понель
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//путь к стандартно гл стр ларавел
/*
Route::get('/', function () {
    return view('welcome');
});*/
/*
Route::get('/', function () {
    return view('pet-shop/index');
});*/
/*
 //так вызывается индекс, а нам нужен контроллер
Route::get('pet-shop/index', function () {
    return view('pet-shop/index');
})->name('pet-shop/index');*/

/*
Route::get('pet-shop/shop-page', function () {
    return view('pet-shop/shop-page');
})->name('pet-shop/shop-page');*/
