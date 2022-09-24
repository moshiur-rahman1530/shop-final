<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\User;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
  public function __construct()
{
    $this->middleware('auth');
}
  public function addToCartProduct(Request $req)
  {
    Session::forget('coupon');
      $id = $req->input('id');
      $product_id = $req->input('product_id');
      $quantity = $req->input('quantity');

      $priceText = $req->input('price');
      $price = (double) $priceText;
      $userId = Auth::id();
      if($req->input('size')){
        $size =$req->input('size');
      }else{
        $sizeFirst = ProductAttr::where('product_id',$product_id)->where('product_price',$price)->first();
        $size=$sizeFirst->size_id;
      }
      if($req->input('color')){
        $color =$req->input('color');
      }else{
        $colorFirst = ProductAttr::where('product_id',$product_id)->where('product_price',$price)->first();
        $color=$colorFirst->color_id;
      }
      if($req->input('discount')){
        $discount =$req->input('discount');
      }else{
        $discountPriceDec = ProductAttr::where('product_id',$product_id)->where('product_price',$price)->first();
        $discount = $discountPriceDec->discount;
      }

      $checkProductQtn = ProductAttr::where('product_id',$product_id)->where('size_id',$size)->where('color_id',$color)->first();
      

      if($checkProductQtn->qtn<$quantity){
        return 3;
      }else{
// dd($color, $size, $discount);
$UserIP=$_SERVER['REMOTE_ADDR'];
$checkProduct=Cart::where('product_id',$id)->where('product_size',$size)->where('product_color',$color)->where('product_price',$price)->where('user_id',$userId)->first();


$product = Product::find($id);
if ($checkProduct) {
  return 1;
}else if(!$checkProduct){

  $cart = new Cart();
  $cart->user_id=$userId;
  $cart->product_id=$id;
  $cart->product_name=$product->product_name;
  $cart->product_price=$price;
  $cart->qtn=$quantity;
  $cart->product_cat=$product->product_cat;
  $cart->product_subcat=$product->subcat_id;
  $cart->image=$product->product_img;
  $cart->product_brand=$product->brand_id;
  $cart->product_size=$size;
  $cart->product_color=$color;
  $cart->discount=$discount;
  $cart->product_unit=$product->unit_id;
  $cart->ip=$UserIP;
  $cart->save();

  // product qtn decrement from product attr
  

  if($size==null && $color==null){
    $productPriceDec = ProductAttr::where('product_id',$product_id)->where('product_price',$price)->first();
  }else{
    $productPriceDec = ProductAttr::where('product_id',$product_id)->where('size_id',$size)->where('color_id',$color)->where('product_price',$price)->first();
  }

  // dd($productPriceDec);
  $qtns = $productPriceDec->qtn;
  $upqtn = $qtns-$quantity;

  $productPriceDec->update(['qtn'=>$upqtn]);

// product qtn decrement from product attr


  return 2;
}else{
  return 0;
}
      }
         
  }

public function ShippingCartDetailsPage()
{
  return view('cart');
}


public function ShippingCartDetails()
{
  $userid = Auth::id();
  $findallProduct = Cart::where('user_id',$userid)->get();
  // dd($findallProduct);
  return $findallProduct;
}


// increase cart quantity

public function cartIncrement(Request $req)
{
  $id = $req->input('id');
  $product_id = $req->input('product_id');

  $price = $req->input('price');
  $size =$req->input('size');
  $color =$req->input('color');

  $findProduct = Cart::where('id', $id)->first();
  $qtn = $findProduct->qtn;
  $upqtn = $qtn+1;
  if($upqtn>5){
    return 2;
  }
  $result = Cart::where('id','=', $id)->update(['qtn'=>$upqtn]);

   // product qtn decrement from product attr
$productPriceDec = ProductAttr::where('product_id',$product_id)->where('size_id',$size)->where('color_id',$color)->where('product_price',$price)->first();
$qtns = $productPriceDec->qtn;
$upqtnPlus = $qtns-1;

$productPriceDec->update(['qtn'=>$upqtnPlus]);

      // product qtn decrement from product attr


  if ($result==true) {
    return 1;
  } else {
    return 0;
  }
  
}
// decrease cart quantity
public function cartDecrement(Request $req)
{
  $id = $req->input('id');
  $product_id = $req->input('product_id');
  
  $price = $req->input('price');
  $size =$req->input('size');
  $color =$req->input('color');
  
  $findProduct = Cart::where('id', $id)->first();
  $qtn = $findProduct->qtn;
  $upqtn = $qtn-1;
  if($upqtn<=0){
    return 2;
  }
  $result = Cart::where('id','=', $id)->update(['qtn'=>$upqtn]);

     // product qtn decrement from product attr
$productPriceDec = ProductAttr::where('product_id',$product_id)->where('size_id',$size)->where('color_id',$color)->where('product_price',$price)->first();
$qtn = $productPriceDec->qtn;
$upqtnPlus = $qtn+1;
$productPriceDec->update(['qtn'=>$upqtnPlus]);

      // product qtn decrement from product attr

  if ($result==true) {
    return 1;
  } else {
    return 0;
  }
  
}

// cart remove item
public function cartDelete(Request $req)
{
  $id = $req->input('id');
  $product_id = $req->input('product_id');
  
  $price = $req->input('price');
  $size =$req->input('size');
  $color =$req->input('color');
  $catqtn = $req->input('catqtn');
  $result = Cart::where('id','=', $id)->delete();

  // product qtn decrement from product attr
      $productPriceDec = ProductAttr::where('product_id',$product_id)->where('size_id',$size)->where('color_id',$color)->where('product_price',$price)->first();

      $cqtn = $productPriceDec->qtn+$catqtn;
      $productPriceDec->update(['qtn'=>$cqtn]);

      // product qtn decrement from product attr

  if ($result==true) {
    return 1;
  } else {
    return 0;
  }
}


// total count cart

public function allCartItem()
{
  $userId = Auth::id();
  if ($userId) {
    $result = Cart::where('user_id','=',$userId)->count();
    return $result;
  }else{
    return 0;
  }
}
// total count cart

public function subtotal()
{
  $userId = Auth::id();
  if ($userId) {
    $result = Cart::where('user_id','=',$userId)->select('product_price')->sum();
    return $result;
  }else{
    return 0;
  }
}

public function shippingAddress(Request $request)
{

  $shipid = $request->dataId;
  $id = Auth::user()->id;
  $cdata = ['area'=>$request->shippingAddress,'amount'=>$request->shippingAmount];
 
    Session::put('shipping',$cdata);
    User::where('id',$id)->update(['shippingArea'=>$shipid]);
  
}

}
