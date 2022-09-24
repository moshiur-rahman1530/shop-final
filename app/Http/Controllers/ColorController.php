<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {

      $colors = Color::all();
        return view('admin.Colors',['colors'=>$colors]);
    }


    public function store(Request $request)
    {
      foreach($request->input('name') as $key => $value) {

        $checkData =   Color::where('color',$value)->first();
        if ($checkData === null) {
          Color::insert(['color'=>$value]);
         }
       }
          return response()->json(['success'=>'done']);

    }

    // details SubCatTableBody
    public function colorsDetails(Request $req)
    {
      $id = $req->input('id');
      $data=Color::where('id','=',$id)->get();
        return $data;

    }

    // update sub category
    public function updateColor(Request $req)
    {
      $id = $req->input('id');
      $name = $req->input('name');
      $result= Color::where('id','=',$id)->update([
       	'color'=>$name
       ]);

       if($result==true){
         return 1;
       }
       else{
        return 0;
       }
    }


    // change sub cat Status

    public function colorsStatus(Request $req){
        $id = $req->input('id');
        $data = Color::where('id',$id)->first();
        if ($data->status == 1) {
          $status = 0;
        } else {
          $status = 1;
        }
        $result = Color::where('id',$id)->update(['status'=>$status]);
            if ($result==true) {
              return 1;
            } else {
              return 0;
            }
    }


  // get allcategory

  public function allcolors()
  {
    $result = Color::all();
    return $result;
  }
  // delete categoryDelete

    public function colorsDelete(Request $req)
    {
      $id = $req->input('id');
      $result = Color::where('id','=',$id)->delete();
      if ($result==true) {
        return 1;
      } else {
        return 0;
      }
    }

  }
