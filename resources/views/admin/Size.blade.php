@extends('admin.layouts.app')
@section('title','Sizes')
@section('content')
<div id="SizeMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

      <div class="row">
        <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Size Lists</h6></div>
        <div class="col-md-6"> <button id="addNewSize" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fas fa-plus"></i> Add New</button></div>
      </div>

      <table id="SizeDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
        	  <th class="th-sm">ID</th>
            <th class="th-sm">Name</th>
            <th class="th-sm">Status</th>
        	  <th class="th-sm">Edit</th>
        	  <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="SizeTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderSizeDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongSizeDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete course -->
<div class="modal fade" id="deleteSizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
         <h5 class="modal-title" id="deleteModalSizeId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this category!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="SizeDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

<!-- modal for updae status -->
<div class="modal fade" id="CatStatusUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
         <h5 class="modal-title" id="CatStatusSizeId"> </h5>
       	<h5 class="modal-title">Are you sure to Update Status!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="SizeStatusConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for update size -->
<div class="modal fade" id="UpdateSizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <h5 id="UpdateSizeId" class="d-none"> </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateSizeLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongSizeUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateSizeModalDNone">

       <div class="container updateSize">
         	<input id="UpdateSizeNameId" type="text" id="" class="form-control mb-3" placeholder="Size Name">
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="SizeUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>



<!-- new modal for adding size -->
<div class="modal fade" id="addSizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Sizes</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
        <div class="form-group">
          <form name="add_name" id="add_name">

            <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
            </div>

            <div class="alert alert-success print-success-msg" style="display:none">
            <ul></ul>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dynamic_field">
                    <tr>
                        <td><input type="text" name="name[]" placeholder="Enter Size Value" class="form-control name_list" /></td>
                        <td><button type="button" name="add" id="add" class="btn btn-sm btn-success">Add More</button></td>
                    </tr>
                </table>
            </div>

         </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="submit" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>




@endsection
@section('script')
<script type="text/javascript">
getAllSize();

function getAllSize(){
  axios.get('/allsize').then(function(response){

     if (response.status == 200) {
         $('#SizeMainDiv').removeClass('d-none');
         $('#loaderSizeDiv').addClass('d-none');

         $('#SizeDataTable').DataTable().destroy();
         $('#SizeTableBody').empty();

           var jsonData = response.data;
            $.each(jsonData, function(i, item){

                if (jsonData[i].status==1) {
                var status= 'Active';
                var finalStatus = "<a class='catStatusBtns btn btn-sm btn-success' data-id=" + jsonData[i].id + ">"+ status +"</a>"
                }else{
                  var status= 'Inactive';
                   var finalStatus = "<a class='catStatusBtns btn btn-sm btn-danger' data-id=" + jsonData[i].id + ">"+ status +"</a> "
                }
             $('<tr>').html(
                 "<td>"+jsonData[i].id+"</td>"+
                 "<td>"+jsonData[i].size+"</td>"+

                   "<td>"+ finalStatus +"</td>" +
                 "<td><a  class='subcategoryEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                 "<td><a class='subcategoryDeleteBtn' data-id='" + jsonData[i].id + "'><i class='fas fa-trash-alt'></i></a></td>"
              ).appendTo('#SizeTableBody');
            });
              // show edit modal
            $('.subcategoryEditBtn').click(function(){
                $('#UpdateSizeModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateSizeId').html(id);
                updateSizeDetails(id);
            });

              // show delete modal
            $('.subcategoryDeleteBtn').click(function(){
                $('#deleteSizeModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalSizeId').html(id);
            });

            // change status click
            $('.catStatusBtns').click(function(){
                var id = $(this).data('id');
                cnangeSizeStatus(id);
            });


       $('#SizeDataTable').DataTable({"order":false});
       $('.dataTables_length').addClass('bs-select');

     }else{
       $('#loaderSizeDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderSizeDiv').addClass('d-none');
    $('#WrongSizeDiv').removeClass('d-none');
  });
}

// detais show in update exampleModalLabel
function updateSizeDetails(id){
  axios.post('/sizeDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateSizeModalDNone').removeClass('d-none');
            $('#UpdateSizeLoader').addClass('d-none');
            var jsonData = response.data;

            var nameParse = jsonData[0].size;
            $('#UpdateSizeNameId').val(nameParse);

        } else{
          $('#UpdateSizeLoader').addClass('d-none');
          $('#WrongSizeUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateSizeLoader').addClass('d-none');
    $('#WrongSizeUpdate').removeClass('d-none');
  })
}

// update Size

$('#SizeUpdateConfirmBtn').click(function(){
  var id = $('#UpdateSizeId').html();
  var name =  $('#UpdateSizeNameId').val();
  var namev = $('.updateSize .bootstrap-tagsinput input').val();

  var newName = JSON.stringify(namev);
  console.log(newName);
   $('#SizeUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateSize',{
    id:id,
    name:name,
  }).then(function(response){
          $('#SizeUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#UpdateSizeModal').modal('hide');
                toastr.success('Update Sizes Success');
              getAllSize();
            } else {
                $('#UpdateSizeModal').modal('hide');
                toastr.error('Update Sizes Fail');
              getAllSize();
            }
          }
          else{
            $('#UpdateSizeModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#UpdateSizeModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})

// status update
function cnangeSizeStatus(id){
  axios.post('/sizeStatus',{
    id:id
  }).then(function(response){
    if (response.status==200) {
      if (response.data==1) {
        toastr.success('Size Status Change!!');
        getAllSize();
      } else {
        toastr.error('Size Status Change fail!!');
        getAllSize();
      }
    } else {
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    toastr.error(error);
  })
}

$('#SizeStatusConfirmBtn').click(function(){
  var id = $('#CatStatusSizeId').html();
  $('#SizeStatusConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/sizeStatus',{
    id:id
  }).then(function(response){
    $('#SizeStatusConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#CatStatusUpdate').modal('hide');
        toastr.success('Size delete successfully!!');
        getAllSize();
      } else {
        $('#CatStatusUpdate').modal('hide');
        toastr.error('Size delete fail!!');
        getAllSize();
      }
    } else {
      $('#CatStatusUpdate').modal('hide');
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    $('#CatStatusUpdate').modal('hide');
    toastr.error(error);
  })
})

// delete size

$('#SizeDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalSizeId').html();
  $('#SizeDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/sizeDelete',{
    id:id
  }).then(function(response){
    $('#SizeDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteSizeModal').modal('hide');
        toastr.success('Size delete successfully!!');
        getAllSize();
      } else {
        $('#deleteSizeModal').modal('hide');
        toastr.error('Size delete fail!!');
        getAllSize();
      }
    } else {
      $('#deleteSizeModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteSizeModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})

// add new size
$('#addNewSize').click(function(){
  $('#addSizeModal').modal('show');
})

$('#SizeAddConfirmBtn').click(function(){
  var SizeName =$('#SizeNameId').val();
  var parseData = JSON.stringify(SizeName);
  console.log(parseData);
  addSize(parseData);
})
function addSize(SizeName){
  $('#SizeAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/size', {
    name: SizeName,
  }).then(function(response){
      $('#SizeAddConfirmBtn').html("Save");
      if(response.status==200){
              if (response.data == 1) {
                $('#addSizeModal').modal('hide');
                toastr.success('Add Success');
                getAllSize();
            } else {
                $('#addSizeModal').modal('hide');
                toastr.error('Add Fail');
                getAllSize();
            }
          }
  }).catch(function(error){
    $('#addSizeModal').modal('hide');
    toastr.error('Something Went Wromg');
  });
}




  $(document).ready(function(){
      var postURL = "<?php echo url('/size'); ?>";
      var i=1;

      $('#add').click(function(){
           i++;
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter Size Value" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-sm btn-danger btn_remove">X</button></td></tr>');
      });

      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });

      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('#submit').click(function(){
           $.ajax({
                url:postURL,
                method:"POST",
                data:$('#add_name').serialize(),
                type:'json',
                success:function(data)
                {
                    if(data.error){
                        printErrorMsg(data.error);
                        $('#addSizeModal').modal('hide');
                        toastr.error('Something Went Wromg');
                    }else{
                        i=1;
                        $('.dynamic-added').remove();
                        $('#add_name')[0].reset();
                        $('#addSizeModal').modal('hide');
                        toastr.success('Add Success');
                        getAllSize();
                    }
                }

           });

      });

      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });

</script>
@endsection
