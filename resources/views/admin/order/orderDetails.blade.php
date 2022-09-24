@extends('admin.layouts.app')
@section('title','Orders Details')
@section('content')


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg mb-3" data-setbg="" style="background-color:#EDF1FF;">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <div class="breadcrumb__option">
                        <a href="{{url('/admin/home')}}">Home</a> /
                        <a href="{{url('/allOrders')}}">All Orders</a> /
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
                                <a class='btn btn-info btn-sm' href="{{url('/AdminPdfInvoice/'.$order->id)}}">Download Receipt</a>
                                <a class='btn btn-info btn-sm' href="{{url('/AdminPdfInvoiceView/'.$order->id)}}" target="_blank">View Receipt</a>
                               <a  class='OrderDeleteBtn btn btn-danger btn-sm' data-id="{{$order->id}}"><i class='fas fa-edit'>Cancel Order</i></a>
                               <a class='OrderEditBtn btn btn-success btn-sm' data-id='{{$order->id}}'><i class='fas fa-trash-alt'></i>Update Order Status</a>
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


<!-- modal for delete Order -->
<div class="modal fade" id="deleteOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
         <h5 class="modal-title" id="deleteModalOrderId"> </h5>
       	<h5 class="modal-title">Are you sure to cancel this Order!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="OrderDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for update Order -->
<div class="modal fade" id="UpdateOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Order Status</h5>
        <h5 id="UpdateOrderId" class="d-none"> </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateOrderLoader" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongOrderUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body text-center" id="updateOrderModalDNone">

       <div class="container">
         <h1 id="updateOrderStatusdata"></h1>
           <select id="updateOrderStatus" class="w-100 mb-3" style="height:36px" name="cat_id">
              <option value="">Select Status</option>
              <option value="Processing" >Processing</option>
              <option value="Pending" >Pending</option>
              <option value="Delivered" >Delivered</option>
              <option value="Complate" >Complate</option>
              <option value="Fail" >Fail</option>
            </select>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="OrderUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">

            $('.OrderEditBtn').click(function(){
                $('#UpdateOrderModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateOrderId').html(id);
            });

            $('.OrderDeleteBtn').click(function(){
                $('#deleteOrderModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalOrderId').html(id);
            });

            // update Order

$('#OrderUpdateConfirmBtn').click(function(){
  var id = $('#UpdateOrderId').html();
  var status =  $('#updateOrderStatus').val();
   $('#OrderUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateOrderStatus',{
    id:id,
    status:status,
  }).then(function(response){
          $('#OrderUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#UpdateOrderModal').modal('hide');
                toastr.success('Update Barnd Success');
            } else {
                $('#UpdateOrderModal').modal('hide');
                toastr.error('Update Barnd Fail');
            }
          }
          else{
            $('#UpdateOrderModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#UpdateOrderModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})


// delete OrderDeleteBtn

$('#OrderDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalOrderId').html();
  $('#OrderDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/OrdersDelete',{
    id:id
  }).then(function(response){
    $('#OrderDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteOrderModal').modal('hide');
        toastr.success('Order delete successfully!!');
        getAllOrders();
      } else {
        $('#deleteOrderModal').modal('hide');
        toastr.error('Order delete fail!!');
        getAllOrders();
      }
    } else {
      $('#deleteOrderModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteOrderModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})



</script>
@endsection
