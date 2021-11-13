<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

//use MongoDB\Driver\Session;

class ProductController extends Controller
{
    public function shopList()
    {
        $products = Product::query()->limit(3)->offset(1)->get();

//        $sessionId = Session::getId();

//            \Cart::session($sessionId);

//            $cart = \Cart::getContent();

//            $sum = \Cart::getTotal('price');

        return view('pet-shop/shop-page', [
            'products' => $products,
//            'cart' => $cart,
//            'sum' => $sum,
        ]);
    }

    public function shopIndex()
    {/*будем выводить записи с б.д. в случайном порядке.limit(1)-это сколько будут показывать*/
        $randProducts = Product::query()->inRandomOrder()->limit(4)->get();

        $product = Product::query()->select()->inRandomOrder()->limit(1)->get();

        $sessionId = Session::getId();

        \Cart::session($sessionId);

        $cart = \Cart::getContent();

        $sum = \Cart::getTotal('price');




//        $sessionId = Session::getId();

//        \Cart::session($sessionId);

//        $cart = \Cart::getContent();

//        $sum = \Cart::getTotal('price');

        return view('pet-shop/index', [
            'randProducts' => $randProducts,
            'product' => $product,
            'cart' => $cart,
            'sum' => $sum
            ]);
    }

    public function productDetails(Request $request)
    {
        $product = Product::query()->where(['id' => $request->id])->get();

//        $sessionId = Session::getId();

//        \Cart::session($sessionId);

//        $cart = \Cart::getContent();

//        $sum = \Cart::getTotal('price');

        return view('pet-shop/product-details', [
            'product' => $product,
//            'cart' => $cart,
//            'sum' => $sum,
            ]);
    }
    //корзина
    public function addCart(Request $request)
    {
        $product = Product::query()->where(['id' => $request->id])->first();

        $sessionId = Session::getId();

        \Cart::session($sessionId)->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->qty ?? 1,
            'attributes' => [
                'image' => $product->image,
            ],

        ]);

        $cart = \Cart::getContent();

        return redirect()->back();
    }

}
