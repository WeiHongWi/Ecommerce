<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;

use function Laravel\Prompts\error;

class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => ['required','min:3'],
            'email' => ['required','email','unique:users,email,'.Auth::user()->id],
            'image' => ['image','max:2048']
        ]);
        $user = Auth::user();

        if($request->hasFile('image')){
            if(File::exists(public_path(Auth::user()->image))){
                File::delete(public_path(Auth::user()->image));
            }
            $image = $request->image;
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'),$imageName);

            $path = "/uploads/".$imageName;
            $user->image = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        Toastr("Update profile successfully!");

        return redirect()->back();
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => ['required','current_password'],
            'password' => ['required','confirmed','min:3']
        ]);

        // Should store the hash password back to database
        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);
        toastr("Update password successfully!");

        return redirect()->back();
    }

}
