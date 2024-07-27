<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class ProfileController extends Controller
{
    public function index(){
        return view('frontend.dashboard.profile');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'Name' => ['required','max:100'],
            'Email' => ['required','email','unique:users,email,' .Auth::user()->id ],
            'image' => ['image','max:2048']
        ]);

        $user = Auth::user();

        if($request->hasFile('image')){
            if(File::exists(public_path($user->image))){
                File::delete(public_path($user->image));
            }
            $image = $request->image;
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'),$imageName);

            $path = 'uploads/'.$imageName;
            $user->image = $path;
        }
        $user->name = $request->Name;
        $user->email = $request->Email;
        $user->save();

        toastr('Upload profile successully!');
        return redirect()->back();
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => ['required','current_password'],
            'password' => ['required','confirmed','min:5']
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        toastr("Update password successfully!");

        return redirect()->back();
    }
}
