<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {

      $units = Unit::all();
        return view('admin.Unit',['units'=>$units]);
    }


    public function store(Request $request)
    {
        $name = $request->input('name');
        $result = Unit::insert(['name'=>$name]);
        if ($result==true) {
          return 1;
        } else {
          return 0;
        }

    }

    // details SubCatTableBody
    public function unitsDetails(Request $req)
    {
      $id = $req->input('id');
      $data=json_encode(Unit::where('id','=',$id)->get());
        return $data;

    }

    // update sub category
    public function updateUnit(Request $req)
    {
      $id = $req->input('id');
      $name = $req->input('name');
      $result= Unit::where('id','=',$id)->update([
       	'name'=>$name
       ]);

       if($result==true){
         return 1;
       }
       else{
        return 0;
       }
    }


    // change sub cat Status

    public function unitsStatus(Request $req){
        $id = $req->input('id');
        $data = Unit::where('id',$id)->first();
        if ($data->status == 1) {
          $status = 0;
        } else {
          $status = 1;
        }
        $result = Unit::where('id',$id)->update(['status'=>$status]);
            if ($result==true) {
              return 1;
            } else {
              return 0;
            }
    }


  // get allcategory

  public function allunits()
  {
    $result = Unit::all();
    return $result;
  }
  // delete categoryDelete

    public function unitsDelete(Request $req)
    {
      $id = $req->input('id');
      $result = Unit::where('id','=',$id)->delete();
      if ($result==true) {
        return 1;
      } else {
        return 0;
      }
    }

  }
