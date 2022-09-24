<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Shipping;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Banner;
use App\Models\Ratings;
use App\Models\ProductAttr;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class FilterController extends Controller
{
    public function filterPage(Request $request){

      
        $reqData=$request->sortVal;
        $reqmin=$request->min;
        $reqmax=$request->max;

        $products =  DB::table('products')->leftJoin('product_attrs','product_attrs.product_id','=','products.id');

        if($reqData=='Popularity'){
            $product = $products->orderBy('products.is_featured','DESC')->where('products.is_featured',1)->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
          
        }
        else if($reqData=='Newest'){
            $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
        }
        else if($reqData=='Sales'){
            $product = $products->orderBy('products.product_name','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
        }
        else if($reqData=='LowToHigh'){
            $product = $products->orderBy('product_attrs.product_price','ASC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
        }
        else if($reqData=='HighToLow'){
            $product = $products->orderBy('product_attrs.product_price','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
        }else{
            $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
        }
        $product=$product->get();
        // dd($product);

        return $product;
     }


    public function filterPriceData(Request $request){

      
        $reqData=$request->sortVal;
        $reqmin=$request->min;
        $reqmax=$request->max;

        $products =  DB::table('products')->leftJoin('product_attrs','product_attrs.product_id','=','products.id');

        if($reqData=='Popularity'){
            $product = $products->orderBy('products.is_featured','DESC')->where('products.is_featured',1)->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
          
        }
        else if($reqData=='Newest'){
            $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
        }
        else if($reqData=='Sales'){
            $product = $products->orderBy('products.product_name','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
        }
        else if($reqData=='LowToHigh'){
            $product = $products->orderBy('product_attrs.product_price','ASC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
        }
        else if($reqData=='HighToLow'){
            $product = $products->orderBy('product_attrs.product_price','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
        }else{
            $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
        }
        $product=$product->get();
        // dd($product);

        return $product;
     }

     public function colorFilter(Request $request)
     {
        $size_id = $request->size_id;
        $color_id = $request->color_id;
        $reqData=$request->sortVal;
        $reqmin=$request->min;
        $reqmax=$request->max;

        $products =  DB::table('products')->leftJoin('product_attrs','product_attrs.product_id','=','products.id');
        if(sizeof($size_id) > 0 && sizeof($color_id) > 0){
        if($reqData=='Popularity'){
            $product = $products->orderBy('products.is_featured','DESC')->where('products.is_featured',1)->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id)->whereIn('product_attrs.size_id', $size_id);
        }
        else if($reqData=='Newest'){
            $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id)->whereIn('product_attrs.size_id', $size_id);
        }
        else if($reqData=='Sales'){
            $product = $products->orderBy('products.product_name','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id)->whereIn('product_attrs.size_id', $size_id);
        }
        else if($reqData=='LowToHigh'){
            $product = $products->orderBy('product_attrs.product_price','ASC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id)->whereIn('product_attrs.size_id', $size_id);
        }
        else if($reqData=='HighToLow'){
            $product = $products->orderBy('product_attrs.product_price','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id)->whereIn('product_attrs.size_id', $size_id);
        }else{
            $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id)->whereIn('product_attrs.size_id', $size_id);
        }
    }else if(sizeof($size_id) == 0 && sizeof($color_id) > 0){
        $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id);
    }
    else if(sizeof($size_id) > 0 && sizeof($color_id) == 0){
        $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $size_id);
    }else{
        $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
    }
        $product=$product->get();
        // dd($product);

        return $product;
     }



     public function sizeFilter(Request $request)
     {
        $size_id = $request->size_id;
        $color_id = $request->color_id;
        $reqData=$request->sortVal;
        $reqmin=$request->min;
        $reqmax=$request->max;

        $products =  DB::table('products')->leftJoin('product_attrs','product_attrs.product_id','=','products.id');
        if(sizeof($color_id) > 0 && sizeof($size_id) > 0){
        if($reqData=='Popularity'){
            $product = $products->orderBy('products.is_featured','DESC')->where('products.is_featured',1)->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id)->whereIn('product_attrs.size_id', $size_id);
        }
        else if($reqData=='Newest'){
            $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id)->whereIn('product_attrs.size_id', $size_id);
        }
        else if($reqData=='Sales'){
            $product = $products->orderBy('products.product_name','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id)->whereIn('product_attrs.size_id', $size_id);
        }
        else if($reqData=='LowToHigh'){
            $product = $products->orderBy('product_attrs.product_price','ASC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id)->whereIn('product_attrs.size_id', $size_id);
        }
        else if($reqData=='HighToLow'){
            $product = $products->orderBy('product_attrs.product_price','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id)->whereIn('product_attrs.size_id', $size_id);
        }else{
            $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id)->whereIn('product_attrs.size_id', $size_id);
        }
    }else if(sizeof($size_id) == 0 && sizeof($color_id) > 0){
        $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $color_id);
    }
    else if(sizeof($size_id) > 0 && sizeof($color_id) == 0){
        $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax])->whereIn('product_attrs.color_id', $size_id);
    }else{
        $product = $products->orderBy('products.id','DESC')->whereBetween('product_attrs.product_price', [$reqmin, $reqmax]);
    }
        $product=$product->get();
        // dd($product);

        return $product;
     }

}
