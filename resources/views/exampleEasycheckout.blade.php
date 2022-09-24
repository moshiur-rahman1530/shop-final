@extends('layouts.app2')
@section('socialIcon')
    @include('layouts.socialhome')
@endsection

@section('content')


<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

<div class="container mb-5">

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                @if(sizeof($carts)>0)
                <span class="badge badge-secondary badge-pill">
                    {{$carts->count()}}
                </span>
                @else
                <span class="badge badge-secondary badge-pill">
                    0
                </span>
                @endif
            </h4>
            <ul class="list-group mb-3">
                @php
                $subtotalProductPrice =0;
                $subtotal =0;
                @endphp

                @foreach($carts as $cart)

               

                @php 
                $productPriceWithQtn = ($cart->product_price*$cart->qtn)-($cart->discount*$cart->qtn);

                $subtotalProductPrice += $cart->product_price*$cart->qtn;

                $subtotal =$subtotal+$productPriceWithQtn;

                
                $sizes = App\Models\Size::where('id',$cart->product_size)->get();
                foreach($sizes as $size){

                }
                $colors = App\Models\Color::where('id',$cart->product_color)->get();
                foreach($colors as $color){

                }
                @endphp
                
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{$cart->product_name}}</h6>
                        <small class="text-muted">Quantity = {{$cart->qtn}}</small> | <small class="text-muted">Size = {{$size->size}}</small> | <small class="text-muted">Color = {{$color->color}}</small>
                    </div>
                    <span class="text-muted">{{($cart->product_price*$cart->qtn)-($cart->discount*$cart->qtn)}}</span>
                </li>
                @endforeach
                <input type="hidden" name="" id="subTotal" value="{{$subtotal}}">
                @php 
                        if(!empty(Session::get('coupon'))){
                            $couponData = Session::get('coupon');
                            $couponamount = $couponData['couponAmount'];
                            $couponId = $couponData['id'];
                            $couponCode = $couponData['code'];
                          }else{
                            $couponamount=0;
                            $couponId='null';
                            $couponCode='null';
                          } 
                          $userArea = Auth::user()->shippingArea;
                          $shiparea = App\Models\Shipping::where('id',$userArea)->first();

                        if(!empty(Session::get('shipping'))){
                            $shippingData = Session::get('shipping');
                            $shippingArea = $shippingData['area'];
                            $shippingAmount = $shippingData['amount'];
                          }else{
                            $shippingAmount=0;
                          } 
                          
                @endphp

                <input type="hidden" name="" id="coupon" value="{{$couponId}}">
                <input type="hidden" name="" id="couponCode" value="{{$couponCode}}">

                <li class="list-group-item d-flex justify-content-between">
                    <span>Shipping (BDT)</span>
                    <strong>{{$shiparea->price}} TK</strong>
                </li>
               
                <li class="list-group-item d-flex justify-content-between">
                    <span>Coupon Discount (BDT)</span>
                    <strong>{{$couponamount}} TK</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (BDT)</span>
                    @php 
                    $total = $subtotal + $shiparea->price - $couponamount;
                    @endphp
                    <strong>{{$total}} TK</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form method="POST" class="needs-validation" novalidate>
                @php 
                $user = Auth::user();
                
                @endphp
            {{ csrf_field() }}
            <input type="hidden" id="total_amount" name="total_amount" value="{{$total}}">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="firstName">Full name</label>
                        <input type="text" disabled name="customer_name" class="form-control" id="customer_name" placeholder=""
                               value="{{$user->name}}" required>
                        <div class="invalid-feedback">
                            Valid customer name is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="mobile">Mobile</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+88</span>
                        </div>
                        <input type="text" name="customer_mobile" class="form-control" id="mobile" placeholder="Mobile"
                               value="{{$user->phone}}" disabled required>
                        <div class="invalid-feedback" style="width: 100%;">
                            Your Mobile number is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" name="customer_email" class="form-control" id="email"
                           placeholder="you@example.com" value="{{$user->email}}" disabled required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" name="customer_addtess1" class="form-control" id="address" placeholder="1234 Main St"
                           value="93 B, New Eskaton Road" required>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" name="customer_addtess1" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" name="customer_country" id="country" required>
                            <option value="">Choose...</option>
                            <option value="Bangladesh">Bangladesh</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>

                       
                            <input class="form-control d-block w-100" disabled name="customer_state" id="state" data-id="{{$shiparea->id}}" type="text" value="{{$shiparea->type}}">
                           
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" name="customer_zip" class="form-control" id="zip" placeholder="" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                </div>
                
                <hr class="mb-4">
               <div class="row g-2">
                <div class="col-12 col-md-6">
                    @if(sizeof($carts)>0)
                <button class="btn btn-primary btn-lg my-3" id="sslczPayBtn"
                        token="if you have any token validation"
                        postdata=""
                        order="If you already have the transaction generated for current order"
                        endpoint="{{ url('/pay-via-ajax') }}"> Pay With Online
                </button>
                @else
                <h5 class="text-primary my-3"
                       > Your Cart is Empty For Buy <a href="{{url('shop')}}">Go>></a>
                        </h5>
                @endif
                </div>
                <div class="col-12 col-md-6">
                
                 </div>
               </div>
            </form>

            @if(sizeof($carts)>0)
            <button class="btn btn-primary btn-md p-2 my-3" id="cod"> Cash on Delivery
            </button>
                @else
                <h5 class="text-primary my-3"
                       > Your Cart is Empty For Buy <a href="{{url('shop')}}">Go>></a>
                        </h5>
                @endif
            
           
        </div>
    </div>
</div>
@endsection

@section('script')

<!-- If you want to use the popup integration, -->
<script>
var obj = {};
$('#sslczPayBtn').click(function(){
    
    obj.cus_name = $('#customer_name').val();
    obj.cus_phone = $('#mobile').val();
    obj.cus_email = $('#email').val();
    obj.cus_addr1 = $('#address').val();
    obj.cus_addr2 = $('#address2').val();
    obj.country = $('#country').val();
    obj.state = $('#state').val();
    obj.stateid = $('#state').data('id');
    obj.subTotal = $('#subTotal').val();
    obj.coupon = $('#coupon').val();
    obj.couponCode = $('#couponCode').val();
    obj.zip = $('#zip').val();
    obj.amount = $('#total_amount').val();
    console.log(obj.country);
   
});
$('#cod').click(function(){
    
    obj.cus_name = $('#customer_name').val();
    obj.cus_phone = $('#mobile').val();
    obj.cus_email = $('#email').val();
    obj.cus_addr1 = $('#address').val();
    obj.cus_addr2 = $('#address2').val();
    obj.country = $('#country').val();
    obj.state = $('#state').val();
    obj.stateid = $('#state').data('id');
    obj.subTotal = $('#subTotal').val();
    obj.coupon = $('#coupon').val();
    obj.couponCode = $('#couponCode').val();
    obj.zip = $('#zip').val();
    obj.amount = $('#total_amount').val();
    console.log(obj);

    axios.post('/cashondelivery',obj).then(function(response){
        if (response.data==1) {
            window.location = "/";
            toastr.success('Successfully Order Submitted!!');
    
        } else {
            toastr.error('Order Failed!!');
        }
    }).catch(function(error){
        toastr.error('Something went wrong!!');
    })

});
// }).prop('postdata', obj);
   

   $('#sslczPayBtn').prop('postdata', obj); 

    

    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
@endsection
