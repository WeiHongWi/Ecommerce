<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function showproduct(string $slug){
        return view('frontend.pages.product-detail');
    }
}
