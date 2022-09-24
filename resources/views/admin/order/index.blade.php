@extends('admin.layouts.app')
@section('title','Orders')
@section('content')
<div id="OrderMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Orders List</h6></div>
      <div class="col-md-6"> <button id="addNewOrder" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fas fa-plus"></i> Add New</button></div>
    </div>

     
      <table id="OrderDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
        	  <th class="th-sm">Order ID</th>
            <th class="th-sm">Cus Name</th>
        	  <th class="th-sm">Email</th>
            <th class="th-sm">Phone</th>
            <th class="th-sm">Amount</th>
        	  <th class="th-sm">Payment Option</th>
        	  <th class="th-sm">Address</th>
        	  <th class="th-sm">Status</th>
        	  <th class="th-sm">Update Status</th>
        	  <th class="th-sm">Action</th>
          </tr>
        </thead>
        <tbody id="OrderTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderOrderDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongOrderDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>


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


      <div id="UpdateOrderLoader" class="container">
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


      <div class="modal-body d-none text-center" id="updateOrderModalDNone">

       <div class="container">
         <h1 id="updateOrderStatusdata"></h1>
           <select id="updateOrderStatus" class="w-100 mb-3" style="height:36px" name="cat_id">
              <option value="">Select Status</option>
              <option value="Processing" >Processing</option>
              <option value="Pending" >Pending</option>
              <option value="Delivered" >Delivered</option>
              <option value="Complate" >Complate</option>
              <option value="Fail" >Fail</option>
              <!-- <option value="Cancel" >Cancel</option> -->
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


getAllOrders();

function getAllOrders(){
  axios.get('/allOrdersData').then(function(response){
    console.log(response.data);

     if (response.status == 200) {
         $('#OrderMainDiv').removeClass('d-none');
         $('#loaderOrderDiv').addClass('d-none');

         $('#OrderDataTable').DataTable().destroy();
         $('#OrderTableBody').empty();

           var jsonData = response.data;
            $.each(jsonData, function(i, item){
             $('<tr>').html(
                 "<td>"+jsonData[i].id+"</td>"+
                 "<td>"+jsonData[i].name+"</td>"+
                 "<td>"+jsonData[i].email+"</td>"+
                 "<td>"+jsonData[i].phone+"</td>"+
                 "<td>"+jsonData[i].amount+"</td>"+
                 "<td>"+jsonData[i].payment_type+"</td>"+
                 "<td>"+jsonData[i].address+"</td>"+
                 "<td>"+jsonData[i].status+"</td>"+
                 "<td><a  class='OrderEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                 "<td><a class='OrderDeleteBtn' data-id='" + jsonData[i].id + "'><i class='fas fa-trash-alt'></i></a><a class='OrderViewBtn mx-3' data-id='" + jsonData[i].id + "'><i class='fas fa-eye'></i></a></td>"
              ).appendTo('#OrderTableBody');
            });
             // show edit modal
             $('.OrderEditBtn').click(function(){
                $('#UpdateOrderModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateOrderId').html(id);
                updateOrderDetails(id);
            });

            $('.OrderDeleteBtn').click(function(){
                $('#deleteOrderModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalOrderId').html(id);
            });

            $('.OrderStatusBtns').click(function(){
                $('#OrderStatusUpdate').modal('show');
                var id = $(this).data('id');
                $('#OrderStatusOrderId').html(id);
            });

            $('.OrderViewBtn').click(function(){
                
                var id = $(this).data('id');
                window.location = "/adminOrderDetails/"+id+"";
            });

       $('#OrderDataTable').DataTable({"order":false});
       $('.dataTables_length').addClass('bs-select');

     }else{
       $('#loaderOrderDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderOrderDiv').addClass('d-none');
    $('#WrongOrderDiv').removeClass('d-none');
  });
}


// show edit data in update Order form

function updateOrderDetails(id){
  axios.post('/OrdersDetails',{
    id:id
  }).then(function(response){
    console.log(response.data);
        if(response.status==200 && response.data){
            $('#updateOrderModalDNone').removeClass('d-none');
            $('#UpdateOrderLoader').addClass('d-none');
            var jsonData = response.data;
          
            $('#updateOrderStatus').val(jsonData[0].status);
        } else{
          $('#UpdateOrderLoader').addClass('d-none');
          $('#WrongOrderUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateOrderLoader').addClass('d-none');
    $('#WrongOrderUpdate').removeClass('d-none');
  })
}


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
              getAllOrders();
            } else {
                $('#UpdateOrderModal').modal('hide');
                toastr.error('Update Barnd Fail');
              getAllOrders();
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
