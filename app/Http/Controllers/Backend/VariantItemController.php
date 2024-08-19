<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantItem;
use Illuminate\Http\Request;

class VariantItemController extends Controller
{
    public function index(VariantItemDataTable $dataTable,$productID,$variantID){
        $product = Product::findOrFail($productID);
        $variant = ProductVariant::findOrFail($variantID);

        return $dataTable->render('admin.product.variantitem.index',compact('product','variant'));
    }

    public function create(string $variantid,string $productid){
        $variant = ProductVariant::findOrFail($variantid);
        $product = ProductVariant::findOrFail($productid);
        return view('admin.product.variantitem.create',compact('variant','product'));
    }

    public function store(Request $request){
        $request->validate([
            'variant_id' => ['required','integer'],
            'item_name' => ['required','max:20'],
            'price' => ['required','integer'],
            'status' => ['required'],
            'default' => ['required']
        ]);

        $variantitem = new VariantItem();
        $variantitem->variant_id = $request->variant_id;
        $variantitem->item_name = $request->item_name;
        $variantitem->price = $request->price;
        $variantitem->default = $request->default;
        $variantitem->status = $request->status;

        $variantitem->save();

        toastr("Create Variant Item Successfully");

        return redirect()->route('admin.variantitem.index',['productID' => $request->product_id,'variantID' => $request->variant_id]);

    }
    public function edit(){
        return view('admin.product.variantitem.edit');
    }

    public function update(Request $request,string $id){

    }

    public function destroy(){

    }
}
