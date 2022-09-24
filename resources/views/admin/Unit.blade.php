@extends('admin.layouts.app')
@section('title','Units')
@section('content')
<div id="UnitMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

      <div class="row">
        <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Unit Lists</h6></div>
        <div class="col-md-6"> <button id="addNewUnit" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fas fa-plus"></i> Add New</button></div>
      </div>

      <table id="UnitDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
        	  <th class="th-sm">ID</th>
            <th class="th-sm">Name</th>
            <th class="th-sm">Status</th>
        	  <th class="th-sm">Edit</th>
        	  <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="UnitTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderUnitDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongUnitDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete course -->
<div class="modal fade" id="deleteUnitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
         <h5 class="modal-title" id="deleteModalUnitId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this category!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="UnitDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for adding sub category -->
<div class="modal fade" id="addUnitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Units</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
            <input id="UnitNameId" type="text" id="" class="form-control mb-3" placeholder="Unit Name">
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="UnitAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
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
         <h5 class="modal-title" id="CatStatusUnitId"> </h5>
       	<h5 class="modal-title">Are you sure to Update Status!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="UnitStatusConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for update course -->
<div class="modal fade" id="UpdateUnitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <h5 id="UpdateUnitId" class="d-none"> </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateUnitLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongUnitUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateUnitModalDNone">

       <div class="container">
         	<input id="UpdateUnitNameId" type="text" id="" class="form-control mb-3" placeholder="Unit Name">
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="UnitUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
getAllUnit();

function getAllUnit(){
  axios.get('/allunits').then(function(response){

     if (response.status == 200) {
         $('#UnitMainDiv').removeClass('d-none');
         $('#loaderUnitDiv').addClass('d-none');

         $('#UnitDataTable').DataTable().destroy();
         $('#UnitTableBody').empty();

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
                 "<td>"+jsonData[i].name+"</td>"+
                   "<td>"+ finalStatus +"</td>" +
                 "<td><a  class='subcategoryEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                 "<td><a class='subcategoryDeleteBtn' data-id='" + jsonData[i].id + "'><i class='fas fa-trash-alt'></i></a></td>"
              ).appendTo('#UnitTableBody');
            });
              // show edit modal
            $('.subcategoryEditBtn').click(function(){
                $('#UpdateUnitModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateUnitId').html(id);
                updateUnitDetails(id);
            });

              // show delete modal
            $('.subcategoryDeleteBtn').click(function(){
                $('#deleteUnitModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalUnitId').html(id);
            });

            // change status click
            $('.catStatusBtns').click(function(){
                var id = $(this).data('id');
                cnangeUnitStatus(id);
            });


       $('#UnitDataTable').DataTable({"order":false});
       $('.dataTables_length').addClass('bs-select');

     }else{
       $('#loaderUnitDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderUnitDiv').addClass('d-none');
    $('#WrongUnitDiv').removeClass('d-none');
  });
}

// detais show in update exampleModalLabel
function updateUnitDetails(id){
  axios.post('/unitsDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateUnitModalDNone').removeClass('d-none');
            $('#UpdateUnitLoader').addClass('d-none');
            var jsonData = response.data;
            $('#UpdateUnitNameId').val(jsonData[0].name);
            $('#UpdateUnitDesId').val(jsonData[0].description);
            $('#UpdateUnitImgId').val(jsonData[0].img);
        } else{
          $('#UpdateUnitLoader').addClass('d-none');
          $('#WrongUnitUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateUnitLoader').addClass('d-none');
    $('#WrongUnitUpdate').removeClass('d-none');
  })
}

// update Unit

$('#UnitUpdateConfirmBtn').click(function(){
  var id = $('#UpdateUnitId').html();
  var name =  $('#UpdateUnitNameId').val();
   $('#UnitUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateUnit',{
    id:id,
    name:name,
  }).then(function(response){
          $('#UnitUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#UpdateUnitModal').modal('hide');
                toastr.success('Update Units Success');
              getAllUnit();
            } else {
                $('#UpdateUnitModal').modal('hide');
                toastr.error('Update Units Fail');
              getAllUnit();
            }
          }
          else{
            $('#UpdateUnitModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#UpdateUnitModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})

// status update
function cnangeUnitStatus(id){
  axios.post('/unitsStatus',{
    id:id
  }).then(function(response){
    if (response.status==200) {
      if (response.data==1) {
        toastr.success('Unit Status Change!!');
        getAllUnit();
      } else {
        toastr.error('Unit Status Change fail!!');
        getAllUnit();
      }
    } else {
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    toastr.error(error);
  })
}

$('#UnitStatusConfirmBtn').click(function(){
  var id = $('#CatStatusUnitId').html();
  $('#UnitStatusConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/unitsStatus',{
    id:id
  }).then(function(response){
    $('#UnitStatusConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#CatStatusUpdate').modal('hide');
        toastr.success('Unit delete successfully!!');
        getAllUnit();
      } else {
        $('#CatStatusUpdate').modal('hide');
        toastr.error('Unit delete fail!!');
        getAllUnit();
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

$('#UnitDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalUnitId').html();
  $('#UnitDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/unitsDelete',{
    id:id
  }).then(function(response){
    $('#UnitDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteUnitModal').modal('hide');
        toastr.success('Unit delete successfully!!');
        getAllUnit();
      } else {
        $('#deleteUnitModal').modal('hide');
        toastr.error('Unit delete fail!!');
        getAllUnit();
      }
    } else {
      $('#deleteUnitModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteUnitModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})

// add new category
$('#addNewUnit').click(function(){
  $('#addUnitModal').modal('show');
})

$('#UnitAddConfirmBtn').click(function(){
  var UnitName =$('#UnitNameId').val();
  addUnit(UnitName);
})
function addUnit(UnitName, UnitDes, UnitImg){
  $('#UnitAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/units', {
    name: UnitName,
  }).then(function(response){
      $('#UnitAddConfirmBtn').html("Save");
      if(response.status==200){
              if (response.data == 1) {
                $('#addUnitModal').modal('hide');
                toastr.success('Add Success');
                getAllUnit();
            } else {
                $('#addUnitModal').modal('hide');
                toastr.error('Add Fail');
                getAllUnit();
            }
          }
  }).catch(function(error){
    $('#addUnitModal').modal('hide');
    toastr.error('Something Went Wromg');
  });
}


</script>
@endsection
