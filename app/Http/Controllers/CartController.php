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

    public function destroy(Request $request)
    {
    	$cart = Cart::find($request->cart_id);
    	if(isset($cart)) {
    		$product = $cart->products->find($request->product_id);
	    	if(isset($product)) {
	    		if($product->pivot->quantity > 1) {
		    		$cart->products()->updateExistingPivot($request->product_id, ['quantity' => --$product->pivot->quantity]);
		            return $cart;
	    		} else {
	    			$cart = Cart::find($request->cart_id);
	    			$cart->products()->detach($request->product_id, ['quantity' => 1]);
	    			$cart->delete();
	    			return $cart;
	    		}
	        }
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

        $statusParentCategoryProduct = $product->category()
            ->with('parent')
            ->get()
            ->pluck('parent')
            ->first()
            ->status;

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
