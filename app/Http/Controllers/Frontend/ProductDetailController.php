<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function showproduct(string $slug){

        $flashsales = FlashSale::first();
        $product = Product::where('slug',$slug)->where('status',1)->first();
        return view('frontend.pages.product-detail',compact('product','flashsales'));
    }
}
