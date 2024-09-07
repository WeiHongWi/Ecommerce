<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $setting = GeneralSetting::first();
        return view('admin.setting.index',compact('setting'));
    }

    public function update(Request $request){
        $request->validate([
            'site_name' => ['required','max:200'],
            'currency' => ['required','max:200'],
            'currency_icon' => ['required','max:200'],
            'timezone' => ['required','max:200'],
            'contact_email' => ['required','email','max:200'],
            'layout' => ['required']
        ]);

        GeneralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'currency' => $request->currency,
                'currency_icon' => $request->currency_icon,
                'timezone' => $request->timezone,
                'contact_email' => $request->contact_email,
                'layout' => $request->layout
            ]
        );

        toastr('Update Setting Successfully');

        return redirect()->back();
    }
}
