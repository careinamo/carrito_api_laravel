<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CartController extends Controller
{
    public function store(Request $request)
    {

    	$cart = Cart::where('token', '=', $request->token)->first();

    	if (!isset($cart)) {
    		$product = Product::find($request->product_id);
			$this->validateStatusCategory($product);
			$this->validateStock($product, 1);
			$cart = Cart::create(['token' => $request->token,'total' => $product->price, 'count' => 1]);
			$cart->products()->attach($request->product_id, ['quantity' => 1, 'total' => $product->price]);
    		return $cart->load('products');
    	}

		$productInCart = $cart->products->find($request->product_id);
    	if (isset($productInCart)) {
			$this->validateStock($productInCart, $productInCart->pivot->quantity);
			$this->validateStatusCategory($productInCart);
			$cart->products()->updateExistingPivot($request->product_id, ['quantity' => ++$productInCart->pivot->quantity, 'total' => $productInCart->pivot->total + $productInCart->price]);
			$cart->total += $productInCart->price;
			$cart->count += 1;
			$cart->save();
			return $cart->load('products');
        }

		$product = Product::find($request->product_id);

		$this->validateStock($product, 1);
		$this->validateStatusCategory($product);
		$cart->products()->attach($request->product_id, ['quantity' => 1, 'total' => $product->price, ]);
		$cart->total += $product->price;
		$cart->count += 1;
		$cart->save();
		return $cart->load('products');
    }

    public function destroy(Request $request)
    {
    	$cart = Cart::where('token', '=', $request->token)->first();
    	if(isset($cart)) {
    		$product = $cart->products->find($request->product_id);
	    	if(isset($product)) {
	    		if($product->pivot->quantity > 1) {
		    		$cart->products()->updateExistingPivot($request->product_id, ['quantity' => --$product->pivot->quantity]);
					$cart->total = $cart->total - $product->price;
					$cart->count -= 1;
					$cart->save();
		            return $cart;
	    		} else {
	    			$cart = Cart::where('token', '=', $request->token)->first();
	    			$cart->products()->detach($request->product_id, ['quantity' => 1]);
	    			$cart->delete();
					return response()->json([
		                'message' => 'Cart deleted '.$cart->token,
		            ], 200);
	    		}
	        }
			return response()->json([
	            'message' => 'Product not found in cart',
	        ], 404);
	    } else {
			return response()->json([
                'message' => 'Cart not found',
            ], 404);
	    }
    }

	private function validateStatusCategory(Product $product)
    {
        $statusCategoryProduct = $product->category->status;

        if ((string) boolval($statusCategoryProduct) != true) {
            throw new HttpException(400, 'Category inactive');
        }

        $statusParentCategoryProduct = $product->category()->with('parent')->get()->pluck('parent')->first()->status;

        if ((string) boolval($statusCategoryProduct) != true) {
            throw new HttpException(400, 'Parent category inactive');
        }
    }

	private function validateStock(Product $product, int $valueCompare)
    {
		if ( $product->stock < $valueCompare ) {
			throw new HttpException(400, 'Not enough inventory for product: '.$product->name.', Stock: '.$product->stock);
		}
    }

	private function validatePrice(Product $product)
    {
		if ( $product->price <= 0 || $product->price == null) {
			throw new HttpException(400, 'Price zero or null for product: '.$product->name);
		}
    }
}
