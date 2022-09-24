<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
  public function index()
  {

    $brands = Brand::all();
      return view('admin.Brand',['brands'=>$brands]);
  }


  public function store(Request $request)
  {

    // dd($request->all());
      $name = $request->input('name');
      $desc = $request->input('description');
      $status = $request->input('status');


      $brandImageforAllImage = $request->file('img');
      $brandImage = $request->file('img');
      $brandImageSaveAsName = time() . Auth::id() . "-brand." . $brandImage->getClientOriginalExtension();
      // dd($brandImageSaveAsName);
      $upload_path = 'brands_image/';
      $all_upload_path = 'images/';
      $brand_image_url = $upload_path . $brandImageSaveAsName;
      $all_image_url = $all_upload_path . $brandImageSaveAsName;
      
      Storage::disk('backup_google')->putFileAs("",$request->file('img'), $brandImageSaveAsName);
      Storage::disk('google')->putFileAs("",$request->file('img'), $brandImageSaveAsName);

      $backupDisk = Storage::disk('backup_google')->url($brandImageSaveAsName);
      $url = Storage::disk('google')->url($brandImageSaveAsName);

      $filename = Storage::disk('google')->getMetadata($brandImageSaveAsName);
      $path = $filename['path'];

        $imagefilename = Storage::disk('backup_google')->getMetadata($brandImageSaveAsName);
        $pathimage = $imagefilename['path'];

      $allImagesUpload = Image::create(['name'=>$brandImageSaveAsName, 'img_name'=>$pathimage, 'path'=>$backupDisk]);

      $result = Brand::create(['name'=>$name, 'description'=>$desc, "img"=>$url, "img_name"=>$path,'status'=>$status]);
     
      if ($result==true) {
        return 1;
      } else {
        return 0;
      }

  }

  // details SubCatTableBody
  public function brandsDetails(Request $req)
  {
    $id = $req->input('id');
    $data=json_encode(Brand::where('id','=',$id)->get());
      return $data;
  }

  // update brand
  public function updateBrand(Request $req)
  {
    $id = $req->input('id');
    $name = $req->input('name');
    $description = $req->input('description');

    if($req->hasFile('img')){
      $brandImage = $req->file('img');
      $brandImageSaveAsName = time() . Auth::id() . "-brand." . $brandImage->getClientOriginalExtension();
      // dd($brandImageSaveAsName);
      $upload_path = 'brands_image/';
      $all_upload_path = 'images/';

      $brand_image_url = $upload_path . $brandImageSaveAsName;
      $all_image_url = $all_upload_path . $brandImageSaveAsName;

      Storage::disk('backup_google')->putFileAs("",$req->file('img'), $brandImageSaveAsName);
      Storage::disk('google')->putFileAs("",$req->file('img'), $brandImageSaveAsName);
    
      $backupUpdateDisk = Storage::disk('backup_google')->url($brandImageSaveAsName);
      $Updateurl = Storage::disk('google')->url($brandImageSaveAsName);

      $updatefilename = Storage::disk('google')->getMetadata($brandImageSaveAsName);
      $updatepath = $updatefilename['path'];
      $imagefilenameupdate = Storage::disk('backup_google')->getMetadata($brandImageSaveAsName);
      $pathimageupdate = $imagefilenameupdate['path'];

      $allImagesUpload = Image::create(['name'=>$brandImageSaveAsName, 'img_name'=>$pathimageupdate, 'path'=>$backupUpdateDisk]);

        global $old_image;
        global $img_name;
        $brands = Brand::where('id','=',$id)->first();
        $old_image = $brands->img;

        $img_name = $brands->img_name;
          $urls = Storage::disk('google')->url($img_name);
          if ($urls) { 
            Storage::disk('google')->delete('1kEldWn4ij4tKwSGBO4juAJAO5QN10sO2/'.$img_name );
          }
       
    }else{
        $findUbcat = Brand::where('id','=',$id)->first();
        $Updateurl =$findUbcat->img;
        $updatepath = $findUbcat->img_name;
    }
      

      $result= Brand::where('id','=',$id)->update([
        'name'=>$name,
        'description'=>$description,
        'img'=>$Updateurl,
        'img_name'=>$updatepath,
      ]);

     if($result==true){
       return 1;
     }
     else{
      return 0;
     }
  }


  // change sub cat Status

  public function brandsStatus(Request $req){
      $id = $req->input('id');
      $data = Brand::where('id',$id)->first();
      if ($data->status == 1) {
        $status = 0;
      } else {
        $status = 1;
      }
      $result = Brand::where('id',$id)->update(['status'=>$status]);
          if ($result==true) {
            return 1;
          } else {
            return 0;
          }
  }


// get allcategory

public function allbrands()
{
  $result = Brand::all();
  return $result;
}
// delete categoryDelete

  public function brandsDelete(Request $req)
  {
    $id = $req->input('id');
        global $old_image;
        $brands = Brand::where('id','=',$id)->first();
        $old_image = $brands->img;
        $img_name = $brands->img_name;

        $url = Storage::disk('google')->url($img_name);
        if ($url) { 
          $delete = Storage::disk('google')->delete('1kEldWn4ij4tKwSGBO4juAJAO5QN10sO2/'.$img_name );
        }
    
    
    $result = Brand::where('id','=',$id)->delete();
    if ($result==true) {
      return 1;
    } else {
      return 0;
    }
  }

}
