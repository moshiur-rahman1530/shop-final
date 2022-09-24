<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
  // status update
    public function categoryStatus(Request $req)
    {
      $id = $req->input('id');
      $data = DB::table('categories')->where('id',$id)->first();
      if ($data->status == 1) {
        $status = 0;
      } else {
        $status = 1;
      }
      $result = DB::table('categories')->where('id',$id)->update(['status'=>$status]);
          if ($result==true) {
            return 1;
          } else {
            return 0;
          }
    }


    // product status update

    public function productsStatus(Request $req)
    {

      $id = $req->input('id');
      $data = DB::table('products')->where('id',$id)->first();
      if ($data->status == 1) {
        $status = 0;
      } else {
        $status = 1;
      }
      $result = DB::table('products')->where('id',$id)->update(['status'=>$status]);
          if ($result==true) {
            return 1;
          } else {
            return 0;
          }
      
    }


}
