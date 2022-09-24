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


    <!-- Checkout Start -->
    <div class="container-fluid pt-5" style="background-color:#edeaec">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                
                @php
                    $userName = Auth::user()->name;
                    $userEmail = Auth::user()->email;
                    $userPhone = Auth::user()->phone;
                @endphp

                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Billing address</h4>
                    <form method="POST" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="firstName">Full name</label>
                                <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder=""
                                    value="{{$userName}}" required>
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
                                    value="{{ $userPhone}}" required>
                                <div class="invalid-feedback" style="width: 100%;">
                                    Your Mobile number is required.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email <span class="text-muted"></span></label>
                            <input type="email" name="customer_email" class="form-control" id="email"
                                placeholder="you@example.com" value="{{ $userEmail}}" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                        </div>

                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="country">Country</label>
                                <select class="custom-select d-block w-100" id="country" required>
                                    <option value="">Choose...</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 shipping">
                                <label for="state">City</label>
                                <select class="custom-select d-block w-100" name="state" id="state" required>
                                    <option value="">Choose...</option>
                                    @foreach($shipping as $address)
                                    <option id="shippingValue" class="shippingValue" value="{{$address->type}}" data-price="{{$address->price}}">{{$address->type}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid city.
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" id="zip" placeholder="" required>
                                <div class="invalid-feedback">
                                    Zip code required.
                                </div>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="same-address">
                            <input type="hidden" value="1200" name="amount" id="total_amount" required/>
                            <label class="custom-control-label" for="same-address">Shipping address is the same as my billing
                                address</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="save-info">
                            <label class="custom-control-label" for="save-info">Save this information for next time</label>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                                token="if you have any token validation"
                                postdata="your javascript arrays or objects which requires in backend"
                                order="If you already have the transaction generated for current order"
                                endpoint="{{ url('/pay-via-ajax') }}"> Pay Now
                        </button>
                    </form>
                </div>
                
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                            @php
                            $subtotal = 0;
                            @endphp
                        @foreach($carts as $cart)
                        <div class="d-flex justify-content-between">
                            <p>{{$cart->product_name}}</p><span>(Qtn:{{$cart->qtn}} X Unit_price:{{$cart->product_price}})</span>
                            <p>$<span>{{$cart->qtn*$cart->product_price}}</span></p>
                        </div>

                        @php
                        $subtotal +=$cart->qtn*$cart->product_price;
                        @endphp
                        @endforeach
                        
                        
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">$<span id="getCheckoutsubtotal">{{$subtotal}}</span></h6>
                        </div>
                        
                         <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping Cost</h6>
                            <h6 class="font-weight-medium">$<span id="CheckoutShipping">0</span></h6>
                        </div>

                         <div class="mb-3 shipping">
                              
                            </div>


                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">$<span id="CheckouttotalPrice">{{$subtotal}}</span></h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                        <h4 id="paymentOptionValue" class="font-weight-semi-bold m-0 d-none"></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input paymentOption" name="payment" value="paypal" data-payment="paypal" id="paypal">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input paymentOption" name="payment" value="cod" id="directcheck" data-payment="cod">
                                <label class="custom-control-label" for="directcheck">Cach on Delivery</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input paymentOption" name="payment" value="card" id="banktransfer" data-payment="card">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button id="procedCheckout" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
@endsection

@section('script')
<script type="text/javascript">

$('.paymentOption').click(function(){
        var payment= $(this).data('payment');
        // console.log(payment);
        $("#paymentOptionValue").html(payment);
    })

$('#procedCheckout').click(function(){
    var subTotal = parseFloat($('#getCheckoutsubtotal').html());
    var total = parseFloat($('#CheckouttotalPrice').html());
    var shipping_id = $('#ShippingArea').val();
    var payment=$("#paymentOptionValue").html();

    var name=$("#name").val();
    var email=$("#email").val();
    var phone=$("#phone").val();
    var country=$("#country").val();
    var address1=$("#address1").val();
    var address2=$("#address2").val();
    var state=$("#state").val();
    var zipcode=$("#zipcode").val();

    console.log(country);

    if (address1.length<=0) {
        toastr.warning('Please input tour address 1!')
    }
    else if (address2.length<=0) {
        toastr.warning('Please input tour address 2!')
    }
    else if (country=='Select Country') {
        toastr.warning('Please input country!')
    }
    else if (shipping_id == 'Select Your Address') {
        toastr.warning('Please select shipping City!')
    }
    else if (state.length<=0) {
        toastr.warning('Please input state!')
    }
    else if (zipcode.length<=0) {
        toastr.warning('Please input zipcode!')
    }
    else if (!payment) {
        toastr.warning('Please input payment!')
    }
    else{
        toastr.success('all is okey!')
    }


    // console.log(subTotal,total,shipping_id,payment);

})


  $(document).ready(function(){
        $('.shipping select[name=state]').change(function(){
            var shippingAmount = parseFloat($(this).find('option:selected').data('price'));
            var subP = parseFloat($('#getCheckoutsubtotal').html());
                $('#CheckoutShipping').html(shippingAmount);
            // console.log(shippingAmount);
            var total = subP + shippingAmount ;
            $('#CheckouttotalPrice').text(total);
            
        })
    })

            $('#sslczPayBtn').click(function(){
                var name = $('#customer_name').val();
                var email =$('#email').val();
                var phone = $('#mobile').val();
                var addr1=$('#address').val();
                var amount =$('#CheckouttotalPrice').html();
                
                
                if(name.length<=0){
                    toastr.warning('Name field is empty');
                }else if(email.length<=0){
                    toastr.warning('Email field is empty');
                }else if(phone.length<=0){
                    toastr.warning('phone field is empty');
                }else if(addr1.length<=0){
                    toastr.warning('Address field is empty');
                }else if(amount.length<=0){
                    toastr.warning('Amount field is empty');
                }
                else{
                    var obj = {};
                    obj.cus_name = name;
                    obj.cus_phone =phone;
                    obj.cus_email = email;
                    obj.cus_addr1 = addr1;
                    obj.amount = amount;
                $(this).prop('postdata', obj);
                (function (window, document) {
                        var loader = function () {
                            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                            tag.parentNode.insertBefore(script, tag);
                        };

                        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
                    })(window, document);
                }
           })

</script>
@endsection
