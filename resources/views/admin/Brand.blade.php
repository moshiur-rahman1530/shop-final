@extends('admin.layouts.app')
@section('title','Brands')
@section('content')
<div id="BrandMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Brand Lists</h6></div>
      <div class="col-md-6"> <button id="addNewBrand" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fas fa-plus"></i> Add New</button></div>
    </div>


      <table id="BrandDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
        	  <th class="th-sm">ID</th>
            <th class="th-sm">Name</th>
        	  <th class="th-sm">Desc</th>
        	  <th class="th-sm">Image</th>
            <th class="th-sm">Status</th>
        	  <th class="th-sm">Edit</th>
        	  <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="BrandTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderBrandDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongBrandDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>




<!-- modal for delete course -->
<div class="modal fade" id="deleteBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
         <h5 class="modal-title" id="deleteModalBrandId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this category!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="BrandDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for adding Barnd -->
<div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Barnd</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="brandAddId" enctype="multipart/form-data">
     
      <div class="modal-body  text-center">
       <div class="container">
       
            <input id="BrandNameId" type="text" name="name" class="form-control mb-3" placeholder="Brand Name">

            <textarea name="description" id="BrandDesId" cols="30" class="form-control mb-3" rows="4" placeholder="Brand Description"></textarea>
             <select id="BrandStatus" class="w-100 mb-3" style="height:36px" name="status">
              <option value="">Select Status</option>
              <option value="1" >Active</option>
              <option value="0" >Inctive</option>
            </select>

            <input class="form-control mb-3" type="file" name="img" id="brandImg">
            <img id="brandImgPreview" src="https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png" alt="your image" class="img-fluid m-3" />

       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="BrandAddConfirmBtn" type="submit" class="btn  btn-sm  btn-danger">Save</button>
      </div>
</form>
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
         <h5 class="modal-title" id="CatStatusBrandId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this category!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="BrandStatusConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for update brands -->
<div class="modal fade" id="UpdateBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Brand</h5>
        <h5 id="UpdateBrandId" class="d-none"> </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateBrandLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongBrandUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateBrandModalDNone">

       <div class="container">
         	<input id="UpdateBrandNameId" type="text" id="" class="form-control mb-3" placeholder="Brand Name">

           <textarea id="UpdateBrandDesId" cols="30" class="form-control mb-3" rows="4" placeholder="Banner Description"></textarea>

            <input class="form-control mb-3" type="file" name="img" id="brandUpdateImg">
            <img id="brandUpdateImgPreview" src="" alt="your image" class="img-fluid m-3" />


       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="BrandUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script type="text/javascript">


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


getAllBrand();

function getAllBrand(){
  axios.get('/allbrands').then(function(response){

     if (response.status == 200) {
         $('#BrandMainDiv').removeClass('d-none');
         $('#loaderBrandDiv').addClass('d-none');

         $('#BrandDataTable').DataTable().destroy();
         $('#BrandTableBody').empty();

           var jsonData = response.data;
            $.each(jsonData, function(i, item){

              var desc = jsonData[i].description;
              if(desc.length > 60) desc = desc.substring(0,60)+'...';

                if (jsonData[i].status==1) {
                var status= 'Active';
                var finalStatus = "<a class='catStatusBtns btn btn-sm btn-success' data-id=" + jsonData[i].id + ">"+ status +"</a>"
                }else{
                  var status= 'Inactive';
                   var finalStatus = "<a class='catStatusBtns btn btn-sm btn-danger' data-id=" + jsonData[i].id + ">"+ status +"</a> "
                }
             $('<tr>').html(
                 "<td>"+jsonData[i].id+"</td>"+
                 "<td>"+jsonData[i].name+"</td>"+
                 "<td>"+desc+"</td>"+
                  "<td><img class='table-img' src=" + jsonData[i].img + "></td>"+
                   "<td>"+ finalStatus +"</td>" +
                 "<td><a  class='subcategoryEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                 "<td><a class='subcategoryDeleteBtn' data-id='" + jsonData[i].id + "'><i class='fas fa-trash-alt'></i></a></td>"
              ).appendTo('#BrandTableBody');
            });
              // show edit modal
            $('.subcategoryEditBtn').click(function(){
                $('#UpdateBrandModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateBrandId').html(id);
                updateBrandDetails(id);
            });

              // show delete modal
            $('.subcategoryDeleteBtn').click(function(){
                $('#deleteBrandModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalBrandId').html(id);
            });

            // change status click
            $('.catStatusBtns').click(function(){
                var id = $(this).data('id');
                cnangeBrandStatus(id);
            });


       $('#BrandDataTable').DataTable({"order":false});
       $('.dataTables_length').addClass('bs-select');

     }else{
       $('#loaderBrandDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderBrandDiv').addClass('d-none');
    $('#WrongBrandDiv').removeClass('d-none');
  });
}

// detais show in update exampleModalLabel
function updateBrandDetails(id){
  axios.post('/brandsDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateBrandModalDNone').removeClass('d-none');
            $('#UpdateBrandLoader').addClass('d-none');
            var jsonData = response.data;
            console.log(jsonData[0].img);
            $('#UpdateBrandNameId').val(jsonData[0].name);
            $('#UpdateBrandDesId').val(jsonData[0].description);
            $('#brandUpdateImgPreview').attr('src',jsonData[0].img);
        } else{
          $('#UpdateBrandLoader').addClass('d-none');
          $('#WrongBrandUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateBrandLoader').addClass('d-none');
    $('#WrongBrandUpdate').removeClass('d-none');
  })
}

// update Brand

$('#BrandUpdateConfirmBtn').click(function(){
  var id = $('#UpdateBrandId').html();
  var name =  $('#UpdateBrandNameId').val();
  var description =  $('#UpdateBrandDesId').val();
  var img = $('#brandUpdateImg')[0].files[0];
  var form_data = new FormData(); 
  form_data.append("img", img) ;
  form_data.append("name", name);
  form_data.append("description", description);
  form_data.append("id", id);
  

  
   $('#BrandUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateBrand', form_data
  ).then(function(response){
          $('#BrandUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#UpdateBrandModal').modal('hide');
                toastr.success('Update Barnd Success');
              getAllBrand();
            } else {
                $('#UpdateBrandModal').modal('hide');
                toastr.error('Update Barnd Fail');
              getAllBrand();
            }
          }
          else{
            $('#UpdateBrandModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#UpdateBrandModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})

// status update
function cnangeBrandStatus(id){
  axios.post('/brandsStatus',{
    id:id
  }).then(function(response){
    if (response.status==200) {
      if (response.data==1) {
        toastr.success('Brand Status Change!!');
        getAllBrand();
      } else {
        toastr.error('Brand Status Change fail!!');
        getAllBrand();
      }
    } else {
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    toastr.error(error);
  })
}

$('#BrandStatusConfirmBtn').click(function(){
  var id = $('#CatStatusBrandId').html();
  $('#BrandStatusConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/brandsStatus',{
    id:id
  }).then(function(response){
    $('#BrandStatusConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#CatStatusUpdate').modal('hide');
        toastr.success('Brand delete successfully!!');
        getAllBrand();
      } else {
        $('#CatStatusUpdate').modal('hide');
        toastr.error('Brand delete fail!!');
        getAllBrand();
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

$('#BrandDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalBrandId').html();
  $('#BrandDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/brandsDelete',{
    id:id
  }).then(function(response){
    $('#BrandDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteBrandModal').modal('hide');
        toastr.success('Brand delete successfully!!');
        getAllBrand();
      } else {
        $('#deleteBrandModal').modal('hide');
        toastr.error('Brand delete fail!!');
        getAllBrand();
      }
    } else {
      $('#deleteBrandModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteBrandModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})


// image preview

brandImg.onchange = evt => {
  const [file] = brandImg.files
  if (file) {
    brandImgPreview.src = URL.createObjectURL(file)
  }
}
brandUpdateImg.onchange = evt => {
  const [file] = brandUpdateImg.files
  if (file) {
    brandUpdateImgPreview.src = URL.createObjectURL(file)
  }
}


// add new Brand
$('#addNewBrand').click(function(){
  $('#addBrandModal').modal('show');
})


$('#BrandAddConfirmBtn').click(function(){
  var BrandName =$('#BrandNameId').val();
  var BrandDes =$('#BrandDesId').val();
  var BrandImg =$('#brandImg').val();
  var status =$('#BrandStatus').val();

  var file_data = $("#brandImg")[0].files[0]; 
  var form_data = new FormData(); 
  form_data.append("img", file_data) ;
  form_data.append("name", BrandName);
  form_data.append("description", BrandDes);
  form_data.append("status", status);

})

// add new brand ajax request
$("#brandAddId").submit(function(e) {
        e.preventDefault();
        $('#BrandAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        const fd = new FormData(this);

        $('#BrandAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/brands',fd).then(function(response){
      $('#BrandAddConfirmBtn').html("Save");
      if(response.status==200){
              if (response.data == 1) {
                $('#brandAddId')[0].reset();
                $('#brandImgPreview').attr('src','https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png');
                $('#addBrandModal').modal('hide');
                toastr.success('Add Success');
                getAllBrand();
            } else {
                $('#addBrandModal').modal('hide');
                toastr.error('Add Fail');
                getAllBrand();
            }
          }
  }).catch(function(error){
    $('#addBrandModal').modal('hide');
    toastr.error('Something Went Wromg');
  });


      });



</script>
@endsection
