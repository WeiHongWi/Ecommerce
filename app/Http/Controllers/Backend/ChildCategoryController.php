<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.childcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.childcategory.create',compact('categories'));
    }

    public function getSubcategory(Request $request){
        $category_id = $request->id;

        $subcategories = Subcategory::where('category_id',$category_id)->where('status',1)->get();
        return $subcategories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'subcategory' => ['required'],
            'name' => ['required','max:200','unique:child_categories,name'],
            'status' => ['required']
        ]);

        $childcategory = new ChildCategory();
        $childcategory->name = $request->name;
        $childcategory->category_id = $request->category;
        $childcategory->subcategory_id = $request->subcategory;
        $childcategory->slug = Str::slug($request->name);
        $childcategory->status = $request->status;

        $childcategory->save();
        toastr('Create child category successfully!');

        return redirect()->route('admin.childcategory.index');
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

        return view('admin.childcategory.edit',compact('categories'));
    }

    public function getChildcategory(Request $request){
        $sub_id = $request->id;
        $childcategories = ChildCategory::where('subcategory_id',$sub_id)->get();

        return $childcategories;
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

    public function changeStatus(Request $requeset){

    }
}
