<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Order;
use App\Models\order_details;
use Illuminate\Support\Facades\DB;
use PDF;
use Mail;
use Notification;
use App\Notifications\OrderConfirmNotification;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function settings(){
        $result=Settings::first();
        return view('admin.Settings')->with('data',$result);
    }

    public function settingsUpdate(Request $request){
        // return $request->all();
        $this->validate($request,[
            'title_first_letter'=>'required|string',
            'title_remain'=>'required|string',
            // 'quote'=>'required|string',
            'short_des'=>'required|string',
            'description'=>'required|string',
            'photo'=>'required',
            'logo'=>'required',
            'address1'=>'required|string',
            'address2'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|string',
            'footer1'=>'required|string',
            'footer2'=>'required|string',
            'footer3'=>'required|string',
            'icon1'=>'required|string',
            'feature1'=>'required|string',
            'icon2'=>'required|string',
            'feature2'=>'required|string',
            'icon3'=>'required|string',
            'feature3'=>'required|string',
            'icon4'=>'required|string',
            'feature4'=>'required|string',
            'vendor1'=>'required',
            'vendor2'=>'required',
            'vendor3'=>'required',
            'vendor4'=>'required',
            'vendor5'=>'required',
            'vendor6'=>'required',
            'vendor7'=>'required',
            'vendor8'=>'required',

        ]);
        $data=$request->all();
        // dd($data);
        $settings=Settings::first();
        $status=$settings->update($data);
        if($status){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function allOrdersPage()
    {
        return view('admin.order.index');
    }

    public function allOrders()
    {
        $result = Order::orderBy('id','DESC')->where('status','!=','Cancel')->get();

        return $result;
    }

    public function OrdersDetails(Request $req)
    {
      $id = $req->input('id');
      $data=Order::where('id','=',$id)->get();
        return $data;
    }


    public function updateOrderStatus(Request $request)
    {
      $id = $request->input('id');
      $status = $request->input('status');
        
      $result= Order::where('id','=',$id)->update([
        'status'=>$status
       ]);

        
       $order = Order::find($id);
  
       
       $Settings = Settings::first();
       
       $orderDetails = order_details::where('order_number',$id)->get();
       $products = [];
       foreach($orderDetails as $details){
         $products[] =  DB::table('products')->leftJoin('product_attrs','product_attrs.product_id','=','products.id')->where('product_id',$details->product_id)->where('size_id',$details->size_id)->where('color_id',$details->color_id)->get();
       }
    
        $data["email"] = $order->email;
        $data["web"] = "BShopper.com";
        $data["body"] = 'This is demo';
        $data["order"] = $order;
        $data["order_details"] = $orderDetails;
        $data["products"] = $products;
        $data["Settings"] = $Settings;
        $data["date"] = date('m/d/Y');

        $data['title'] = 'Order Status';
        $data['actionURL'] = route('userOrderDetails',$order->id);
        $data['fas'] = 'fa-file-alt';

        $userSchema = Auth::user()->where('name',$order->name)->where('email',$order->email)->where('phone',$order->phone)->first();

        Notification::send($userSchema, new OrderConfirmNotification($data));
  
        $pdf = PDF::loadView('admin.order.myTestMail', $data);
  
        Mail::send('admin.order.myTestMail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });
  

       if($result==true){
         return 1;
       }
       else{
        return 0;
       }
    }


    public function AdminOrderDetails(Request $request, $id)
      {

        $OId = (int) $id;
        
        $order = Order::where('id',$OId)->first();
        
        $orderDetails = order_details::where('order_number',$OId)->get();
        $products = [];
        foreach($orderDetails as $details){
          $products[] =  DB::table('products')->leftJoin('product_attrs','product_attrs.product_id','=','products.id')->where('product_id',$details->product_id)->where('size_id',$details->size_id)->where('color_id',$details->color_id)->get();
        }

        return view('admin.order.orderDetails',['order'=>$order, 'orderDetails'=>$orderDetails,'products'=>$products]);
      }


      public function AdminPdfInvoiceGenarate(Request $request, $id)
      {
        $OId = (int) $id;
        
        $order = Order::find($OId);
        $Settings = Settings::first();
        
        $orderDetails = order_details::where('order_number',$OId)->get();
        $products = [];
        foreach($orderDetails as $details){
          $products[] =  DB::table('products')->leftJoin('product_attrs','product_attrs.product_id','=','products.id')->where('product_id',$details->product_id)->where('size_id',$details->size_id)->where('color_id',$details->color_id)->get();
        }


          $data = [
              'title' => 'Welcome to ItSolutionStuff.com',
              'date' => date('m/d/Y')
          ];
            
          $pdf = PDF::loadView('admin.order.AdminPdfInvoice', $data, ['order'=>$order, 'orderDetails'=>$orderDetails,'products'=>$products,'Settings'=>$Settings])->setOptions(['defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

          $pdf->getDomPDF()->setHttpContext( stream_context_create([ 'ssl' => [ 'allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ] ]) );
      
          return $pdf->download('invoice.pdf');
      }


      public function AdminPdfInvoiceViewGenarate(Request $request, $id)
      {
        $OId = (int) $id;
        
        $order = Order::find($OId);
        $Settings = Settings::first();
        
        $orderDetails = order_details::where('order_number',$OId)->get();
        $products = [];
        foreach($orderDetails as $details){
          $products[] =  DB::table('products')->leftJoin('product_attrs','product_attrs.product_id','=','products.id')->where('product_id',$details->product_id)->where('size_id',$details->size_id)->where('color_id',$details->color_id)->get();
        }


          $data = [
              'title' => 'Welcome to ItSolutionStuff.com',
              'date' => date('m/d/Y')
          ];

            
          $pdf = PDF::loadView('admin.order.AdminPdfInvoice', $data, ['order'=>$order, 'orderDetails'=>$orderDetails,'products'=>$products,'Settings'=>$Settings])->setOptions(['defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
          // for google drive image show add this
          $pdf->getDomPDF()->setHttpContext( stream_context_create([ 'ssl' => [ 'allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ] ]) );
      
          return $pdf->stream('invoice.pdf');
      }


      public function AdminOrdersDelete(Request $req)
      {
        $id = $req->input('id');
        $result= Order::where('id','=',$id)->update([
            'status'=>'Cancel'
           ]);
    
        if ($result==true) {
          return 1;
        } else {
          return 0;
        }
      }


}
