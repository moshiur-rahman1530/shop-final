<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hi</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css">
    * {

    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    tr.top-tr{
       
        padding: 5px;
    }
    tr.top-tr td{
        border-top:1px solid lightgray!important;
    }

    .img-fluid{
        width:60px;
        height: 60px;
    }
    p {
            line-height: 0;
            margin: 0px 0px 0px 0px !important;
            padding: 0px 0px 0px 0px !important;
            white-space: normal;
        }
        .invoicepre{
            white-space: pre-line;

        }

        .card {
        background-color: dodgerblue;
        color: white;
        padding: 1rem;
        height: 4rem;
        }

        .cards {
        max-width: 1200px;

        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 1rem;
        
        }


</style>
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

  <table width="100%">
    <tr>
        <td><strong>From:</strong> {{$Settings->title_first_letter}}{{$Settings->title_remain}}</td>
        <td><strong>To:</strong> {{Auth::user()->name}}</td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Products</th>
        <th>Product Image</th>
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

    $couponDiscount = App\Models\Coupon::where('code',$order->coupon)->first();
    $shippingCharge = App\Models\Shipping::where('id',Auth::user()->shippingArea)->first();
  
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
                
                <td>
                    <img class="img-fluid" src="{{$productImgDecoded[0]}}" alt="">
            
            </td>
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

<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>


