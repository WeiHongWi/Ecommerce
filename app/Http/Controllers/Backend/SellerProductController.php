<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerPendingProductDataTable;
use App\DataTables\SellerProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function index(SellerProductDataTable $dataTable){

        return $dataTable->render('admin.seller.index');
    }

    public function pending_index(SellerPendingProductDataTable $dataTable){
        return $dataTable->render('admin.seller-pending.index');
    }

    public function changeApproved(Request $request){
        $product = Product::findOrFail($request->id);
        $product->is_approved = $request->value;
        $product->save();

        return response(['message' => ['Change approve successfully']]);
    }


}
