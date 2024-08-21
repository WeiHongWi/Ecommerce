<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail(request()->product);

        return $dataTable->render('vendor.product.variants.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.product.variants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:200'],
            'status' => ['required'],
            'product' => ['required']
        ]);

        $variant = new ProductVariant();
        $variant->product_id = $request->product;
        $variant->name = $request->name;
        $variant->status = $request->status;

        $variant->save();
        toastr('Create Variant Successfully');

        return redirect()->route('vendor.vendor-variant.index',['product' => $request->product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
