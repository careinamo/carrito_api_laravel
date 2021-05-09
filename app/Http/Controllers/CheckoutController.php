<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
    	$cart = Cart::find($request->cart_id);

    	if (!isset($cart)) {
    		$product = Product::find($request->product_id);
				$this->validateStatusCategory($product);
				$this->validateStock($product, 1);
				$cart = Cart::create();
				$cart->products()->attach($request->product_id, ['quantity' => 1]);
	    		return $cart->load('products');
    	}

		$productInCart = $cart->products->find($request->product_id);

    	if (isset($productInCart)) {
			$this->validateStock($productInCart, $productInCart->pivot->quantity);
			$this->validateStatusCategory($productInCart);
			$cart->products()->updateExistingPivot($request->product_id, ['quantity' => ++$productInCart->pivot->quantity]);
			return $cart;
        }

		$product = Product::find($request->product_id);

		$this->validateStock($product, 1);
		$this->validateStatusCategory($product);
		$cart->products()->attach($request->product_id, ['quantity' => 1]);
		return $cart->load('products');
    }
}
