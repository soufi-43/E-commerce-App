<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\CartItem;
use App\Http\Resources\CartItemsResource;
use App\Http\Resources\CartResource;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = $user->cart;

        $cartItems = json_decode($cart->cart_items);


        $finalCartItems = [];


        foreach ($cartItems as $cartItem) {


            $product = Product::find(intval($cartItem->product->id));

            $finalCartItem = new \stdClass();
            $finalCartItem->product = new ProductResource($product);
            $finalCartItem->qty = number_format(doubleval($cartItem->qty), 2);
            array_push($finalCartItems, $finalCartItem);

        }
        return [
            'cart_items' => $finalCartItems,
            'id' => $cart->id,
            'total' => $cart->total,
        ];
    }


    public function addProductToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required',
        ]);
        $user = Auth::user();
        $product_id = $request->input('product_id');
        $qty = $request->input('qty');
        $product = Product::findOrFail($product_id);
        /**
         * @var Cart
         */
        $cart = $user->cart;

        if (is_null($cart)) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->cart_items = [];
            $cart->total = 0;
        }


        $cart = $this->checkCartStatus($user->cart);


        if ($cart->inItems($product_id)) {

            $cart->increaseProductInCart($product, $qty);
        } else {


            $cart->addProductToCart($product, $qty);

        }
        $cart->save();
        return $cart;

    }


    public function removeProductFromCart($id, $qty = 1)
    {

        $product = Product::find($id);
//        $user = Auth::user();
//        $cart = $user->cart;
        //return $cart->getQty($id);
        $user = Auth::user();
        $cart = $user->cart;
        //$cart->decreaseProductInCart($product);
        //$cart->save();

        //return $cart ;


        $cartItems = $cart->cart_items;
        if (is_null($cartItems)) {

            $cartItems = [];


        } else {

            if (!is_array($cartItems)) {
                $cartItems = json_decode($cartItems);

            }
        }


        /**
         * @var $cartItem CartItem
         */
        /*
            *
      *   foreach($arr_data as $elementKey => $element)
          *     { foreach($element as $valueKey => $value)
      *              { if($valueKey == 'deleteStatus' && $value == 'delete')

    */
        foreach ($cartItems as $key => $val) {


            if ($val->product->id === $product->id) {
                if ($val->qty === 0) {

                    unset($cartItems[$key]);


                } else {
                    $val->qty -= $qty;


                }




            }


            //$value = json_decode($value);


            //return $k ;



    }



$cart->cart_items = json_encode($cartItems);

$tempTotal = 0;
foreach ($cartItems as $cartItem) {


    $tempTotal += ($cartItem->qty * $cartItem->product->price);


}
$cart->total = $tempTotal;


$cart->save();
return $cart;


}


private
function checkCartStatus(Cart $cart = null)
{
    if (is_null($cart)) {
        $cart = new Cart();
        $cart->cart_items = [];
        $cart->total = 0;
        $cart->user_id = Auth::user()->id;
        return $cart;
    }
    return $cart;
}
}
