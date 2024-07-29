<?php
namespace App\Traits;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUploadTrait{
    public function uploadImage(Request $request,$inputName,$path){
        if($request->hasFile($inputName)){
            $image = $request->$inputName;
            $ext = $image->getClientOriginalName();
            $imageName = 'media'.uniqid().'_'.$ext;
            $image->move(public_path('uploads'),$imageName);

            return $path."/".$imageName;
        }

    }
}
