<?php
  use App\Models\Product;
?>
@extends('admin.layouts.app')
@section('title','Category')
@section('content')
<div id="CategoryMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Category Lists</h6></div>
      <div class="col-md-6"> <button id="addNewCategory" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fas fa-plus"></i> Add New</button></div>
    </div>

     
      <table id="CategoryDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
        <tbody id="CategoryTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderCategoryDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongCategoryDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete category -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
         <h5 class="modal-title" id="deleteModalCategoryId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this category!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="CategoryDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for update category -->
<div class="modal fade" id="updateCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update category</h5>
        <h5 id="UpdateCategoryId"> </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateCategoryLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongCategoryUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateCategoryModalDNone">

       <div class="container">
       <input id="UpdateCategoryNameId" type="text" id="" class="form-control mb-3" placeholder="Category Name">
           <textarea name="UpdateCategoryDesId" id="UpdateCategoryDesId" cols="30" class="form-control mb-3" rows="4" placeholder="Banner Description"></textarea>
            <input class="form-control mb-3" type="file" name="img" id="CategoryUpdateImg">
            <img id="CategoryUpdateImgPreview" src="" alt="your image" class="img-fluid m-3" />
       </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="CategoryUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for adding category -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Category</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
            <input id="CategoryNameId" type="text" id="" class="form-control mb-3" placeholder="Category Name">
        

            <textarea name="CategoryDesId" id="CategoryDesId" cols="30" class="form-control mb-3" rows="4" placeholder="Banner Description"></textarea>

                <select name="status" id="catStatus" class="catStatus form-control">
                    <option>Status Select</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>

                <input class="form-control mb-3" type="file" name="img" id="CategoryImage">
            <img id="CategoryImagePreview" src="https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png" alt="your image" class="img-fluid m-3" />

       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="CategoryAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
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
         <h5 class="modal-title" id="CatStatusCategoryId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this category!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="CatStatusConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
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

getAllCategory();

function getAllCategory(){
  axios.get('/allcategory').then(function(response){

     if (response.status == 200) {
         $('#CategoryMainDiv').removeClass('d-none');
         $('#loaderCategoryDiv').addClass('d-none');

         $('#CategoryDataTable').DataTable().destroy();
         $('#CategoryTableBody').empty();

           var jsonData = response.data;
            $.each(jsonData, function(i, item){

              var desc = jsonData[i].cat_des;

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
                 "<td>"+jsonData[i].cat_name+"</td>"+
                 "<td>"+desc+"</td>"+
                  "<td><img class='table-img' src=" + jsonData[i].cat_img + "></td>"+
                   "<td>"+ finalStatus +"</td>" +
                 "<td><a  class='serviceEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                 "<td><a class='categoryDeleteBtn' data-id='" + jsonData[i].id + "'><i class='fas fa-trash-alt'></i></a></td>"
              ).appendTo('#CategoryTableBody');
            });

            $('.categoryDeleteBtn').click(function(){
                $('#deleteCategoryModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalCategoryId').html(id);
            });

            $('.catStatusBtns').click(function(){
                $('#CatStatusUpdate').modal('show');
                var id = $(this).data('id');
                $('#CatStatusCategoryId').html(id);
            });
            // edit modal open
            $('.serviceEditBtn').click(function(){
                $('#updateCategoryModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateCategoryId').html(id);
                updateCategoryDetails(id);
            });


       $('#CategoryDataTable').DataTable({"order":false});
       $('.dataTables_length').addClass('bs-select');

     }else{
       $('#loaderCategoryDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderCategoryDiv').addClass('d-none');
    $('#WrongCategoryDiv').removeClass('d-none');
  });
}

// update deatils category fetch
 function updateCategoryDetails(id){
  axios.post('/categoryDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateCategoryModalDNone').removeClass('d-none');
            $('#UpdateCategoryLoader').addClass('d-none');
            var jsonData = response.data;
            console.log(jsonData);
            $('#UpdateCategoryNameId').val(jsonData[0].cat_name);
            $('#UpdateCategoryDesId').val(jsonData[0].cat_des);
            $('#CategoryUpdateImgPreview').attr('src',jsonData[0].cat_img);
        } else{
          $('#UpdateCategoryLoader').addClass('d-none');
          $('#WrongCategoryUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateCategoryLoader').addClass('d-none');
    $('#WrongCategoryUpdate').removeClass('d-none');
  })
 }


 $('#CategoryUpdateConfirmBtn').click(function(){
  var id = $('#UpdateCategoryId').html();
  var name =  $('#UpdateCategoryNameId').val();
  var description =  $('#UpdateCategoryDesId').val();
  var img = $('#CategoryUpdateImg')[0].files[0];
  var form_data = new FormData(); 
  form_data.append("img", img) ;
  form_data.append("name", name);
  form_data.append("description", description);
  form_data.append("id", id);
  
   $('#CategoryUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateCategory', form_data).then(function(response){
          $('#CategoryUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#updateCategoryModal').modal('hide');
                toastr.success('Update Category Success');
              getAllCategory();
            } else {
                $('#updateCategoryModal').modal('hide');
                toastr.error('Update Category Fail');
              getAllCategory();
            }
          }
          else{
            $('#updateCategoryModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#updateCategoryModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})

// status update
$('#CatStatusConfirmBtn').click(function(){
  var id = $('#CatStatusCategoryId').html();
  $('#CatStatusConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/categoryStatus',{
    id:id
  }).then(function(response){
    $('#CatStatusConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#CatStatusUpdate').modal('hide');
        toastr.success('Category status update successfully!!');
        getAllCategory();
      } else {
        $('#CatStatusUpdate').modal('hide');
        toastr.error('Category status update fail!!');
        getAllCategory();
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

$('#CategoryDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalCategoryId').html();
  $('#CategoryDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/categoryDelete',{
    id:id
  }).then(function(response){
    $('#CategoryDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteCategoryModal').modal('hide');
        toastr.success('Category delete successfully!!');
        getAllCategory();
      } else {
        $('#deleteCategoryModal').modal('hide');
        toastr.error('Category delete fail!!');
        getAllCategory();
      }
    } else {
      $('#deleteCategoryModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteCategoryModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})

// add new category
$('#addNewCategory').click(function(){
  $('#addCategoryModal').modal('show');
})

$('#CategoryAddConfirmBtn').click(function(){
  var catName =$('#CategoryNameId').val();
  var catDes =$('#CategoryDesId').val();
  var catImg =$('#CategoryImage')[0].files[0];
  var status =$('#catStatus').val();
  addCategory(catName, catDes, catImg,status);
})
function addCategory(catName, catDes, catImg, status){

  var fd = new FormData();
  fd.append('catName',catName);
  fd.append('catDes',catDes);
  fd.append('catImg',catImg);
  fd.append('status',status);


  $('#CategoryAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/category', fd
  
  ).then(function(response){
      $('#CategoryAddConfirmBtn').html("Save");
      if(response.status==200){
              if (response.data == 1) {
                $('#addCategoryModal').modal('hide');
                toastr.success('Add Success');
                getAllCategory();
                $('#CategoryNameId').val('');
                $('#CategoryDesId').val('');
                $('#CategoryImage').val('');
                $('#catStatus').val('');
                $("#CategoryImagePreview").attr("src", 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png');
            } else {
                $('#addCategoryModal').modal('hide');
                toastr.error('Add Fail');
                getAllCategory();
            }
          }
  }).catch(function(error){
    $('#addCategoryModal').modal('hide');
    toastr.error('Something Went Wromg');
  });
}



CategoryImage.onchange = evt => {
  const [file] = CategoryImage.files
  if (file) {
    CategoryImagePreview.src = URL.createObjectURL(file)
  }
}
CategoryUpdateImg.onchange = evt => {
  const [file] = CategoryUpdateImg.files
  if (file) {
    CategoryUpdateImgPreview.src = URL.createObjectURL(file)
  }
}


</script>
@endsection
