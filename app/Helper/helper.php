<?php

use App\Models\Product;

function setsidebarActive(array $route){
    if(is_array($route)){
        foreach($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}

function checkDiscount(Product $product){
    $cur_date = date('Y-m-d');

    if($product->offer_start_date <= $cur_date && $cur_date <= $product->offer_end_date
       && $product->offer_price >= 0){
        return true;
    }

    return false;
}

function checkDiscountPercent(Product $product){
    $percent  = (($product->price - $product->offer_price) / $product->price)*100;
    return $percent;
}


function producttypeAbbre(string $product_type){
    switch($product_type){
        case 'best_product':
            return 'Best';
            break;
        case 'featured_product':
            return 'Feat';
            break;
        case 'new_arrival':
            return 'New';
            break;
        case 'top_product':
            return 'Top';
            break;
        default:
            return 'None';
            break;
    }
}
