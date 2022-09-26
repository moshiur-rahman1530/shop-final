<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Order;
use App\Models\Image;
use App\Models\order_details;
use Illuminate\Support\Facades\DB;
use PDF;
use Mail;
use Notification;
use App\Notifications\OrderConfirmNotification;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

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

        ]);

        $firstSetting = Settings::first();

        if (request()->hasFile('logo')){

          $logo = $request->file('logo');
          $logoSaveAsName = time() . Auth::id() . "-sitelogo." . $logo->getClientOriginalExtension();
          Storage::disk('backup_google')->putFileAs("",$request->file('logo'), $logoSaveAsName);
          $logoBackupDisk = Storage::disk('backup_google')->url($logoSaveAsName);
          $logoFilename = Storage::disk('backup_google')->getMetadata($logoSaveAsName);
          $logoFolderId = $logoFilename['path'];
          $allImagesUpload = Image::create(['name'=>$logoSaveAsName, 'img_name'=>$logoFolderId, 'path'=>$logoBackupDisk]);

        }else{
          $logoBackupDisk= $firstSetting->logo;
        }

        if (request()->hasFile('photo')){

          $photo = $request->file('photo');
          $photoSaveAsName = time() . Auth::id() . "-sitephoto." . $photo->getClientOriginalExtension();
          Storage::disk('backup_google')->putFileAs("",$request->file('photo'), $photoSaveAsName);
          $photoBackupDisk = Storage::disk('backup_google')->url($photoSaveAsName);
          $photoFilename = Storage::disk('backup_google')->getMetadata($photoSaveAsName);
          $photoFolderId = $photoFilename['path'];
          $allImagesUpload = Image::create(['name'=>$photoSaveAsName, 'img_name'=>$photoFolderId, 'path'=>$photoBackupDisk]);

        }else{
          $photoBackupDisk= $firstSetting->photo;
        }



        if (request()->hasFile('vendor1')){

          $vendor1 = $request->file('vendor1');
          $vendor1SaveAsName = time() . Auth::id() . "-vendor." . $vendor1->getClientOriginalExtension();
          Storage::disk('backup_google')->putFileAs("",$request->file('vendor1'), $vendor1SaveAsName);
          $vendor1BackupDisk = Storage::disk('backup_google')->url($vendor1SaveAsName);
          $vendor1Filename = Storage::disk('backup_google')->getMetadata($vendor1SaveAsName);
          $vendor1FolderId = $vendor1Filename['path'];
          $allImagesUpload = Image::create(['name'=>$vendor1SaveAsName, 'img_name'=>$vendor1FolderId, 'path'=>$vendor1BackupDisk]);

        }else{
          $vendor1BackupDisk= $firstSetting->vendor1;
        }

        if (request()->hasFile('vendor2')){

          $vendor2 = $request->file('vendor2');
          $vendor2SaveAsName = time() . Auth::id() . "-vendor." . $vendor2->getClientOriginalExtension();
          Storage::disk('backup_google')->putFileAs("",$request->file('vendor2'), $vendor2SaveAsName);
          $vendor2BackupDisk = Storage::disk('backup_google')->url($vendor2SaveAsName);
          $vendor2Filename = Storage::disk('backup_google')->getMetadata($vendor2SaveAsName);
          $vendor2FolderId = $vendor2Filename['path'];
          $allImagesUpload = Image::create(['name'=>$vendor2SaveAsName, 'img_name'=>$vendor2FolderId, 'path'=>$vendor2BackupDisk]);

        }else{
          $vendor2BackupDisk= $firstSetting->vendor2;
        }
        if (request()->hasFile('vendor3')){

          $vendor3 = $request->file('vendor3');
          $vendor3SaveAsName = time() . Auth::id() . "-vendor." . $vendor3->getClientOriginalExtension();
          Storage::disk('backup_google')->putFileAs("",$request->file('vendor3'), $vendor3SaveAsName);
          $vendor3BackupDisk = Storage::disk('backup_google')->url($vendor3SaveAsName);
          $vendor3Filename = Storage::disk('backup_google')->getMetadata($vendor3SaveAsName);
          $vendor3FolderId = $vendor3Filename['path'];
          $allImagesUpload = Image::create(['name'=>$vendor3SaveAsName, 'img_name'=>$vendor3FolderId, 'path'=>$vendor3BackupDisk]);

        }else{
          $vendor3BackupDisk= $firstSetting->vendor3;
        }
        if (request()->hasFile('vendor4')){

          $vendor4 = $request->file('vendor4');
          $vendor4SaveAsName = time() . Auth::id() . "-vendor." . $vendor4->getClientOriginalExtension();
          Storage::disk('backup_google')->putFileAs("",$request->file('vendor4'), $vendor4SaveAsName);
          $vendor4BackupDisk = Storage::disk('backup_google')->url($vendor4SaveAsName);
          $vendor4Filename = Storage::disk('backup_google')->getMetadata($vendor4SaveAsName);
          $vendor4FolderId = $vendor4Filename['path'];
          $allImagesUpload = Image::create(['name'=>$vendor4SaveAsName, 'img_name'=>$vendor4FolderId, 'path'=>$vendor4BackupDisk]);

        }else{
          $vendor4BackupDisk= $firstSetting->vendor4;
        }
        if (request()->hasFile('vendor5')){

          $vendor5 = $request->file('vendor5');
          $vendor5SaveAsName = time() . Auth::id() . "-vendor." . $vendor5->getClientOriginalExtension();
          Storage::disk('backup_google')->putFileAs("",$request->file('vendor5'), $vendor5SaveAsName);
          $vendor5BackupDisk = Storage::disk('backup_google')->url($vendor5SaveAsName);
          $vendor5Filename = Storage::disk('backup_google')->getMetadata($vendor5SaveAsName);
          $vendor5FolderId = $vendor5Filename['path'];
          $allImagesUpload = Image::create(['name'=>$vendor5SaveAsName, 'img_name'=>$vendor5FolderId, 'path'=>$vendor5BackupDisk]);

        }else{
          $vendor5BackupDisk= $firstSetting->vendor5;
        }
        if (request()->hasFile('vendor6')){

          $vendor6 = $request->file('vendor6');
          $vendor6SaveAsName = time() . Auth::id() . "-vendor." . $vendor6->getClientOriginalExtension();
          Storage::disk('backup_google')->putFileAs("",$request->file('vendor6'), $vendor6SaveAsName);
          $vendor6BackupDisk = Storage::disk('backup_google')->url($vendor6SaveAsName);
          $vendor6Filename = Storage::disk('backup_google')->getMetadata($vendor6SaveAsName);
          $vendor6FolderId = $vendor6Filename['path'];
          $allImagesUpload = Image::create(['name'=>$vendor6SaveAsName, 'img_name'=>$vendor6FolderId, 'path'=>$vendor6BackupDisk]);

        }else{
          $vendor6BackupDisk= $firstSetting->vendor6;
        }
        if (request()->hasFile('vendor7')){
          $vendor7 = $request->file('vendor7');
          $vendor7SaveAsName = time() . Auth::id() . "-vendor." . $vendor7->getClientOriginalExtension();
          Storage::disk('backup_google')->putFileAs("",$request->file('vendor7'), $vendor7SaveAsName);
          $vendor7BackupDisk = Storage::disk('backup_google')->url($vendor7SaveAsName);
          $vendor7Filename = Storage::disk('backup_google')->getMetadata($vendor7SaveAsName);
          $vendor7FolderId = $vendor7Filename['path'];
          $allImagesUpload = Image::create(['name'=>$vendor7SaveAsName, 'img_name'=>$vendor7FolderId, 'path'=>$vendor7BackupDisk]);

        }else{
          $vendor7BackupDisk= $firstSetting->vendor7;
        }
        if (request()->hasFile('vendor8')){

          $vendor8 = $request->file('vendor8');
          $vendor8SaveAsName = time() . Auth::id() . "-vendor." . $vendor8->getClientOriginalExtension();
          Storage::disk('backup_google')->putFileAs("",$request->file('vendor8'), $vendor8SaveAsName);
          $vendor8BackupDisk = Storage::disk('backup_google')->url($vendor8SaveAsName);
          $vendor8Filename = Storage::disk('backup_google')->getMetadata($vendor8SaveAsName);
          $vendor8FolderId = $vendor8Filename['path'];
          $allImagesUpload = Image::create(['name'=>$vendor8SaveAsName, 'img_name'=>$vendor8FolderId, 'path'=>$vendor8BackupDisk]);

        }else{
          $vendor8BackupDisk= $firstSetting->vendor8;
        }

        // $data=$request->all();
        // $settings=Settings::first();
        // $status=$settings->update($data);

        $result= Settings::first()->update([
          'title_first_letter'=>$request->title_first_letter,
          'title_remain'=>$request->title_remain,
          'description'=>$request->description,
          'short_des'=>$request->short_des,
          'logo'=>$logoBackupDisk,
          'photo'=>$photoBackupDisk,
          'address1'=>$request->address1,
          'address2'=>$request->address2,
          'phone'=>$request->phone,
          'email'=>$request->email,
          'icon1'=>$request->icon1,
          'icon2'=>$request->icon2,
          'icon3'=>$request->icon3,
          'icon4'=>$request->icon4,
          'feature1'=>$request->feature1,
          'feature2'=>$request->feature2,
          'feature3'=>$request->feature3,
          'feature4'=>$request->feature4,
          'vendor1'=>$vendor1BackupDisk,
          'vendor2'=>$vendor2BackupDisk,
          'vendor3'=>$vendor3BackupDisk,
          'vendor4'=>$vendor4BackupDisk,
          'vendor5'=>$vendor5BackupDisk,
          'vendor6'=>$vendor6BackupDisk,
          'vendor7'=>$vendor7BackupDisk,
          'vendor8'=>$vendor8BackupDisk,
        ]);


        if($result){
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
