@extends('profile.layouts.index')
@section('socialIcon')
    <div class="ssicon">
    {!! $socialShare !!}   
    </div>
@endsection
@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg mb-4" data-setbg="">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <div class="breadcrumb__option">
                        <a href="{{url('/')}}">Home</a> /
                        <a href="{{url('/userdashboard')}}">User Dashboard</a> /
                        <span>Order Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<section class="shoping-cart spad mb-4">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-responsive" id="userOrderTable">
                <thead>
                      <tr>

                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Size</th>
                        <th scope="col">Color</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Shipping Area</th>
                        <th scope="col">Transaction id</th>
                        <th scope="col">Payment Type</th>
                      </tr>
                    </thead>
                    <tbody>
                     @php
                    @endphp
                   
                    @foreach($products as $index =>$product)
                   
                    
                    @foreach($order->OrderItems as $details)

                    @if($product[0]->size_id==$details->size_id && $product[0]->color_id==$details->color_id && $product[0]->product_id==$details->product_id && $product[0]->product_price==$details->product_price)

                      <tr>
                      <td>{{$product[0]->product_name}}</td>
                      @php
                      $productImgDecoded = json_decode($product[0]->product_img);

                      $sizeName = App\Models\Size::SizeName($product[0]->size_id);
                      $colorName = App\Models\Color::findColor($product[0]->color_id);
                    
                      @endphp
                      <td><img class="img-fluid" src="{{$productImgDecoded[0]}}" alt="Product-photo"></td>
                      <td>{{$sizeName->size}}</td>
                      <td>{{$colorName->color}}</td>
                      <td>{{$product[0]->product_price}}</td>
                      <td>{{$product[0]->discount}}</td>
                      
                    
                     <td>{{$details->quantity}}</td>
                    

                  
                      <td>{{ $order->state }}</td>
                        <td>{{ $order->transaction_id }}</td>
                        <td>{{ $order->payment_type }}</td>
                      </tr>
                      @endif
                     @endforeach
                      @endforeach  
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan='9'>Subtotal</td>
                            <td>{{ $order->subTotal }} TK</td>
                        </tr>
                        <tr>
                            <td colspan='9'>Total</td>
                            <td>{{ $order->amount }} TK</td>
                        </tr>
                        <tr>
                            <td colspan='10' class='text-center'>
                                <a class='btn btn-info btn-sm' href="{{url('/generate-pdf/'.$order->id)}}">Download Receipt</a>
                                <a class='btn btn-info btn-sm' href="{{url('/view-pdf/'.$order->id)}}" target="_blank">View Receipt</a>
                            </td>
                               
                        </tr>
                        
                    </tfoot>
                  </table>
            </div>
          </div>
        </div>
      </div>
</div>
</section>
@endsection

@section('script')

<script>

</script>


@endsection
