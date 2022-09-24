<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Unit;
use App\Models\Size;
use App\Models\ProductAttr;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cat = Category::all();
      $subcat = SubCategory::all();
      $brand = Brand::all();
      $unit = Unit::all();
      $size = Size::all();
      $color = Color::all();
        return view('admin.Product',['cats'=>$cat,'subcat'=>$subcat,'brand'=>$brand,'unit'=>$unit,'sizes'=>$size,'color'=>$color]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->all());
        $p_name = $request->input('name');
        $p_desc = $request->input('des');
        $p_cat = $request->input('cat');
        $p_subcat = $request->input('subcat');
        $p_brand = $request->input('brand');
        $p_unit = $request->input('unit');
        $allproduct_image_url =[];
        $allproduct_image_name =[];
        if($request->TotalFiles > 0)
        {
               
           for ($x = 0; $x < $request->TotalFiles; $x++) 
           {
               if ($request->hasFile('img'.$x)) 
                {
                  $file = $request->file('img'.$x);
                  $productImgName = time().$x . Auth::id() . "-product." . $file->getClientOriginalExtension();
                  $upload_path = 'images/product_image/';
                  $all_upload_path = 'images/';
                  // dd($productImgName);
                  $product_image_url = $upload_path . $productImgName;
                  $all_image_url = $all_upload_path . $productImgName;
                  Storage::disk('backup_google')->putFileAs("",$request->file('img'.$x), $productImgName);
                  Storage::disk('google')->putFileAs("",$request->file('img'.$x), $productImgName);

                  $backupDisk = Storage::disk('backup_google')->url($productImgName);
                  $url = Storage::disk('google')->url($productImgName);

                  $filename = Storage::disk('google')->getMetadata($productImgName);
                  $path = $filename['path'];

                  array_push($allproduct_image_url, $url);
                  array_push($allproduct_image_name, $path);
                  $allImagesUpload = Image::create(['name'=>$productImgName,'img_name'=>$path, 'path'=>$backupDisk]);
        
                }
           } 
        }
        
        $p_img = json_encode($allproduct_image_url);
        $name_img = json_encode($allproduct_image_name);
        // dd($p_img);
        $feature = $request->input('feature');
        $condition = $request->input('condition');
        $status = $request->input('status');
        $result = Product::insert(['product_name'=>$p_name,'product_des'=>$p_desc,'product_cat'=>$p_cat,'subcat_id'=>$p_subcat,'brand_id'=>$p_brand,'unit_id'=>$p_unit,'product_img'=>$p_img, 'img_name'=>$name_img,'is_featured'=>$feature,'condition'=>$condition,'status'=>$status]);
        if ($result==true) {
          return 1;
        } else {
          return 0;
        }
      }

    // get all product

    public function allproducts()
    {
      $result = Product::all();
      return $result;
    }

    public function AddProductAttr(Request $request)
    {

      // dd($request->all());
      $product_id = $request->AttrProductModalId;
      $color;
      $size;
      $price;
      $qtn;
      for ($i = 0; $i < count($request->input('color')); $i++) {
        $answers[] = [
            'product_id' => $request->AttrProductModalId,
            'color_id' => $request->color[$i],
            'size_id' => $request->size[$i],
            'product_price' => $request->price[$i],
            'qtn' => $request->quantity[$i],
            'discount' => $request->discount[$i],
            'attr_status' => $request->attrStatus[$i],
        ];

        $check = ProductAttr::where('product_id', $request->AttrProductModalId)->where('color_id',$request->color[$i])->where('size_id',$request->size[$i])->first();
        if($check){
          return response()->json(['success'=>'Already Have Data']);
        }  
    }

    // dd($answers);

    if(!$check){
      ProductAttr::insert($answers);
    }   
          return response()->json(['success'=>'done']);
    }


// details category
public function productDetails(Request $req)
{
  $id = $req->input('id');
  $data=json_encode(Product::where('id','=',$id)->get());
  return $data;
}





// update product
public function updateProduct(Request $req)
{
  // dd($req->all());
  $id = $req->input('id');
  $name = $req->input('name');
  $description = $req->input('description');
  $status = $req->input('status');
  $updateCat = $req->input('productcat');
  $updateSubCat = $req->input('productsubcat');
  $updateBrand = $req->input('brand');
  $updateUnit = $req->input('unit');
  $UpdateTotalFiles = $req->input('UpdateTotalFiles');
  $isFeatured = $req->input('isFeatured');
  $condition = $req->input('condition');

  

  if($req->UpdateTotalFiles > 0)
  {
    $allUpdateProduct_image_url =[];
    $allUpdateProduct_image_name =[];
         
     for ($y = 0; $y < $req->UpdateTotalFiles; $y++) 
     {
         if ($req->hasFile('img'.$y)) 
          {
            $file = $req->file('img'.$y);
            $productUpdateImgName = time().$y . Auth::id() . "-product." . $file->getClientOriginalExtension();
            $upload_path = 'images/product_image/';
            $all_upload_path = 'images/';
            // dd($productUpdateImgName);
            $product_image_url = $upload_path . $productUpdateImgName;
            $all_image_url = $all_upload_path . $productUpdateImgName;

            Storage::disk('backup_google')->putFileAs("",$req->file('img'.$y), $productUpdateImgName);
            Storage::disk('google')->putFileAs("",$req->file('img'.$y), $productUpdateImgName);
          
            $backupUpdateDisk = Storage::disk('backup_google')->url($productUpdateImgName);
            $Updateurl = Storage::disk('google')->url($productUpdateImgName);
    
            $updatefilename = Storage::disk('google')->getMetadata($productUpdateImgName);
            $updatepath = $updatefilename['path'];
           
            array_push($allUpdateProduct_image_url, $Updateurl);
            array_push($allUpdateProduct_image_name, $updatepath);
            
            $allImagesUpload = Image::create(['name'=>$productUpdateImgName, 'path'=>$backupUpdateDisk]);
             
          }
     } 
            global $old_images_update;
            global $old_images_update_name;
            $productUpdate = Product::where('id','=',$id)->first();
            $old_images_update = json_decode($productUpdate->product_img);
            $old_images_update_name = json_decode($productUpdate->img_name);

              
            foreach( $old_images_update_name as $old_imagename){
              $url = Storage::disk('google')->url($old_imagename);
              if ($url) { 
                $delete = Storage::disk('google')->delete('1kEldWn4ij4tKwSGBO4juAJAO5QN10sO2/'.$old_imagename );
              }

            }
            $pup_img = json_encode($allUpdateProduct_image_url);
            $pup_img_name = json_encode($allUpdateProduct_image_name);
  }else{
        $findUbpod = Product::where('id','=',$id)->first();
        $pup_img = $findUbpod->product_img;
        $pup_img_name = $findUbpod->img_name;
  }

  // dd($pup_img);
  
    $result= Product::where('id','=',$id)->update([
      'product_name'=>$name,'product_des'=>$description,'product_cat'=>$updateCat,'subcat_id'=>$updateSubCat,'brand_id'=>$updateBrand,'unit_id'=>$updateUnit,'product_img'=>$pup_img, 'img_name'=>$pup_img_name,'is_featured'=>$isFeatured,'condition'=>$condition,'status'=>$status
    ]);

   if($result==true){
     return 1;
   }
   else{
    return 0;
   }
}



    
// delete product

public function productDelete(Request $req)
{
  $id = $req->input('id');

  

  global $old_images;
    $product = Product::where('id','=',$id)->first();
    $old_images = json_decode($product->product_img);
    $old_images_name = json_decode($product->img_name);

    
   foreach( $old_images_name as $old_image){
      $url = Storage::disk('google')->url($old_image);
      if ($url) { 
        $delete = Storage::disk('google')->delete('1kEldWn4ij4tKwSGBO4juAJAO5QN10sO2/'.$old_image );
      }
   }
  $findProductAttr= ProductAttr::where('product_id',$id)->delete();
  $result = Product::where('id','=',$id)->delete();
  if ($result==true) {
    return 1;
  } else {
    return 0;
  }
}

    
}
