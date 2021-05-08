<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CatalogueController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $products = Product::whereHas('category', function ($child) {
            $child->whereHas('parent', function($parent) {
                $parent->where('status', '=', true);
            })->where('status', '=', true);
        })
        ->where('stock', '>', '0')
        ->where('price', '>', '0')
        ->get();

        return $products;
    }
}
