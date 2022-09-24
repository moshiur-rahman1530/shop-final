<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $result = Category::all();
        return view('admin.Category',['category'=>$result]);
    }


      public function catbyproduct()
      {
       
      }

    public function store(Request $request)
    {
      // dd($request->all());
        $name = $request->input('catName');
        $desc = $request->input('catDes');
        $status = $request->input('status');

        $categoryImage = $request->file('catImg');
        $categoryImageSaveAsName = time() . Auth::id() . "-category." . $categoryImage->getClientOriginalExtension();
        // dd($categoryImageSaveAsName);
        $upload_path = 'images/category_image/';
        $all_upload_path = 'images/';
        $category_image_url = $upload_path . $categoryImageSaveAsName;
        $all_image_url = $all_upload_path . $categoryImageSaveAsName;

        Storage::disk('backup_google')->putFileAs("",$request->file('catImg'), $categoryImageSaveAsName);
        Storage::disk('google')->putFileAs("",$request->file('catImg'), $categoryImageSaveAsName);

        $backupDisk = Storage::disk('backup_google')->url($categoryImageSaveAsName);
        $url = Storage::disk('google')->url($categoryImageSaveAsName);
        $filename = Storage::disk('google')->getMetadata($categoryImageSaveAsName);
        $path = $filename['path'];
        $imagefilename = Storage::disk('backup_google')->getMetadata($categoryImageSaveAsName);
        $pathimage = $imagefilename['path'];
     
        $allImagesUpload = Image::create(['name'=>$categoryImageSaveAsName, 'path'=>$backupDisk,'img_name'=>$pathimage]);

        $result = Category::create(['cat_name'=>$name, 'cat_des'=>$desc, 'img_name'=>$path, "cat_img"=>$url,'status'=>$status]);
        if ($result==true) {
          return 1;
        } else {
          return 0;
        }

    }


// get allcategory

  public function allcategory()
  {
    $result = Category::all();
    return $result;
  }

  // details category
  public function categoryDetails(Request $req)
  {
    // dd($id);
    $id = $req->input('id');
    $data=json_encode(Category::where('id','=',$id)->get());

    // dd($data);
    
      return $data;
  }


  // update category
  public function updateCategory(Request $req)
  {
    $id = $req->input('id');
    $name = $req->input('name');
    $description = $req->input('description');

      if($req->hasFile('img')){
        $categoryImage = $req->file('img');
        $categoryImageSaveAsName = time() . Auth::id() . "-category." . $categoryImage->getClientOriginalExtension();
        // dd($categoryImageSaveAsName);
        $upload_path = 'images/category_image/';
        $all_upload_path = 'images/';

        $category_image_url = $upload_path . $categoryImageSaveAsName;
        $all_image_url = $all_upload_path . $categoryImageSaveAsName;

        Storage::disk('backup_google')->putFileAs("",$req->file('img'), $categoryImageSaveAsName);
        Storage::disk('google')->putFileAs("",$req->file('img'), $categoryImageSaveAsName);
      
        $backupUpdateDisk = Storage::disk('backup_google')->url($categoryImageSaveAsName);
        $Updateurl = Storage::disk('google')->url($categoryImageSaveAsName);

        $updatefilename = Storage::disk('google')->getMetadata($categoryImageSaveAsName);
        $updatepath = $updatefilename['path'];

        $imagefilenameupdate = Storage::disk('backup_google')->getMetadata($categoryImageSaveAsName);
        $pathimageupdate = $imagefilenameupdate['path'];



        $allImagesUpload = Image::create(['name'=>$categoryImageSaveAsName,'img_name'=>$pathimageupdate,'path'=>$backupUpdateDisk]);

          global $old_image;
          $categorys = Category::where('id','=',$id)->first();
          $old_image = $categorys->cat_img;
          $img_name = $categorys->img_name;
          $url = Storage::disk('google')->url($img_name);
          if ($url) { 
            $delete = Storage::disk('google')->delete('1kEldWn4ij4tKwSGBO4juAJAO5QN10sO2/'.$img_name );
          }
      }else{
        $findUbcat = Category::where('id','=',$id)->first();
        $Updateurl =$findUbcat->cat_img;
        $updatepath = $findUbcat->img_name;
      }
      

      $result= Category::where('id','=',$id)->update([
        'cat_name'=>$name,
        'cat_des'=>$description,
        'cat_img'=>$Updateurl,
        'img_name'=>$updatepath,
        // 'status'=>$status,
      ]);

     if($result==true){
       return 1;
     }
     else{
      return 0;
     }
  }


// delete categoryDelete

    public function categoryDelete(Request $req)
    {
      $id = $req->input('id');

      global $img_name;
      global $old_image;
        $category = Category::where('id','=',$id)->first();
        $old_image = $category->cat_img;
        $img_name = $category->img_name;

        $url = Storage::disk('google')->url($img_name);
        
            if ($url) { 
              $delete = Storage::disk('google')->delete('1kEldWn4ij4tKwSGBO4juAJAO5QN10sO2/'.$img_name );
            }

      $result = Category::where('id','=',$id)->delete();
      if ($result==true) {
        return 1;
      } else {
        return 0;
      }
    }

}
