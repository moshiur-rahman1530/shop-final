<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Shipping;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Notification;
use App\Notifications\OrderSubmit;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout(Request $req)
    {
      $id=$req->id;
      $userId = Auth::id();
      $category = Category::all();
      $shipping = Shipping::all();
      $cart = Cart::where('user_id','=',$userId)->get();
      $catName = Category::find($id);
      $product = Product::where('product_cat',$id)->get();
      $socialShare = \Share::page(
        'https://kshopper.herokuapp.com/',
        'How to Add Social Media Share Button in Laravel App?'
        )
        ->facebook()
        ->twitter()
        ->linkedin();
      return view('exampleEasycheckout', ['category'=>$category, 'product'=>$product,'catName'=>$catName,'carts'=>$cart,'shipping'=>$shipping, 'socialShare'=>$socialShare]);
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
         $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->cus_name;
        $post_data['cus_email'] = $request->cus_email;
        $post_data['cus_add1'] = $request->cus_addr1;
        $post_data['cus_add2'] = $request->cus_addr2;
        $post_data['cus_state'] = $request->state;
        $post_data['cus_postcode'] = $request->zip;
        $post_data['cus_country'] = $request->country;
        $post_data['cus_phone'] = $request->cus_phone;

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'address2' => $post_data['cus_add2'],
                'country' => $post_data['cus_country'],
                'state' => $post_data['cus_state'],
                'zip' => $post_data['cus_postcode'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {
        // dd($request->all());

        $getRequestData = (array) json_decode($request->cart_json);

    
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $getRequestData['amount']; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $getRequestData['cus_name'];
        $post_data['cus_email'] = $getRequestData['cus_email'];
        $post_data['cus_add1'] = $getRequestData['cus_addr1'];
        $post_data['cus_add2'] = $getRequestData['cus_addr2'];
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = $getRequestData['state'];
        $post_data['cus_postcode'] = $getRequestData['zip'];
        $post_data['cus_country'] = $getRequestData['country'];
        $post_data['cus_phone'] = $getRequestData['cus_phone'];
        $post_data['subTotal'] = $getRequestData['subTotal'];
        $post_data['couponCode'] = $getRequestData['couponCode'];


        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
        ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'subTotal' => $post_data['subTotal'],
                'coupon' => $post_data['couponCode'],
                'payment_type' => "online",
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'address2' => $post_data['cus_add2'],
                'country' => $post_data['cus_country'],
                'state' => $post_data['cus_state'],
                'zip' => $post_data['cus_postcode'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);


            
        $insertId = DB::getPdo()->lastInsertId();

        

       $carts = Cart::where('user_id',Auth::user()->id)->get();
       foreach($carts as $cart){
        $details_product = DB::table('order_details')
        ->updateOrInsert([
           
            'order_number' =>$insertId,
           
            'user_id' =>Auth::user()->id,
            'product_id' =>$cart->product_id,
            'product_price' =>$cart->product_price,
            'product_discount' =>$cart->discount,
            'quantity' =>$cart->qtn,
            'size_id' =>$cart->product_size,
            'color_id' =>$cart->product_color, 
        ]);

        Cart::where('user_id',Auth::user()->id)->delete();
       }
        $post_data['details_product'] = [
            
            'order_number' =>$insertId,
        
            'user_id' =>Auth::user()->id,
            'product_id' =>$cart->product_id,
            'product_price' =>$cart->product_price,
            'product_discount' =>$cart->discount,
            'quantity' =>$cart->qtn,
            'size_id' =>$cart->product_size,
            'color_id' =>$cart->product_color, 
            
        ];

        $post_data['title'] = 'New order created';
        $post_data['actionURL'] = route('userOrderById',$insertId);
        $post_data['fas'] = 'fa-file-alt';
        $adminUsers = Auth::user()->where('is_admin',1)->get();
        //    dd($adminUser);

        foreach($adminUsers as $adminUser){
            Notification::send($adminUser, new OrderSubmit($post_data));
        }
       
       

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

            

    }
    public function cashondelivery(Request $request)
    {
     
        // dd($request['amount']);

        $post_data = array();
        $post_data['total_amount'] = $request['amount']; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request['cus_name'];
        $post_data['cus_email'] = $request['cus_email'];
        $post_data['cus_add1'] = $request['cus_addr1'];
        $post_data['cus_add2'] = $request['cus_addr2'];
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = $request['state'];
        $post_data['cus_postcode'] = $request['zip'];
        $post_data['cus_country'] = $request['country'];
        $post_data['cus_phone'] = $request['cus_phone'];
        $post_data['subTotal'] = $request['subTotal'];
        $post_data['couponCode'] = $request['couponCode'];


        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
        ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'subTotal' => $post_data['subTotal'],
                'coupon' => $post_data['couponCode'],
                // 'coupon' => $post_data['coupon'],
                'payment_type' => "COD",
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'address2' => $post_data['cus_add2'],
                'country' => $post_data['cus_country'],
                'state' => $post_data['cus_state'],
                'zip' => $post_data['cus_postcode'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);


            
        $insertId = DB::getPdo()->lastInsertId();

        

       $carts = Cart::where('user_id',Auth::user()->id)->get();
       foreach($carts as $cart){
        $details_product = DB::table('order_details')
        ->updateOrInsert([
           
            'order_number' =>$insertId,
           
            'user_id' =>Auth::user()->id,
            'product_id' =>$cart->product_id,
            'product_price' =>$cart->product_price,
            'product_discount' =>$cart->discount,
            'quantity' =>$cart->qtn,
            'size_id' =>$cart->product_size,
            'color_id' =>$cart->product_color, 
        ]);

        Cart::where('user_id',Auth::user()->id)->delete();
       }
        $post_data['details_product'] = [
            
            'order_number' =>$insertId,
        
            'user_id' =>Auth::user()->id,
            'product_id' =>$cart->product_id,
            'product_price' =>$cart->product_price,
            'product_discount' =>$cart->discount,
            'quantity' =>$cart->qtn,
            'size_id' =>$cart->product_size,
            'color_id' =>$cart->product_color, 
            
        ];

        $post_data['title'] = 'New order created';
        $post_data['actionURL'] = route('userOrderById',$insertId);
        $post_data['fas'] = 'fa-file-alt';

        $adminUsers = Auth::user()->where('is_admin',1)->get();
        //    dd($adminUser);

        foreach($adminUsers as $adminUser){
            Notification::send($adminUser, new OrderSubmit($post_data));
        }

        if ($update_product==true) {
            return 1;
        }else{
            return 0;
        }
            

    }

    public function success(Request $request)
    {
        // echo "Transaction is Successful";


        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                // echo "<br >Transaction is successfully Completed";
                return Redirect::to("/shop")->withSuccess("Transaction is Successful<br >Transaction is successfully Completed");
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            // echo "Transaction is successfully Completed";
            return Redirect::to("/shop")->withSuccess("Transaction is successfully Completed");
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            // echo "Invalid Transaction";
            return Redirect::to("/shop")->withError("Invalid Transaction");
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
