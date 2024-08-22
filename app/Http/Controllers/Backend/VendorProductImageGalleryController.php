<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductImageGalleryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductImageGalleryDataTable $dataTable)
    {
        $product = Product::findOrFail(request()->product);
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        return $dataTable->render('vendor.product.image-gallery.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image.*' => ['required','image','max:2048'],
        ]);

        $imagepths = $this->uploadMultiImage($request,'image','uploads');

        foreach($imagepths as $imagepath){
            $imagegallery = new ProductImageGallery();
            $imagegallery->image = $imagepath;
            $imagegallery->product_id = $request->product;
            $imagegallery->save();
        }

        toastr('Upload Image Successfully!');

        return redirect()->back();
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
        $product = Product::findOrFail(request()->product);
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        $ProductImageGallery = ProductImageGallery::findOrFail($id);

        $this->deleteImage($ProductImageGallery->image);
        $ProductImageGallery->delete();

        return response(['message' => 'Delete Successfully']);
    }
}
