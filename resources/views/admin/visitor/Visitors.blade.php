@extends('admin.layouts.app')
@section('title','Visitors')
@section('content')
<div id="mainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">
      <table id="VisitorDt" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">NO</th>
            <th class="th-sm">IP</th>
            <th class="th-sm">Date & Time</th>
            <th class="th-sm">Action</th>
          </tr>
        </thead>
        <tbody id="visitor_table">

        </tbody>
      </table>
    </div>
  </div>
  <div class="comment">

  </div>
</div>


<div id="loaderDiv" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">
		<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
</div>
</div>
</div>


<div id="WrongDiv" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">
		<h3>Something Went Wrong !</h3>
</div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="deleteVisitorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-5 text-center">
          <div id="serviceAddForm" class=" w-100">
              <h6 id="serviceSelectId" class="mb-4"> </h6>
          <h6 class="mb-4">Are your sure to delete?</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="visitorDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
 <script type="text/javascript">

getAllVisitor();

 function getAllVisitor() {
    axios.get('/getVisitor')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#VisitorDt').DataTable().destroy();
                $('#visitor_table').empty();
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>"+jsonData[i].id+"</td>" +
                        "<td><a class='FindVisitor'  data-id=" + jsonData[i].id +" >"+jsonData[i].ip_address+"</a></td>" +
                        "<td>"+jsonData[i].visit_time+"</td>" +
                        "<td class='text-center'><a  class='courseDeleteBtn'  data-id=" + jsonData[i].id +" ><i class='fas fa-trash-alt text-danger'></i></a><a class='visitorShowBtn mx-4'  data-id=" + jsonData[i].id +" ><i class='fas fa-eye text-success'></i></a></td>"

                    ).appendTo('#visitor_table');

                });
                     $('.courseDeleteBtn').click(function(){
                      var id= $(this).data('id');
                      $('#serviceSelectId').html(id);
                      $('#deleteVisitorModal').modal('show');
                     })

                     // find visitorModal
                     $('.visitorShowBtn').click(function(){
                      var id= $(this).data('id');
                      window.location.href = '/singleVisitorPage/'+id+'';
                     })

                     $('#VisitorDt').DataTable({"order":false});
                     $('.dataTables_length').addClass('bs-select');

            } else {

                $('#loaderDiv').addClass('d-none');
                $('#WrongDiv').removeClass('d-none');

            }

        })
        .catch(function(error) {
                $('#loaderDiv').addClass('d-none');
                $('#WrongDiv').removeClass('d-none');
        });
}



// Course Delete Confirm
$('#visitorDeleteConfirmBtn').click(function(){
  var id= $('#serviceSelectId').html();
  VisitorDelete(id);
})

// visitor delete


function VisitorDelete(deleteID){
  $('#visitorDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/DeleteVisitor',{
            id: deleteID
        })
  .then(function (response) {
   $('#visitorDeleteConfirmBtn').html("Yes");
   if (response.status==200) {
     if (response.data==1) {
       $('#deleteVisitorModal').modal('hide');
       toastr.success('Delete Success');
       getAllVisitor();
     } else {
       $('#deleteVisitorModal').modal('hide');
       toastr.error('Delete fail');
       getAllVisitor();
     }
   }else{
     $('#deleteVisitorModal').modal('hide');
     toastr.error('Something went wrong');
   }
    console.log(response);
  })
  .catch(function (error) {
    $('#deleteVisitorModal').modal('hide');
    toastr.error('Something went wrong');
    console.log(error);
  })
}

 </script>
@endsection
