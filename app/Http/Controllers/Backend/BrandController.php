<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Traits;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ImageUploadTrait;

    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['image','required','max:2048'],
            'name' => ['required','max:200'],
            'feature' => ['required'],
            'status' => ['required']
        ]);

        $brand = new Brand();
        $logopath = $this->uploadImage($request,'logo','uploads');

        $brand->logo = $logopath;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->feature = $request->feature;
        $brand->status = $request->status;
        $brand->save();

        toastr('Create successfully!');

        return redirect()->route('admin.brand.index');
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

    public function changeStatus(Request $request){

    }
}
