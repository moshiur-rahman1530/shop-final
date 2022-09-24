@extends('admin.layouts.app')
@section('title','Colors')
@section('content')
<div id="ColorMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Color Lists</h6></div>
      <div class="col-md-6"> <button id="addNewColor" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fas fa-plus"></i> Add New</button></div>
    </div>

      <table id="ColorDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
        	  <th class="th-sm">ID</th>
            <th class="th-sm">Name</th>
            <th class="th-sm">Status</th>
        	  <th class="th-sm">Edit</th>
        	  <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="ColorTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderColorDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongColorDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete course -->
<div class="modal fade" id="deleteColorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
         <h5 class="modal-title" id="deleteModalColorId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this category!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="ColorDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

<!-- modal for adding color -->
<div class="modal fade" id="addColorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Colors</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
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
                            <td><input type="text" name="name[]" placeholder="Enter Color Value" class="form-control name_list" /></td>
                            <td><button type="button" name="add" id="add" class="btn btn-sm btn-success">Add More</button></td>
                        </tr>
                    </table>
                </div>

             </form>
            </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="ColorAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
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
         <h5 class="modal-title" id="CatStatusColorId"> </h5>
       	<h5 class="modal-title">Are you sure to Update Status!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="ColorStatusConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for update course -->
<div class="modal fade" id="UpdateColorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <h5 id="UpdateColorId" class="d-none"> </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateColorLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongColorUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateColorModalDNone">

       <div class="container">
         	<input id="UpdateColorNameId" type="text" id="" class="form-control mb-3" placeholder="Color Name">
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="ColorUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
getAllColor();

function getAllColor(){
  axios.get('/allcolors').then(function(response){

     if (response.status == 200) {
         $('#ColorMainDiv').removeClass('d-none');
         $('#loaderColorDiv').addClass('d-none');

         $('#ColorDataTable').DataTable().destroy();
         $('#ColorTableBody').empty();

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
                 "<td>"+jsonData[i].color+"</td>"+
                   "<td>"+ finalStatus +"</td>" +
                 "<td><a  class='subcategoryEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                 "<td><a class='subcategoryDeleteBtn' data-id='" + jsonData[i].id + "'><i class='fas fa-trash-alt'></i></a></td>"
              ).appendTo('#ColorTableBody');
            });
              // show edit modal
            $('.subcategoryEditBtn').click(function(){
                $('#UpdateColorModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateColorId').html(id);
                updateColorDetails(id);
            });

              // show delete modal
            $('.subcategoryDeleteBtn').click(function(){
                $('#deleteColorModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalColorId').html(id);
            });

            // change status click
            $('.catStatusBtns').click(function(){
                var id = $(this).data('id');
                cnangeColorStatus(id);
            });


       $('#ColorDataTable').DataTable({"order":false});
       $('.dataTables_length').addClass('bs-select');

     }else{
       $('#loaderColorDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderColorDiv').addClass('d-none');
    $('#WrongColorDiv').removeClass('d-none');
  });
}

// detais show in update exampleModalLabel
function updateColorDetails(id){
  axios.post('/colorsDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateColorModalDNone').removeClass('d-none');
            $('#UpdateColorLoader').addClass('d-none');
            var jsonData = response.data;
            $('#UpdateColorNameId').val(jsonData[0].color);
        } else{
          $('#UpdateColorLoader').addClass('d-none');
          $('#WrongColorUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateColorLoader').addClass('d-none');
    $('#WrongColorUpdate').removeClass('d-none');
  })
}

// update Color

$('#ColorUpdateConfirmBtn').click(function(){
  var id = $('#UpdateColorId').html();
  var name =  $('#UpdateColorNameId').val();
   $('#ColorUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateColor',{
    id:id,
    name:name,
  }).then(function(response){
          $('#ColorUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#UpdateColorModal').modal('hide');
                toastr.success('Update Colors Success');
              getAllColor();
            } else {
                $('#UpdateColorModal').modal('hide');
                toastr.error('Update Colors Fail');
              getAllColor();
            }
          }
          else{
            $('#UpdateColorModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#UpdateColorModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})

// status update
function cnangeColorStatus(id){
  axios.post('/colorsStatus',{
    id:id
  }).then(function(response){
    if (response.status==200) {
      if (response.data==1) {
        toastr.success('Color Status Change!!');
        getAllColor();
      } else {
        toastr.error('Color Status Change fail!!');
        getAllColor();
      }
    } else {
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    toastr.error(error);
  })
}

$('#ColorStatusConfirmBtn').click(function(){
  var id = $('#CatStatusColorId').html();
  $('#ColorStatusConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/colorsStatus',{
    id:id
  }).then(function(response){
    $('#ColorStatusConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#CatStatusUpdate').modal('hide');
        toastr.success('Color delete successfully!!');
        getAllColor();
      } else {
        $('#CatStatusUpdate').modal('hide');
        toastr.error('Color delete fail!!');
        getAllColor();
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

// delete categoryDeleteBtn

$('#ColorDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalColorId').html();
  $('#ColorDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/colorsDelete',{
    id:id
  }).then(function(response){
    $('#ColorDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteColorModal').modal('hide');
        toastr.success('Color delete successfully!!');
        getAllColor();
      } else {
        $('#deleteColorModal').modal('hide');
        toastr.error('Color delete fail!!');
        getAllColor();
      }
    } else {
      $('#deleteColorModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteColorModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})

// add new color
$('#addNewColor').click(function(){
  $('#addColorModal').modal('show');
})


$(document).ready(function(){
    var postURL = "<?php echo url('/colors'); ?>";
    var i=1;

    $('#add').click(function(){
         i++;
         $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter Color Value" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-sm btn-danger btn_remove">X</button></td></tr>');
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

    $('#ColorAddConfirmBtn').click(function(){
         $.ajax({
              url:postURL,
              method:"POST",
              data:$('#add_name').serialize(),
              type:'json',
              success:function(data)
              {
                  if(data.error){
                      printErrorMsg(data.error);
                    $('#addColorModal').modal('hide');
                      toastr.error('Something Went Wromg');
                  }else{
                      i=1;
                      $('.dynamic-added').remove();
                      $('#add_name')[0].reset();
                        $('#addColorModal').modal('hide');
                      toastr.success('Add Success');
                      getAllColor();
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
