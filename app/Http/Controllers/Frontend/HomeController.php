<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $sliders = Slider::where('status',1)->orderBy('number','asc')->get();
        $flashsales = FlashSale::first();

        $items = FlashSaleItem::where('flash_sale_id',$flashsales->id)->get();

        return view('frontend.home.home',compact('sliders','flashsales','items'));
    }
}
