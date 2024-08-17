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

    public function uploadMultiImage(Request $request,$inputName,$path){
        if($request->hasFile($inputName)){
            $imagepath = [];

            $images = $request->$inputName;
            foreach($images as $image){
                $ext = $image->getClientOriginalName();
                $imageName = 'media'.uniqid().'_'.$ext;
                $image->move(public_path('uploads'),$imageName);
                $imagepath[] = $path."/".$imageName;
            }


            return $imagepath;
        }

    }

    public function updateImage(Request $request,$inputName,$path,$oldpath=null){
        if($request->hasFile($inputName)){
            if(File::exists(public_path($oldpath))){
                File::delete(public_path($oldpath));
            }
            $image = $request->$inputName;
            $ext = $image->getClientOriginalName();
            $imageName = 'media'.uniqid().'_'.$ext;
            $image->move(public_path('uploads'),$imageName);

            return $path."/".$imageName;
        }

    }

    public function deleteImage(string $path){
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}
