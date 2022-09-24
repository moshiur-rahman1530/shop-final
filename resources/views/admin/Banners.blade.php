<?php
  use App\Models\Product;
?>
@extends('admin.layouts.app')
@section('title','Banner')
@section('content')
<div id="BannerMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Banners Lists</h6></div>
      <div class="col-md-6"> <button id="addNewBanner" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fas fa-plus"></i> Add New</button></div>
    </div>

     
      <table id="BannerDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
        	  <th class="th-sm">ID</th>
            <th class="th-sm">Title</th>
        	  <th class="th-sm">Desc</th>
            <th class="th-sm">Image</th>
            <th class="th-sm">Status</th>
        	  <th class="th-sm">Edit</th>
        	  <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="BannerTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderBannerDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongBannerDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete banner -->
<div class="modal fade" id="deleteBannerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
         <h5 class="modal-title" id="deleteModalBannerId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this Banner!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="BannerDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for update Banners -->
<div class="modal fade" id="UpdateBannerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Banner</h5>
        <h5 id="UpdateBannerId" class="d-none"> </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateBannerLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongBannerUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateBannerModalDNone">

       <div class="container">
         	<input id="UpdateBannerNameId" type="text" id="" class="form-control mb-3" placeholder="Banner Name">
      	 	
           <textarea name="UpdateBannerDesId" id="UpdateBannerDesId" cols="30" class="form-control mb-3" rows="4" placeholder="Banner Description"></textarea>
            <input class="form-control mb-3" type="file" name="img" id="UpdateBannerImgId">
            <img id="UpdateBannerImgIdPreview" src="" alt="your image" class="img-fluid m-3" />
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="BannerUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for adding Banner -->
<div class="modal fade" id="addBannerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Banner</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
            <input id="BannerNameId" type="text" id="" class="form-control mb-3" placeholder="Banner Name">
            <textarea name="BannerDesId" id="BannerDesId" cols="30" class="form-control mb-3" rows="4" placeholder="Banner Description"></textarea>
                <select name="status" id="bannerStatus" class="bannerStatus form-control">
                    <option>Status Select</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>


                <input class="form-control mb-3" type="file" name="img" id="BannerImage">
            <img id="BannerImagePreview" src="https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png" alt="your image" class="img-fluid m-3" />


       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="BannerAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- modal for updae status -->
<div class="modal fade" id="BannerStatusUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
         <h5 class="modal-title" id="BannerStatusBannerId"> </h5>
       	<h5 class="modal-title">Are you sure to change banner status!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="BannerStatusConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
getAllBanner();

function getAllBanner(){
  axios.get('/allbanners').then(function(response){

     if (response.status == 200) {
         $('#BannerMainDiv').removeClass('d-none');
         $('#loaderBannerDiv').addClass('d-none');

         $('#BannerDataTable').DataTable().destroy();
         $('#BannerTableBody').empty();

           var jsonData = response.data;
            $.each(jsonData, function(i, item){

              var desc = jsonData[i].description;
              if(desc.length > 60) desc = desc.substring(0,60)+'...';


                if (jsonData[i].status==1) {
                var status= 'Active';
                var finalStatus = "<a class='bannerStatusBtns btn btn-sm btn-success' data-id=" + jsonData[i].id + ">"+ status +"</a>"
                }else{
                  var status= 'Inactive';
                   var finalStatus = "<a class='bannerStatusBtns btn btn-sm btn-danger' data-id=" + jsonData[i].id + ">"+ status +"</a> "
                }
             $('<tr>').html(
                 "<td>"+jsonData[i].id+"</td>"+
                 "<td>"+jsonData[i].title+"</td>"+
                 "<td>"+desc+"</td>"+
                  "<td><img class='table-img' src=" + jsonData[i].photo + "></td>"+
                   "<td>"+ finalStatus +"</td>" +
                 "<td><a  class='BannerEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                 "<td><a class='BannerDeleteBtn' data-id='" + jsonData[i].id + "'><i class='fas fa-trash-alt'></i></a></td>"
              ).appendTo('#BannerTableBody');
            });
             // show edit modal
             $('.BannerEditBtn').click(function(){
                $('#UpdateBannerModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateBannerId').html(id);
                updateBannerDetails(id);
            });

            $('.BannerDeleteBtn').click(function(){
                $('#deleteBannerModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalBannerId').html(id);
            });

            $('.bannerStatusBtns').click(function(){
                $('#BannerStatusUpdate').modal('show');
                var id = $(this).data('id');
                $('#BannerStatusBannerId').html(id);
            });


       $('#BannerDataTable').DataTable({"order":false});
       $('.dataTables_length').addClass('bs-select');

     }else{
       $('#loaderBannerDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderBannerDiv').addClass('d-none');
    $('#WrongBannerDiv').removeClass('d-none');
  });
}

// show edit data in update banner form

function updateBannerDetails(id){
  axios.post('/bannersDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateBannerModalDNone').removeClass('d-none');
            $('#UpdateBannerLoader').addClass('d-none');
            var jsonData = response.data;
            $('#UpdateBannerNameId').val(jsonData[0].title);
            $('#UpdateBannerDesId').val(jsonData[0].description);
            $('#UpdateBannerImgIdPreview').attr('src',jsonData[0].photo);
        } else{
          $('#UpdateBannerLoader').addClass('d-none');
          $('#WrongBannerUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateBannerLoader').addClass('d-none');
    $('#WrongBannerUpdate').removeClass('d-none');
  })
}


// update Banner

$('#BannerUpdateConfirmBtn').click(function(){
  var id = $('#UpdateBannerId').html();
  var name =  $('#UpdateBannerNameId').val();
  var description =  $('#UpdateBannerDesId').val();
  var img = $('#UpdateBannerImgId')[0].files[0];
  var form_data = new FormData(); 
  form_data.append("img", img) ;
  form_data.append("name", name);
  form_data.append("description", description);
  form_data.append("id", id);
   $('#BannerUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateBanner',form_data
  
  ).then(function(response){
          $('#BannerUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#UpdateBannerModal').modal('hide');
                toastr.success('Update Barnd Success');
              getAllBanner();
            } else {
                $('#UpdateBannerModal').modal('hide');
                toastr.error('Update Barnd Fail');
              getAllBanner();
            }
          }
          else{
            $('#UpdateBannerModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#UpdateBannerModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})

// status update
$('#BannerStatusConfirmBtn').click(function(){
  var id = $('#BannerStatusBannerId').html();
  $('#BannerStatusConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/bannersStatus',{
    id:id
  }).then(function(response){
    $('#BannerStatusConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#BannerStatusUpdate').modal('hide');
        toastr.success('Banner delete successfully!!');
        getAllBanner();
      } else {
        $('#BannerStatusUpdate').modal('hide');
        toastr.error('Banner delete fail!!');
        getAllBanner();
      }
    } else {
      $('#BannerStatusUpdate').modal('hide');
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    $('#BannerStatusUpdate').modal('hide');
    toastr.error(error);
  })
})

// delete BannerDeleteBtn

$('#BannerDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalBannerId').html();
  $('#BannerDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/bannersDelete',{
    id:id
  }).then(function(response){
    $('#BannerDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteBannerModal').modal('hide');
        toastr.success('Banner delete successfully!!');
        getAllBanner();
      } else {
        $('#deleteBannerModal').modal('hide');
        toastr.error('Banner delete fail!!');
        getAllBanner();
      }
    } else {
      $('#deleteBannerModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteBannerModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})

// add new Banner
$('#addNewBanner').click(function(){
  $('#addBannerModal').modal('show');
})

$('#BannerAddConfirmBtn').click(function(){
  var bannerName =$('#BannerNameId').val();
  var bannerDes =$('#BannerDesId').val();
  var bannerImg = $('#BannerImage')[0].files[0];
  var status =$('#bannerStatus').val();
  addBanner(bannerName, bannerDes, bannerImg,status);
})
function addBanner(bannerName, bannerDes, bannerImg,status){
  $('#BannerAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

  var form_data = new FormData(); 
  form_data.append("bannerImg", bannerImg) ;
  form_data.append("bannerName", bannerName);
  form_data.append("bannerDes", bannerDes);
  form_data.append("status", status);


  axios.post('/banners', form_data
  ).then(function(response){
      $('#BannerAddConfirmBtn').html("Save");
      if(response.status==200){
              if (response.data == 1) {
                $('#addBannerModal').modal('hide');
                $('#BannerNameId').val('');
                $('#BannerDesId').val('');
                $('#BannerImage').val('');
                $('#bannerStatus').val('');
                $('#BannerImagePreview').attr('src','https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png');
                toastr.success('Add Success');
                getAllBanner();
            } else {
                $('#addBannerModal').modal('hide');
                toastr.error('Add Fail');
                getAllBanner();
            }
          }
  }).catch(function(error){
    $('#addBannerModal').modal('hide');
    toastr.error('Something Went Wromg');
  });
}


BannerImage.onchange = evt => {
  const [file] = BannerImage.files
  if (file) {
    BannerImagePreview.src = URL.createObjectURL(file)
  }
}
UpdateBannerImgId.onchange = evt => {
  const [file] = UpdateBannerImgId.files
  if (file) {
    UpdateBannerImgIdPreview.src = URL.createObjectURL(file)
  }
}



</script>
@endsection
