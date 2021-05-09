<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

class CartController extends Controller
{
    public function store(Request $request)
    {
    	$cart = Cart::find($request->cart_id);

    	if(!isset($cart)) {
    		$cart = Cart::create();
    		$cart->products()->attach($request->product_id, ['quantity' => 1]);
    		return $cart->with('products')->get();
    	}

		 $product = $cart->products->find($request->product_id);

    	 if(isset($product)) {
    	 	$cart->products()->updateExistingPivot($request->product_id, ['quantity' => ++$product->pivot->quantity]);
            return $cart;
        }

		$cart->products()->attach($request->product_id, ['quantity' => 1]);
		return $cart->with('products')->get();
    }
}
