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

    public function create(string $productid,string $variantid){
        $variant = ProductVariant::findOrFail($variantid);
        $product = Product::findOrFail($productid);
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
        $variantitem->product_variant_id = $request->variant_id;
        $variantitem->item_name = $request->item_name;
        $variantitem->price = $request->price;
        $variantitem->default = $request->default;
        $variantitem->status = $request->status;

        $variantitem->save();

        toastr("Create Variant Item Successfully");

        return redirect()->route('admin.variantitem.index',['productID' => $request->product_id,'variantID' => $request->variant_id]);

    }
    public function edit(string $id){
        $variantitem = VariantItem::findOrFail($id);
        $variant = ProductVariant::where('id',$variantitem->product_variant_id)->first();
        return view('admin.product.variantitem.edit',compact('variantitem','variant'));
    }

    public function update(Request $request,string $id){
        $request->validate([
            'item_name' => ['required','max:20'],
            'price' => ['required','integer'],
            'status' => ['required'],
            'default' => ['required']
        ]);
        $variantitem = VariantItem::findOrFail($id);
        $variantitem->item_name = $request->item_name;
        $variantitem->price = $request->price;
        $variantitem->default = $request->default;
        $variantitem->status = $request->status;

        $variantitem->save();

        toastr("Update Variant Item Successfully");

        return redirect()->route('admin.variantitem.index',
        ['productID'=>$request->product_id,'variantID'=>$variantitem->product_variant_id]);
    }

    public function destroy(Request $request){
        $variantitem = VariantItem::findOrFail($request->id);
        $variantitem->delete();

        return response(['message' => 'Delete succesfully']);
    }

    public function changeStatus(Request $request){
        $variantitem = VariantItem::findOrFail($request->id);
        $variantitem->status = ($request->isChecked == "false")?"0":"1";
        $variantitem->save();

        return response(['status' => 'success','message' => 'change status succesfully']);
    }
}
