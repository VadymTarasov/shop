<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

//use MongoDB\Driver\Session;

class ProductController extends Controller
{
    public function shopList()
    {
        $products = Product::query()->limit(3)->offset(1)->get();

        $sessionId = Session::getId();

            \Cart::session($sessionId);

            $cart = \Cart::getContent();

            $sum = \Cart::getTotal('price');

        return view('pet-shop/shop-page', [
            'products' => $products,
            'cart' => $cart,
            'sum' => $sum,
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

        $sessionId = Session::getId();

        \Cart::session($sessionId);

        $cart = \Cart::getContent();

        $sum = \Cart::getTotal('price');

        return view('pet-shop/product-details', [
            'product' => $product,
            'cart' => $cart,
            'sum' => $sum,
        ]);
    }



    /*
        мой вариант
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
        */

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

    public function contact()
    {
        $sessionId = Session::getId();

        \Cart::session($sessionId);

        $cart = \Cart::getContent();

        $sum = \Cart::getTotal('price');

        return view('pet-shop/contact', [
            'cart' => $cart,
            'sum' => $sum,
        ]);
    }



//    тест подкл. профиля
    public function profile()
    {

        $sessionId = Session::getId();

        \Cart::session($sessionId);

        $cart = \Cart::getContent();

        $sum = \Cart::getTotal('price');

        return view('pet-shop/my-account', [
            'cart' => $cart,
            'sum' => $sum,
        ]);
    }

    //    тест подкл. checkout
    public function checkout()
    {
        $user = Auth::user();

        $sessionId = Session::getId();

        \Cart::session($sessionId);

        $cart = \Cart::getContent();

//        dd($cart);

        $sum = \Cart::getTotal('price');

        $messageSuccessOrder =\session('successOrder');
//        getAuthIdentifier выводит id
        $orders = Order::query()->where(['user_id' => $user->getAuthIdentifier()])

            ->orderBy('id','desc')->get();
//        dd($orders);

        $orders->transform(function ($order) {
            $order->cart_data = unserialize($order->cart_data); /*преобразовался в массив*/
/*            dd($order->cart_data);*/

            return $order;
        });

        if (!empty($messageSuccessOrder))
        {
            return view('pet-shop/checkout', [
                'cart' => $cart,
                'sum' => $sum,
                'user' => $user,
                'orders'=>$orders,
            ])->with('messageSuccessOrder', $messageSuccessOrder);
        }

        return view('pet-shop/checkout', [
            'cart' => $cart,
            'sum' => $sum,
            'user' => $user,
            'orders'=>$orders,
        ])->with('messageSuccessOrder', $messageSuccessOrder);
    }
    public function makeOrder(Request $request)
    {
        $user = Auth::user();

        $sessionId = Session::getId();

        \Cart::session($sessionId);

        $cart = \Cart::getContent();

        $sum = \Cart::getTotal('price');

        $order = new Order();

        $order->user_id = $user->id;

        $order->cart_data = $order->setCartDataAttribute($cart);

        $order->total_sum = $sum;

        $order->address = $request->address . ' ' . $request->city .' ' . $request->post;

        $order->phone = $request->phone;

        if($order->save())
        {
            \Cart::clear();

            Session::flash('successOrder', 'Order created successfully');

            return back();
        }

        Session::flash('errorOrder', 'something went wrong');

        return back();


    }

}
