<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {

        $banners = Banner::all();
        return view('admin.Banners',['banners'=>$banners]);
    }


    public function store(Request $request)
    {
        $name = $request->input('bannerName');
        $slug=Str::slug($request->input('bannerName'));
        $desc = $request->input('bannerDes');
        $status = $request->input('status');
        $count=Banner::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }

        $bannerImage = $request->file('bannerImg');
        $bannerImageSaveAsName = time() . Auth::id() . "-banner." . $bannerImage->getClientOriginalExtension();
        // dd($bannerImageSaveAsName);
        $upload_path = 'images/banner_image/';
        $all_upload_path = 'images/';
        $banner_image_url = $upload_path . $bannerImageSaveAsName;
        $all_image_url = $all_upload_path . $bannerImageSaveAsName;

        Storage::disk('backup_google')->putFileAs("",$request->file('bannerImg'), $bannerImageSaveAsName);
        Storage::disk('google')->putFileAs("",$request->file('bannerImg'), $bannerImageSaveAsName);

        $backupDisk = Storage::disk('backup_google')->url($bannerImageSaveAsName);
        $url = Storage::disk('google')->url($bannerImageSaveAsName);

        $filename = Storage::disk('google')->getMetadata($bannerImageSaveAsName);
        $path = $filename['path'];

        $imagefilename = Storage::disk('backup_google')->getMetadata($bannerImageSaveAsName);
        $pathimage = $imagefilename['path'];



        $allImagesUpload = Image::create(['name'=>$bannerImageSaveAsName, 'img_name'=>$pathimage, 'path'=>$backupDisk]);
     
        $result = Banner::insert(['title'=>$name,'slug'=>$slug,'photo'=>$url,'img_name'=>$path,'description'=>$desc,'status'=>$status]);
     
        if ($result==true) {
          return 1;
        } else {
          return 0;
        }

    }

    // details SubCatTableBody
    public function bannersDetails(Request $req)
    {
      $id = $req->input('id');
      $data=json_encode(Banner::where('id','=',$id)->get());
        return $data;
    }

    // update sub category
    public function updateBanner(Request $request)
    {
      $id = $request->input('id');
      $name = $request->input('name');
      $slug=Str::slug($request->input('name'));
      $desc = $request->input('description');
      $count=Banner::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }


        if($request->hasFile('img')){
          $bannerImage = $request->file('img');
          $bannerImageSaveAsName = time() . Auth::id() . "-banner." . $bannerImage->getClientOriginalExtension();
          // dd($bannerImageSaveAsName);
          $upload_path = 'images/banner_image/';
          $all_upload_path = 'images/';
  
          $banner_image_url = $upload_path . $bannerImageSaveAsName;
          $all_image_url = $all_upload_path . $bannerImageSaveAsName;
  
          Storage::disk('backup_google')->putFileAs("",$request->file('img'), $bannerImageSaveAsName);
          Storage::disk('google')->putFileAs("",$request->file('img'), $bannerImageSaveAsName);
        
          $backupUpdateDisk = Storage::disk('backup_google')->url($bannerImageSaveAsName);
          $Updateurl = Storage::disk('google')->url($bannerImageSaveAsName);

          $updatefilename = Storage::disk('google')->getMetadata($bannerImageSaveAsName);
          $updatepath = $updatefilename['path'];
          $imagefilenameupdate = Storage::disk('backup_google')->getMetadata($bannerImageSaveAsName);
         $pathimageupdate = $imagefilenameupdate['path'];
  
          $allImagesUpload = Image::create(['name'=>$bannerImageSaveAsName, 'img_name'=>$pathimageupdate, 'path'=>$backupUpdateDisk]);
          
            global $old_image;
            $banners = Banner::where('id','=',$id)->first();
            $old_image = $banners->photo;

            $img_name = $banners->img_name;
          $url = Storage::disk('google')->url($img_name);
          if ($url) { 
            $delete = Storage::disk('google')->delete('1kEldWn4ij4tKwSGBO4juAJAO5QN10sO2/'.$img_name );
          }

        }else{
          $findUbcat = Banner::where('id','=',$id)->first();
          $Updateurl =$findUbcat->photo;
          $updatepath = $findUbcat->img_name;
        }


      $result= Banner::where('id','=',$id)->update([
        'title'=>$name,'slug'=>$slug,'photo'=>$Updateurl, 'img_name'=>$updatepath, 'description'=>$desc,
       ]);
   
       if($result==true){
         return 1;
       }
       else{
        return 0;
       }
    }


    // change sub cat Status

    public function bannersStatus(Request $req){
        $id = $req->input('id');
        $data = Banner::where('id',$id)->first();
        if ($data->status == 1) {
          $status = 0;
        } else {
          $status = 1;
        }
        $result = Banner::where('id',$id)->update(['status'=>$status]);
            if ($result==true) {
              return 1;
            } else {
              return 0;
            }
    }


  // get allcategory

  public function allbanners()
  {
    $result = Banner::all();
    return $result;
  }
  // delete categoryDelete

    public function bannersDelete(Request $req)
    {
      $id = $req->input('id');


      global $old_image;
        $banners = Banner::where('id','=',$id)->first();
        $old_image = $banners->photo;

        $img_name = $banners->img_name;

            $url = Storage::disk('google')->url($img_name);
            if ($url) { 
              $delete = Storage::disk('google')->delete('1kEldWn4ij4tKwSGBO4juAJAO5QN10sO2/'.$img_name );
            }
       

      $result = Banner::where('id','=',$id)->delete();
      if ($result==true) {
        return 1;
      } else {
        return 0;
      }
    }

  }
