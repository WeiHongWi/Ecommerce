<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(){
        $flashsales = FlashSale::first();
        $items = FlashSaleItem::where('flash_sale_id',$flashsales->id)
                              ->where('status','1')
                              ->paginate(10);
        return view('frontend.pages.flash-sale',compact('flashsales','items'));
    }
}
