<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\CartItem;
use App\Http\Resources\CartResource;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public  function addProductToCart(Request $request){
        $request->validate([
            'product_id'=>'required',
            'qty'=>'required',
        ]);
        $user = Auth::user();
        $product_id = $request->input('product_id');
        $qty = $request->input('qty');
        $product = Product::findOrFail($product_id);


        /**
         * @var Cart
         */


        $cart = $user->cart;
        if(is_null($cart)){
            $cart = new Cart();
            $cart->user_id= $user->id;
            $cart->cart_items = [];
            $cart->total = 0 ;
        }
        //$cart  = $this->checkCartStatus($user->cart);

        if($cart->inItems($product_id)){
            $cart->increaseProductInCart($product);




        }else{
        $cart->addProductToCart($product,$qty);

        }


        $cart->save();
        return $cart;



    }

    private function checkCartStatus(Cart $cart=null){
        if(is_null($cart)){
            $cart = new Cart();
            $cart->cart_items=[];
            $cart->total=0 ;
            $cart->user_id = Auth::user()->id ;
            return $cart ;
        }
        return $cart ;
    }
}
