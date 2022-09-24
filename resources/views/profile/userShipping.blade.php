@extends('profile.layouts.index')
@section('socialIcon')
    <div class="ssicon">
    {!! $socialShare !!}   
    </div>
@endsection
@section('content')

<section class="shoping-cart spad mb-4">

        <div class="container m-4" style="width:40%">
          <div class="section-container p-2">
          <div class="area">
            <h4 class="font-weight-bold">Update Shipping Area</h4>
            <hr>
            @php 
            $user = Auth::user();
            @endphp
            <div class="shipping divst-none">
                <select id="ShippingArea" class="mb-3 w-100" style="height:36px; border:none;" name="shipping">
                    <option vlaue="0">Select Your Address</option>
                    @foreach($shipping as $address)
                    <option id="shippingValue" class="shippingValue" value="{{$address->id}}" data-id="{{$address->id}}" data-price="{{$address->price}}" data-address="{{$address->type}}" @if($address->id == $user->shippingArea) selected @endif >{{$address->type}}</option>
                    @endforeach
                </select>
           </div>
           </div>
            <div class="submit-btn">
                <button type="submit" class="btn btn-info" id="updateshippingarea">Update</button>
            </div>
          </div>
        </div>


</section>

<input type="hidden" name="shiparea" id="shiparea">
<input type="hidden" name="shiparea" id="shipprice">
<input type="hidden" name="shiparea" id="shipadd">
@endsection

@section('script')

<script>

$(document).ready(function(){
               
               $('.shipping select[name=shipping]').change(function(){
                  

                       var shippingAddress = $(this).find('option:selected').data('address');
                       var shippingAmount = parseFloat($(this).find('option:selected').data('price'));
                       var dataId =$(this).find('option:selected').data('id');

                       var data = $('#shiparea').val(dataId);
                       var data = $('#shipadd').val(shippingAddress);
                       var data = $('#shipprice').val(shippingAmount);

               })
               

               $('#updateshippingarea').click(function(){
                var dataId = $('#shiparea').val();
                var shippingAddress = $('#shipadd').val();
                var shippingAmount = $('#shipprice').val();
                console.log(dataId);
                   axios.post('/updateshippingAddress',{
                       shippingAddress:shippingAddress,
                       shippingAmount:shippingAmount,
                       dataId:dataId,
                           }).then(function(response){
                            
                               if(response.data==1){
                                toastr.success('Shipping Area Update Successfull!!');
                               }else{
                                toastr.warning('Shipping Area Update Fail!!');
                               }
                               
                           }).catch(function(error){
                               
                           })

               })
           })


</script>


@endsection
