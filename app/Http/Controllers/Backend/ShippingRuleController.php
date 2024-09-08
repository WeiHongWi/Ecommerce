<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippingRuleDataTable $dataTable)
    {
        return $dataTable->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:200'],
            'type' => ['required'],
            'min_cost' => ['nullable','integer'],
            'cost' =>['required','integer'],
            'status' => ['required'],
        ]);

        $shipping_rule = new ShippingRule();
        $shipping_rule->name = $request->name;
        $shipping_rule->type = $request->type;
        $shipping_rule->min_cost = $request->min_cost;
        $shipping_rule->cost = $request->cost;
        $shipping_rule->status = $request->status;

        $shipping_rule->save();

        toastr('Create Shipping Rule Successfully');

        return redirect()->route('admin.shipping-rule.index');
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
        $shipping = ShippingRule::findOrFail($id);
        return view('admin.shipping-rule.edit',compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','max:200'],
            'type' => ['required'],
            'min_cost' => ['nullable','integer'],
            'cost' =>['required','integer'],
            'status' => ['required'],
        ]);
        $shipping_rule = ShippingRule::findOrFail($id);
        $shipping_rule->name = $request->name;
        $shipping_rule->type = $request->type;
        $shipping_rule->min_cost = $request->min_cost;
        $shipping_rule->cost = $request->cost;
        $shipping_rule->status = $request->status;

        $shipping_rule->save();

        toastr('Update Shipping Rule Successfully');

        return redirect()->route('admin.shipping-rule.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipping = ShippingRule::findOrFail($id);
        $shipping->delete();

        return response(['status' => 'success','message' => 'Delete Successfully']);
    }

    public function changeStatus(Request $request){
        $shipping = ShippingRule::findOrFail($request->id);
        $shipping->status = ($request->isChecked == "false")?"0":"1";
        $shipping->save();

        return response(['status' => 'success','message' => 'Change Status Successfully']);
    }
}
