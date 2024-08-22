<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\Subcategory;
use App\Models\VariantItem;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VendorProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable)
    {
        return $dataTable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.product.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required','max:2048','image'],
            'name' => ['required','max:200'],
            'category' =>['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'short_description' => ['required','max:600'],
            'long_description' => ['required'],
            'product_type'=>['required'],
            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:200'],
            'status' => ['required']

        ]);

        $product = new Product();
        $imagepath = $this->uploadImage($request,'image','uploads');

        $product->thumb_img = $imagepath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);

        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->childcategory_id = $request->childcategory;
        $product->brand_id = $request->brand;

        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;

        $product->video_link = $request->video_link;

        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;

        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 1;

        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;


        $product->save();

        toastr('Create vendor product successfully!');

        return redirect()->route('vendor.product.index');
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
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail($id);

        return view('vendor.product.edit',compact('categories','brands','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['max:2048','image'],
            'name' => ['required','max:200'],
            'category' =>['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'short_description' => ['required','max:600'],
            'long_description' => ['required'],
            'product_type'=>['required'],
            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:200'],
            'status' => ['required']

        ]);

        $product = Product::findOrFail($id);
        $imagepath = $this->updateImage($request,'image','uploads');

        $product->thumb_img = (empty($imagepath))?$product->thumb_img:$imagepath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);

        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->childcategory_id = $request->childcategory;
        $product->brand_id = $request->brand;

        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;

        $product->video_link = $request->video_link;

        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;

        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 1;

        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;


        $product->save();

        toastr('Create vendor product successfully!');

        return redirect()->route('vendor.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $imagegalleries = ProductImageGallery::where('product_id',$product->id)->get();
        foreach($imagegalleries as $imagegallery){
            $this->deleteImage($imagegallery->image);
            $imagegallery->delete();
        }

        $variants = ProductVariant::where('product_id',$product->id)->where('status',"1")->get();
        foreach($variants as $variant){
            $variantitems = VariantItem::where('product_variant_id',$variant->id)->where('status',"1")->get();
            foreach($variantitems as $variantitem){
                $variantitem->delete();
            }
            $variant->delete();
        }

        $product->delete();

        return response(['status' => 'success','message' => 'Delete Successfully']);

    }
    public function getSubcategory(Request $request){
        $subcategories = Subcategory::where('category_id',$request->id)->where('status',1)->get();
        return $subcategories;
    }

    public function getChildcategory(Request $request){
        $childcategorites = ChildCategory::where('subcategory_id',$request->id)->where('status',1)->get();
        return $childcategorites;
    }

    public function changeStatus(Request $request){
        $product = Product::findOrFail($request->id);
        $product->status = ($request->isChecked == "false")?"0":"1";
        $product->save();

        return response(['message' => 'Change Status Successfully']);
    }

}
