<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(FlashSaleItemDataTable $dataTable){
        $products = Product::where('is_approved',"1")->where('status',1)->orderBy('id','DESC')->get();
        return $dataTable->render('admin.flash-sell.index',compact('products'));
    }

    public function update(Request $request){
        $request->validate([
            'end_date' => ['required']
        ]);

        FlashSale::updateOrCreate([
            'id' => '1',
            'end_date' => $request->end_date
        ]);

        toastr('Create Flash Sale Successfully');

        return redirect()->back();
    }

    public function addProduct(Request $request){
        $request->validate([
            'product_id' => ['required','integer','unique:flash_sale_items,product_id'],
            'show_home' => ['required'],
            'status' => ['required']
        ],[
            'product.unique' => 'The product is already in flash sale.'
        ]);


        $flash_date = FlashSale::first();

        $item = new FlashSaleItem();
        $item->product_id = $request->product_id;
        $item->show_home = $request->show_home;
        $item->status = $request->status;
        $item->flash_sale_id = $flash_date->id;
        $item->save();
        toastr('Add Product Flash Sale Successfully');

        return redirect()->back();
    }

    public function changeStatusHome(Request $request){
        $item = FlashSaleItem::findOrFail($request->id);
        $item->show_home = ($request->isChecked == "false")?"0":"1";
        $item->save();

        return response(['status' => 'success','message' => 'Change Status Successfully']);
    }

    public function changeStatus(Request $request){
        $item = FlashSaleItem::findOrFail($request->id);
        $item->status = ($request->isChecked == "false")?"0":"1";
        $item->save();

        return response(['message' => 'Change Status Successfully']);
    }

    public function destroy(string $id){
        $item = FlashSaleItem::findOrFail($id);
        $item->delete();

        return response(['status' => 'success','message' => 'Delete Successfully']);
    }
}
