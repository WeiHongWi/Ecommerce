<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubcategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\IsEmpty;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubcategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'name' => ['required','max:200','unique:categories,name'],
            'status' => ['required']
        ]);

        $subcategory = new Subcategory();
        $subcategory->category_id = $request->category;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->status = $request->status;

        $subcategory->save();

        toastr('Create successfully');

        return redirect()->route('admin.subcategory.index');
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
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.subcategory.edit',compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => ['required'],
            'name' => ['required','max:200','unique:categories,name'],
            'status' => ['required']
        ]);

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->category_id = $request->category;
        $subcategory->status = $request->status;

        $subcategory->save();

        toastr('Update sub category successfully!');
        return redirect()->route('admin.subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $childcategory = ChildCategory::where('subcategory_id',$id)->get();
        if(!$childcategory->isEmpty()){
            toastr('There still have child category under this sub category!','error');
            return response(['status' => 'error' ,'Delete unsuccessfully']);
        }
        $subcategory->delete();

        return response(['status' => 'success' ,'Delete successfully']);
    }

    public function changeStatus(Request $request){
        $subcategory = Subcategory::findOrfail($request->id);
        $subcategory->status = ($request->isChecked == "false")?"0":"1";
        $subcategory->save();

        return response(['message' => 'Change status successfully']);
    }
}
