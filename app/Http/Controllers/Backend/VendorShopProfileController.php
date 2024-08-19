<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorShopProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id',Auth::user()->id)->first();
        return view('vendor.seller-profile.index',compact('profile'));
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
            'banner' => ['nullable','image','max:2048'],
            'phone' => ['required','max:10'],
            'email' => ['required','email','max:30'],
            'address' => ['required'],
            'description' => ['required'],
            'fb_link' => ['nullable','url'],
            'ig_link' => ['nullable','url'],
            'x_link' => ['nullable','url'],
            'shop_name' => ['required','max:200']
        ]);

        $vendor = Vendor::where('user_id',Auth::user()->id)->first();
        $imagepath = $this->updateImage($request,'banner','uploads',$vendor->banner);
        $vendor->banner = empty($imagepath)?$vendor->banner:$imagepath;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->fb_link = $request->fb_link;
        $vendor->ig_link = $request->ig_link;
        $vendor->x_link = $request->x_link;
        $vendor->shop_name = $request->shop_name;

        $vendor->save();

        toastr('Update successfully!');

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
        //
    }
}
