@extends('admin.layouts.app')
@section('title','Product')
@section('content')
<div id="ProductMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Product Lists</h6></div>
      <div class="col-md-6"> <button id="addNewProduct" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fas fa-plus"></i> Add New</button></div>
    </div>

      <div class="table-responsive" style="overflow-x:auto;">
        <table id="ProductDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
          	  <th class="th-sm" width="2%">ID</th>
              <th class="th-sm">Name</th>
          	  <th class="th-sm">Desc</th>
              <th class="th-sm">Category</th>
              <th class="th-sm">Sub Cat</th>
              <th class="th-sm">Brand</th>
              <th class="th-sm">Unit</th>
          	  <th class="th-sm">Image</th>
          	  <th class="th-sm">Status</th>
          	  <th class="th-sm">Add Attributes</th>
          	  <th class="th-sm">Edit</th>
          	  <th class="th-sm">Delete</th>
            </tr>
          </thead>
          <tbody id="ProductTableBody">

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div id="loaderProductDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongProductDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete course -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
         <h5 class="modal-title" id="deleteModalProductId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this product!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="ProductDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for add product attribute -->
<div class="modal fade" id="AttrProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<h5 class="modal-title">Add Product Attribute</h5>

         <div class="form-group">
              <form name="add_attr" id="add_attr">
              <input type="hidden" name="AttrProductModalId" id="AttrProductModalId">
                <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
                </div>

                <div class="alert alert-success print-success-msg" style="display:none">
                <ul></ul>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamic_field">
                        <tr>
                            <td width="13%">
                              <!-- color -->
                              <select id="ColorAttrSelect" class="w-100 form-control" name="color[]">
                                <option selected>Color</option>
                                @foreach($color as $col)
                                <option value="{{ $col->id }}" >{{$col->color}}</option>
                                @endforeach
                              </select>
                              <!-- colorend -->
                            </td>
                            <td width="13%">
                              <!-- size -->
                              <select id="SizeAttrSelect" class="form-control w-100" name="size[]">
                                <option selected>Size</option>
                                @foreach($sizes as $size)
                                <option value="{{ $size->id }}" >{{$size->size}}</option>
                                @endforeach
                              </select>
                              <!-- sizeend -->
                            </td>

                            <td width="13%"><input type="text" id="AttrQuantity" name="quantity[]" placeholder="Product Quantity" class="form-control name_list" /></td>

                            <td width="13%"><input type="text" id="AttrPrice" name="price[]" placeholder="Product Price" class="form-control name_list" /></td>

                            <td width="13%"><input type="text" id="AttrDiscount" name="discount[]" placeholder="Discount Price" class="form-control name_list" /></td>
                              <td width="12%">
                                <select id="AttributeStatus" class="w-100 mb-3" style="height:36px" name="attrStatus[]">
                                  <option value="">Select Status</option>
                                  <option value="1" >Active</option>
                                  <option value="0" >Inctive</option>
                                </select>
                              </td>
                            <td width="10%"><button type="button" name="add" id="add" class="btn btn-sm btn-success">Add More</button></td>
                        </tr>
                    </table>
                </div>

             </form>
            </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="AttrProductModalSave" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for adding product -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title text-center">Add New Product</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
       <div class="container">
         <div class="row">
           <div class="col-md-6 col-12">

             <input id="ProductNameId" type="text" class="form-control mb-3" placeholder="Product Name">
             <textarea id="ProductDesId" rows="5" class="form-control mb-3" placeholder="Product Description"></textarea>

             <select id="ProductCatSelect" class="w-100 mb-3" style="height:36px" name="Category">
               <option value="">Select Category</option>
               @foreach($cats as $cat)
               <option value="{{ $cat->id }}" >{{$cat->cat_name}}</option>
               @endforeach
             </select>

             <select id="ProductSubCatSelect" class="w-100 mb-3" style="height:36px" name="subcat">
               <option value="">Select Sub Category</option>
               @foreach($subcat as $catsub)
               <option value="{{ $catsub->id }}" >{{$catsub->name}}</option>
               @endforeach
             </select>

              

           </div>
           <div class="col-md-6 col-12">
             <!-- brand -->
             <select id="ProductBrandSelect" class="w-100 mb-3" style="height:36px" name="brand">
               <option value="">Select Brand</option>
               @foreach($brand as $bran)
               <option value="{{ $cat->id }}" >{{$bran->name}}</option>
               @endforeach
             </select>
             

             <!-- unit -->
             <select id="ProductUnitSelect" class="w-100 mb-3" style="height:36px" name="unit">
               <option value="">Select Unit</option>
               @foreach($unit as $ut)
               <option value="{{ $ut->id }}" >{{$ut->name}}</option>
               @endforeach
             </select>
             <!-- unitend -->

             <!-- select status -->
             <select name="status" id="status" class="status form-control">
              <option value="0">Inactive</option>
              <option value="1">Active</option>
             </select>

              <div class="my-2 text-start-important">
                <input class="form-check-input form-control" name='is_featured' type="checkbox" value="1" id="is_featured" checked>
                <label class="form-check-label" for="is_featured">
                Is Featured
                </label>
              </div>

              <!-- condition -->
              <select name="condition" id="condition" class="condition form-control mb-3">
              <option value="">--Select Condition--</option>
              <option value="default">Default</option>
              <option value="new">New</option>
              <option value="hot">Hot</option>
             </select>

            
            <input class="form-control mb-3" type="file" name="img[]" id="ProductImage" multiple="">
           </div>
           <div id="image_preview"></div>
          </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="ProductAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for update Product -->
<div class="modal fade" id="updateProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Product</h5>
        <h5 id="UpdateProductId"> </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateProductLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongProductUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateProductModalDNone">

       <div class="container">
       <div class="row">
           <div class="col-md-6 col-12">

             <input id="ProductUpdateNameId" type="text" class="form-control mb-3" placeholder="Product Name">
          
             <textarea id="ProductUpdateDesId" rows="5" class="form-control mb-3" placeholder="Product Description"></textarea>
           

             <select id="ProductUpdateCatSelect" class="w-100 mb-3" style="height:36px" name="Category">
               <option value="">Select Category</option>
               @foreach($cats as $catsid)
               
               <option value="{{ $catsid->id }}" >{{$catsid->cat_name}}</option>
               @endforeach
             </select>

             <select id="ProductUpdateSubCatSelect" class="w-100 mb-3" style="height:36px" name="subcat">
               <option value="">Select Sub Category</option>
               @foreach($subcat as $subcatid)
               <option value="{{ $subcatid->id }}" >{{$subcatid->name}}</option>
               @endforeach
             </select>

              

           </div>
           <div class="col-md-6 col-12">
             <!-- brand -->
             <select id="ProductUpdateBrandSelect" class="w-100 mb-3" style="height:36px" name="brand">
               <option value="">Select Brand</option>
               @foreach($brand as $bran)
               <option value="{{ $cat->id }}" >{{$bran->name}}</option>
               @endforeach
             </select>
             <!-- brandend -->


             <!-- unit -->
             <select id="ProductUpdateUnitSelect" class="w-100 mb-3" style="height:36px" name="unit">
               <option value="">Select Unit</option>
               @foreach($unit as $ut)
               <option value="{{ $ut->id }}" >{{$ut->name}}</option>
               @endforeach
             </select>
             <!-- unitend -->

             <!-- select status -->
             <select name="status" id="ProductUpdatestatus" class="status form-control">
              <option value="0">Inactive</option>
              <option value="1">Active</option>
             </select>


              <div class="my-2 text-start-important">
                <input class="form-check-input form-control" name='is_featured' type="checkbox" value="1" id="Updateis_featured" checked>
                <label class="form-check-label" for="is_featured">
                Is Featured
                </label>
              </div>

              <!-- condition -->
              <select name="condition" id="Updatecondition" class="condition form-control mb-2">
              <option value="">--Select Condition--</option>
              <option value="default">Default</option>
              <option value="new">New</option>
              <option value="hot">Hot</option>
             </select>
            <input class="form-control mb-3 mt-2" type="file" name="img[]" id="ProductUpdateImage" multiple="">
           </div>
           <div id="Update_image_preview"></div>
          </div>
       </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="ProductUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script type="text/javascript">

// multiple image pick using haruncpi filemanger

var imgArray=[];
window.myBulkSelectCallback = function (data) {
  // the JSON data will come here
  // console.log(data);
  data.map(d=>imgArray.push(d.absolute_url))
};
console.log(imgArray);



// delete productDeleteBtn


// add new product
$('#addNewProduct').click(function(){
  $('#addProductModal').modal('show');
})


$('#ProductAddConfirmBtn').click(function(){
  var pName = $('#ProductNameId').val();
  var pDes = $('#ProductDesId').val();
  var pCat = $('#ProductCatSelect').val();
  var pSubCat = $('#ProductSubCatSelect').val();
  var pBrand = $('#ProductBrandSelect').val();
  var pUnit = $('#ProductUnitSelect').val();
  var pImg = $('#ProductImage')[0];
  let TotalFiles = $('#ProductImage')[0].files.length;

  var feature = $('#is_featured').val();
  var condition = $('#condition').val();
  var status = $('#status').val();
  addProduct(pName,pDes,pCat,pSubCat,pBrand,pUnit,pImg,feature,condition,status,TotalFiles);
})


function addProduct(pName,pDes,pCat,pSubCat,pBrand,pUnit,pImg,feature,condition,status,TotalFiles) {
  $('#ProductAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

  var form_data = new FormData(); 
  form_data.append("name", pName);
  form_data.append("des", pDes);
  form_data.append("cat", pCat);
  form_data.append("subcat", pSubCat);
  form_data.append("brand", pBrand);
  form_data.append("unit", pUnit);

  for (let i = 0; i < TotalFiles; i++) {
    form_data.append('img' + i, pImg.files[i]);
      }
  form_data.append("feature", feature);
  form_data.append("condition", condition);
  form_data.append("status", status);
  form_data.append("TotalFiles", TotalFiles);

  axios.post('/products', form_data).then(function(response){
    $('#ProductAddConfirmBtn').html("Save");
    if (response.status==200) {
        if (response.data==1) {
          $('#addProductModal').modal('hide');
          $('#image_preview').html('');
          $('#ProductNameId').val('');
          $('#ProductDesId').val('');
          $('#ProductCatSelect').val('');
          $('#ProductSubCatSelect').val('');
          $('#ProductBrandSelect').val('');
          $('#ProductUnitSelect').val('');
          $('#ProductImage').val('');
          $('#condition').val('');


          toastr.success('Product Add successfully!!');
          getAllProducts();
        }else{
          $('#addProductModal').modal('hide');
          toastr.error('Product Add Fail!!');
          getAllProducts();
        }
    } else {
      $('#addProductModal').modal('hide');
      toastr.error('Product Add Fail!!');
    }
  }).catch(function(error){
    $('#addProductModal').modal('hide');
    toastr.error('Something Went Wrong!!');
  })
}
getAllProducts();

function getAllProducts(){
  axios.get('/allproducts').then(function(response){

    if (response.status==200) {
        $('#ProductMainDiv').removeClass('d-none');
        $('#loaderProductDiv').addClass('d-none');

        $('#ProductDataTable').DataTable().destroy();
        $('#ProductTableBody').empty();

        var data = response.data;

        $.each(data, function(i, item){

          var desc = data[i].product_des;
              if(desc.length > 60) desc = desc.substring(0,60)+'...';

            if (data[i].status==1) {
                var status= 'Active';
                var finalStatus = "<a class='catStatusBtns btn btn-sm btn-success' data-id=" + data[i].id + ">"+ status +"</a>"
            }else{
                  var status= 'Inactive';
                   var finalStatus = "<a class='catStatusBtns btn btn-sm btn-danger' data-id=" + data[i].id + ">"+ status +"</a>"
            }

            // console.log(JSON.parse(data[i].product_img));
            let jsonImageArray = JSON.parse(data[i].product_img);

          $('<tr>').html(
            "<td>"+data[i].id+"</td>"+
            "<td>"+data[i].product_name+"</td>"+
            "<td>"+desc+"</td>"+
            "<td>"+data[i].product_cat+"</td>"+
            "<td>"+data[i].subcat_id+"</td>"+
            "<td>"+data[i].brand_id+"</td>"+

            "<td>"+data[i].unit_id+"</td>"+
            "<td><img class='table-img' src=" + jsonImageArray[0] + "></td>"+

            "<td>"+finalStatus+"</td>" +


            "<td><a style='font-size:11px' class='PeroductAddAttrBtn btn btn-sm btn-primary px-1 m-0' data-id=" + data[i].id + ">Add-Attr <i class='fas fa-plus-circle'></i></a></td>" +
            "<td><a  class='PeroductEditBtn' data-id=" + data[i].id + "><i class='fas fa-edit'></i></a></td>" +
            "<td><a  class='PeroductDeleteBtn'  data-id=" + data[i].id +" ><i class='fas fa-trash-alt'></i></a></td>"
          ).appendTo('#ProductTableBody');
        });


        // change status click
        $('.catStatusBtns').click(function(){
                var id = $(this).data('id');
                cnangeProductStatus(id);
            });

        // add attribute modal show
        $('.PeroductAddAttrBtn').click(function(){
          var id = $(this).data('id');
          $('#AttrProductModalId').val(id);
          $('#AttrProductModal').modal('show');
        })
        // delete product modal show
        $('.PeroductDeleteBtn').click(function(){
          var id = $(this).data('id');
          $('#deleteModalProductId').html(id);
          $('#deleteProductModal').modal('show');
        })

        // edit modal open
        $('.PeroductEditBtn').click(function(){
                $('#updateProductModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateProductId').html(id);
                updateProductDetails(id);
            });



        $('#ProductDataTable').DataTable({"order":false});
        $('.dataTables_length').addClass('bs-select');

    } else {
      $('#loaderProductDiv').addClass('d-none');
      $('#WrongProductDiv').removeClass('d-none');
    }
  }).catch(function(error){
    $('#loaderProductDiv').addClass('d-none');
    $('#WrongProductDiv').removeClass('d-none');
  })
}


// status update
function cnangeProductStatus(id){
  axios.post('/productsStatus',{
    id:id
  }).then(function(response){
    if (response.status==200) {
      if (response.data==1) {
        toastr.success('Product Status Change!!');
        getAllProducts();
      } else {
        toastr.error('Product Status Change fail!!');
        getAllProducts();
      }
    } else {
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    toastr.error(error);
  })
}

// update deatils product fetch
function updateProductDetails(id){
  axios.post('/productDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateProductModalDNone').removeClass('d-none');
            $('#UpdateProductLoader').addClass('d-none');
            var jsonData = response.data;
            console.log(jsonData);
            $('#ProductUpdateNameId').val(jsonData[0].product_name);
            $('#ProductUpdateDesId').val(jsonData[0].product_des);
            $('#ProductUpdateCatSelect').val(jsonData[0].product_cat);
            $('#ProductUpdateSubCatSelect').val(jsonData[0].subcat_id);
            $('#ProductUpdateBrandSelect').val(jsonData[0].brand_id);
            $('#ProductUpdateUnitSelect').val(jsonData[0].unit_id);
            $('#ProductUpdatestatus').val(jsonData[0].status);
            $('#Updateis_featured').val(jsonData[0].is_featured);
            $('#Updatecondition').val(jsonData[0].condition);
            var imgData = JSON.parse(jsonData[0].product_img);
            // console.log(imgData);

            $('.productpreviewimagestyle').addClass('d-none');
            for (let productImg of imgData) {
              // console.log(productImg);
              $($.parseHTML('<img class="productpreviewimagestyle">')).attr('src', productImg).appendTo('#Update_image_preview');
            }
           
           

        } else{
          $('#UpdateProductLoader').addClass('d-none');
          $('#WrongProductUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateProductLoader').addClass('d-none');
    $('#WrongProductUpdate').removeClass('d-none');
  })
 }




 //  update confirm

$('#ProductUpdateConfirmBtn').click(function(){
  var id = $('#UpdateProductId').html();
  var name =  $('#ProductUpdateNameId').val();

  var description = $('#ProductUpdateDesId').val();
  var productcat = $('#ProductUpdateCatSelect').val();
  var productsubcat = $('#ProductUpdateSubCatSelect').val();
  var brand = $('#ProductUpdateBrandSelect').val();
  var unit = $('#ProductUpdateUnitSelect').val();
  var status = $('#ProductUpdatestatus').val();
  var isFeatured = $('#Updateis_featured').val();
  var condition = $('#Updatecondition').val();
  
  var img = $('#ProductUpdateImage')[0].files[0];
  
  var puImg = $('#ProductUpdateImage')[0];

  let UpdateTotalFiles = $('#ProductUpdateImage')[0].files.length;

  var form_data = new FormData(); 
  form_data.append("UpdateTotalFiles", UpdateTotalFiles) ;
  for (let i = 0; i < UpdateTotalFiles; i++) {
    form_data.append('img' + i, puImg.files[i]);
      }

  form_data.append("name", name);
  form_data.append("description", description);
  form_data.append("id", id);
  form_data.append("status", status);
  form_data.append("productcat", productcat);
  form_data.append("productsubcat", productsubcat);
  form_data.append("brand", brand);
  form_data.append("unit", unit);
  form_data.append("isFeatured", isFeatured);
  form_data.append("condition", condition);
  

  
   $('#ProductUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateProduct', form_data).then(function(response){
          $('#ProductUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#updateProductModal').modal('hide');
                toastr.success('Update Barnd Success');
              getAllProducts();
            } else {
                $('#updateProductModal').modal('hide');
                toastr.error('Update Barnd Fail');
              getAllProducts();
            }
          }
          else{
            $('#updateProductModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#updateProductModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})



$('#ProductDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalProductId').html();
  $('#ProductDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/productDelete',{
    id:id
  }).then(function(response){
    $('#ProductDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteProductModal').modal('hide');
        toastr.success('Product delete successfully!!');
        getAllProducts();
      } else {
        $('#deleteProductModal').modal('hide');
        toastr.error('Product delete fail!!');
        getAllProducts();
      }
    } else {
      $('#deleteProductModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteProductModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})



$(document).ready(function(){
      var postURL = "<?php echo url('/productattr'); ?>";
      var i=1;

      $('#add').click(function(){
          i++;
          $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><select id="ColorAttrSelect" class="w-100 form-control" name="color[]"><option selected>Color</option>@foreach($color as $col)<option value="{{ $col->id }}" >{{$col->color}}</option>@endforeach</select></td><td><select id="SizeAttrSelect" class="w-100 form-control" name="size[]"><option selected>Size</option>@foreach($sizes as $size)<option value="{{ $size->id }}" >{{$size->size}}</option>@endforeach</select></td><td><input type="text" id="AttrQuantity" name="quantity[]" placeholder="Product Quantity" class="form-control name_list" /></td><td><input type="text" id="AttrPrice" name="price[]" placeholder="Product Price" class="form-control name_list" /></td><td><input type="text" id="AttrDiscount" name="discount[]" placeholder="Discount Price" class="form-control name_list" /></td> <td><select id="AttributeStatus" class="form-control w-100" name="attrStatus[]"><option value="">Select Status</option><option value="1" >Active</option><option value="0" >Inctive</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-sm btn-danger btn_remove">X</button></td></tr>');
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

    $('#AttrProductModalSave').click(function(){
         $.ajax({
              url:postURL,
              method:"POST",
              data:$('#add_attr').serialize(),
              type:'json',
              success:function(data)
              {
                  if(data.error){
                      printErrorMsg(data.error);
                    $('#AttrProductModal').modal('hide');
                      toastr.error('Something Went Wromg');
                  }else{
                    if(data.success=='Already Have Data'){
                      toastr.warning('Already Have Data');
                    }
                     else{
                      i=1;
                      $('.dynamic-added').remove();
                      $('#add_attr')[0].reset();
                        $('#AttrProductModal').modal('hide');
                      toastr.success('Add Success');
                     }
                  }
              }

         });


    });


  });



 // Multiple images preview in browser for adding new product
 function imagesPreview(input, placeToInsertImagePreview) {
    if (input.files) {
        var filesAmount = input.files.length;

        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();

            reader.onload = function(event) {
                $($.parseHTML('<img class="productpreviewimagestyle">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
            }

            reader.readAsDataURL(input.files[i]);
        }
    }

 };
 // Multiple images preview in browser for update product
 function updateImagesPreview(input, placeToInsertImagePreview) {
    if (input.files) {
        var filesAmount = input.files.length;

        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();

            reader.onload = function(event) {
                $($.parseHTML('<img class="productpreviewimagestyle">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
            }

            reader.readAsDataURL(input.files[i]);
        }
    }

 };

$('#ProductImage').on('change', function() {
  $('#image_preview').html('');
  var prev = $('#image_preview');
        imagesPreview(this, prev);
});

$('#ProductUpdateImage').on('change', function() {
  $('#Update_image_preview').html('');
  var prev = $('#Update_image_preview');
        updateImagesPreview(this, prev);
});


</script>
@endsection
