<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
    @php 
        $userName = Auth::user()->where('is_admin','=',1)->first();
    @endphp

    <table width="100%">
    <tr>
        <td valign="top" align="left">
        <h4>Invoice</h4>
            <pre class="invoicepre">
            ID: #{{$order->id}}
            Issue Date: {{$order->created_at}}
            Status: {{$order->status}}
            </pre>
        </td>


        <td align="right">
            <h4>{{ $title }}</h4>
            <pre>
                {{$userName->name}}
                Address: {{$Settings->address1}}
                Email: {{$Settings->email}}
                Phone: {{$Settings->phone}}
            </pre>
        </td>
    </tr>

  </table>
  @php
  $userOrderDetailsOrderId = App\Models\order_details::where('order_number',$order->id)->first();
  $orderedUser = App\Models\user::where('id',$userOrderDetailsOrderId->user_id)->first();
  @endphp

  <table width="100%">
    <tr>
        <td><strong>From:</strong> {{$Settings->title_first_letter}}{{$Settings->title_remain}}</td>
        <td><strong>To:</strong> {{$orderedUser->name}}, {{$orderedUser->email}}, {{$orderedUser->phone}}, {{$orderedUser->shippingArea}}</td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Products Name</th>
        <th>Unit Price $</th>
        <th>Discount $</th>
        <th>Quantity</th>
        <th>Total $</th>
      </tr>
    </thead>
    <tbody>

        

    @php 
    $i=1;
    $subTotal =0;

    $userOrderDetailsWithOrderId = App\Models\order_details::where('order_number',$order->id)->first();

    $userIdFindShipping = App\Models\user::where('id',$userOrderDetailsWithOrderId->user_id)->first();

    $couponDiscount = App\Models\Coupon::where('code',$order->coupon)->first();
    $shippingCharge = App\Models\Shipping::where('id',$userIdFindShipping->shippingArea)->first();
  
    @endphp

        @foreach($products as $index =>$product)
            
            
            @foreach($order->OrderItems as $details)

            @if($product[0]->size_id==$details->size_id && $product[0]->color_id==$details->color_id && $product[0]->product_id==$details->product_id && $product[0]->product_price==$details->product_price)

                <tr>
                <th scope="row">{{$i++}}</th>
                <td align="right">{{$product[0]->product_name}}</td>
                @php
                $productImgDecoded = json_decode($product[0]->product_img);
                $imgex = explode("/", $productImgDecoded[0]);
             
                $subTotal +=($product[0]->product_price*$details->quantity)-($product[0]->discount*$details->quantity);
                
            
                @endphp

                <td align="right">{{$product[0]->product_price}}</td>
                <td align="right">{{$product[0]->discount}}</td>
                
            
                <td align="right">{{$details->quantity}}</td>
            
                
                <td align="right">{{($product[0]->product_price*$details->quantity)-($product[0]->discount*$details->quantity)}}</td>
            
                </tr>
                @endif
            @endforeach
        @endforeach 

    </tbody>

    <tfoot>
        <tr>
            <td colspan="5"></td>
            <td align="right">Subtotal $</td>
            <td align="right">{{$subTotal}}</td>
        </tr>



        @if($order->coupon != 'null')
        <tr>
            <td colspan="5"></td>
            <td align="right">Coupon Discount</td>
            <td align="right">{{$couponDiscount->value}}</td>
        </tr>
        @else
        <tr>
            <td colspan="5"></td>
            <td align="right">Coupon Discount</td>
            <td align="right">0</td>
        </tr>
        @endif
        <tr>
            <td colspan="5"></td>
            <td align="right">Shipping Charge $</td>
            <td align="right">{{$shippingCharge->price}}</td>
        </tr>
        
        <tr class="top-tr">
            <td colspan="5"></td>
            <td align="right">Total $</td>
            @if($order->coupon != 'null')
            <td align="right" class="gray">{{$subTotal-$couponDiscount->value+$shippingCharge->price}}</td>
            @else
            <td align="right" class="gray">{{$subTotal-0+$shippingCharge->price}}</td>
            @endif
        </tr>
    </tfoot>
  </table>

<div>
    <span class="text-secondary-d1 text-105">Thank you for your business</span>
    <span class="px-4 float-right mt-3 mt-lg-0">Stamp</span>
</div>


</body>
</html>