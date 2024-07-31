<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $sliders = Slider::where('status',1)->orderBy('number','asc')->get();

        return view('frontend.home.home',compact('sliders'));
    }
}
