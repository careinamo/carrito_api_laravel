<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

class CheckoutController extends Controller
{
    public function show(int $token)
    {
    	$cart = Cart::where('token', '=', $token)->with('products')->first();

    	if(isset($cart)) {
			return $cart;
	    } else {
			return response()->json([
                'message' => 'Cart not found',
            ], 404);
	    }
    }

	public function store(int $token)
    {
    	// TO DO make table orders logic
    	$cart = Cart::where('token', '=', $token)->with('products')->first();

    	if(isset($cart)) {
		    foreach ($cart->products as $product) {
		    	$product->stock = $product->stock - $product->pivot->quantity;
		    	$product->save();
		    }

		    $cart->products()->detach();
			$cart->delete();

			return response()->json([
	            'message' => 'Order created',
	        ], 200);
	    }  else {
			return response()->json([
                'message' => 'Cart not found',
            ], 404);
	    }

    }
}
