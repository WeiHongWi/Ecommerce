<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantItem;
use Illuminate\Http\Request;

class VendorProductVariantItemController extends Controller
{
    public function index(VendorProductVariantItemDataTable $dataTable,$productID,$variantID){
        $product = Product::findOrFail($productID);
        $variant = ProductVariant::findOrFail($variantID);

        return  $dataTable->render('vendor.product.variantitem.index',compact('product','variant'));
    }

    public function create($productID,$variantID){
        $product = Product::findOrFail($productID);
        $variant = ProductVariant::findOrFail($variantID);
        return view('vendor.product.variantitem.create',compact('product','variant'));
    }

    public function store(Request $request){
        $request->validate([
            'variant_id' => ['required'],
            'item_name' => ['required','max:200'],
            'price' => ['integer','required'],
            'status' => ['required'],
            'default' => ['required']
        ]);

        $variantitem = new VariantItem();

        $variantitem->product_variant_id = $request->variant_id;
        $variantitem->item_name = $request->item_name;
        $variantitem->status = $request->status;
        $variantitem->default = $request->default;
        $variantitem->price = $request->price;

        $variantitem->save();
        toastr('Create Vendor Product Variant Item Successfully.');

        return redirect()->route('vendor.vendor-variant-item.index',['productID'
               => $request->product_id,'variantID' => $request->variant_id]);
    }
}
