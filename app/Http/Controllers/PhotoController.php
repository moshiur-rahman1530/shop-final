<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Photo;
use App\Models\Image;
use App\Models\Filemanager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use File;

class PhotoController extends Controller
{
    function PhotoIndex(){

        return view('admin.Photos');
    }
  
  
    function PhotoDelete(Request  $request){
  
        $OldPhotoURL=$request->input('OldPhotoURL');
        $OldPhotoID=$request->input('id');
  
        $OldPhotoURLArray= explode("/", $OldPhotoURL);
        $OldPhotoName=end($OldPhotoURLArray);
        $DeletePhotoFile= Storage::delete('public/'.$OldPhotoName);
  
        $DeleteRow= Photo::where('id','=',$OldPhotoID)->delete();
        return  $DeleteRow;
    }
  
  
      function PhotoUpload(Request $request){
        $photoPath=  $request->file('photo')->store('public');
  
          $photoName=(explode('/',$photoPath))[1];
  
          $host=$_SERVER['HTTP_HOST'];
          $location="http://".$host."/storage/".$photoName;
  
        $result= Photo::insert(['location'=>$location]);
        return $result;
      }






    public function index()
    {
        return view('admin.photo');
        // return view('admin.Image');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'images' => 'required',
        'images.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);
        if($request->TotalImages > 0)
        {
           for ($x = 0; $x < $request->TotalImages; $x++) 
           {
               if ($request->hasFile('images'.$x)) 
                {
                    $file      = $request->file('images'.$x);
                    $path = $file->store('public');

                    $photoName=(explode('/',$path))[1];
                    $name = $file->getClientOriginalName();
                    $host=$_SERVER['HTTP_HOST'];
                    $location="http://".$host."/storage/".$photoName;
                    $insert[$x]['name'] = $name;
                    $insert[$x]['path'] = $location;
                }
           }
           $result=Image::insert($insert);
            return $result;
        }
        else{
           return response()->json(["message" => "Please try again."]);
        }
    }    


    public function uploadGaleryImage(Request $request)
    {

        // dd($request->all());
        
        if($request->UpdateTotalFiles > 0)
        {
           for ($x = 0; $x < $request->UpdateTotalFiles; $x++) 
           {
               if ($request->hasFile('img'.$x)) 
                {
                    $categoryImage = $request->file('img'.$x);
                    $categoryImageSaveAsName = time().$x . Auth::id() . "-image." . $categoryImage->getClientOriginalExtension();
                    // dd($categoryImageSaveAsName);
                    $all_upload_path = 'images/';
                    
                    $all_image_url = $all_upload_path . $categoryImageSaveAsName;

                    Storage::disk('backup_google')->putFileAs("",$request->file('img'.$x), $categoryImageSaveAsName);

                  $backupDisk = Storage::disk('backup_google')->url($categoryImageSaveAsName);

                  $filename = Storage::disk('backup_google')->getMetadata($categoryImageSaveAsName);
                  $path = $filename['path'];


                    $allImagesUpload = Image::create(['name'=>$categoryImageSaveAsName, 'path'=>$backupDisk, 'img_name'=>$path]);
                 }
           }
           if ($allImagesUpload==true) {
            return 1;
          } else {
            return 0;
          }
          
        }else{
            return 'Image is required';
        }
        
    }    


public function getImages()
{
   $result = Image::take(100)->get();
   return $result;
}

function getImageById(Request $request){
    $FirstID=$request->id;
    $LastID=$FirstID+10;
    return Image::where('id','>=',$FirstID)->where('id','<',$LastID)->get();
}


    public function deleteImage(Request $request)
    {
        $id = $request->id;
        $path = $request->path;
    
        global $old_image;
        $category = Image::where('id','=',$id)->first();
        $old_image = $category->path;

        $img_name = $category->img_name;

        $url = Storage::disk('backup_google')->url($img_name);
        if ($url) { 
          $delete = Storage::disk('backup_google')->delete('1ZmAmEf9asspImmiXnu29gTf8RIhJBpmJ/'.$img_name );
        }

        $DeleteRow= Image::where('id','=',$id)->delete();

        if ($DeleteRow==true) {
            return 1;
        }else{
            return 0;
        }
        // return  $DeleteRow;
    }
    public function downloadImg(Request $request)
    {
        $id = $request->id;
        $path = $request->path;

        $imageName = Image::where('id','=',$id)->first();
        $img_name = $imageName->img_name;

        $url = Storage::disk('backup_google')->url($img_name);
        $meta = Storage::disk('backup_google')->getMetadata($img_name);
        $filename = $meta['name'];
        
          $response = Storage::disk('backup_google')->download('1Hg3Ew4c9OJ7Y9qk-Q2ky782p5dzgoNo4','test.jpg');
          $file = $response->send();
       
    }


    public function downloadImgbyid(Request $request)
    {
        $id = $request->id;
        $imageName = Image::where('id','=',$id)->first();
        $img_name = $imageName->img_name;

        $url = Storage::disk('backup_google')->url($img_name);
        $meta = Storage::disk('backup_google')->getMetadata($img_name);
        $filename = $meta['name'];
        $response = Storage::disk('backup_google')->download($img_name, $filename);
        $file = $response->send();  
       
    }


}
