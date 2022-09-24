@extends('admin.layouts.app')
@section('title','Visitors')
@section('content')
<div id="mainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Users Lists</h6></div>
      <div class="col-md-6"> <button id="showActiveUser" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fas fa-plus"></i> See Status</button></div>
    </div>

      <table id="VisitorDt" class="table table-striped table-sm table-bordered table-responsive" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">NO</th>
            <th class="th-sm">Name</th>
            <th class="th-sm">Email</th>
            <th class="th-sm">Phone</th>
            <th class="th-sm">Photo</th>

            <th class="th-sm">Contact</th>

            <th class="th-sm">Login Status</th>
            <th class="th-sm">Last Seen</th>
            <th class="th-sm">User Type</th>
            
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
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="visitorDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal for sending sms  -->
<div class="modal fade" id="smsUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container">
         <h5 class="modal-title d-none" id="userSmsId"> </h5>
       	<img id="smsUserimage" src="" alt="" style="width:80px;">
        <h2 class="mt-1" id="smsUserName"></h2>
        <h6 class="" id="smsUseremail"></h6>
        <p class="mb-3" id="smsUserAddress"></p>

        <input class="form-control" type="text" id="smsUserPhone" value="Norway" readonly><br><br>

        <textarea class="form-control" id="smsUserMessage" rows="8" placeholder="Write your message"></textarea>

       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancal</button>
        <button  id="sendSmsBtn" type="button" class="btn  btn-sm  btn-danger">Send</button>
      </div>
    </div>
  </div>
</div>



@endsection
@section('script')
 <script type="text/javascript">

getAllUsers();

 function getAllUsers() {
    axios.get('/admin/getUser')
        .then(function(response) {

            if (response.status == 200) {
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#VisitorDt').DataTable().destroy();
                $('#visitor_table').empty();
                var jsonData = response.data;
               

                $.each(jsonData, function(i, item) {
                  var userType = jsonData[i].is_admin;
                  $uaid = jsonData[i].id;
                if(userType==1){
                  userType = 'Admin'
                }else{
                  userType = 'Normal User'
                }

                if (jsonData[i].status=='Online') {
                  var statusText = "<span class='text-success'>Online</span>";
                } else {
                  var statusText = "<span class='text-danger'>Offline</span>";
                }

                var userd = {!! (auth()->user()) !!};

                var addressText = jsonData[i].area;
                
                if(typeof addressText === 'undefined'){
                 addressText = "'Not Found'";
                }else{
                 addressText = jsonData[i].area;
                }

                   if(userd.id==jsonData[i].id){
                    var contactIcon = '<div class="d-flex justify-content-center align-items-center"> <p style="width:10px; height:10px; background-color: green; border-radius:50%;"></p><p class="ml-2">Own id</p></div>'
                   }
                    else{
                      var contactIcon = '<div class="d-flex justify-content-between px-2 px-md-4"><a class="userPhoneSendSmsl" data-id='+jsonData[i].id+' data-email='+jsonData[i].email+' data-phone='+jsonData[i].phone+' data-addrs='+addressText+' data-image='+jsonData[i].image+' data-name='+jsonData[i].name+'><i class="fas fa-phone text-success" style="font-size: 20px"></i></a><a class="UserMessage ml-3" href="mailto:'+jsonData[i].email+'"><i class="fas fa-envelope-square text-info" style="font-size: 20px"></i></a></div>'
                    }
                    

                    $('<tr>').html(
                        "<td>"+jsonData[i].id+"</td>" +
                        "<td><a class='FindVisitor'  data-id=" + jsonData[i].id +" >"+jsonData[i].name+"</a></td>" +
                        "<td>"+jsonData[i].email+"</td>" +
                        "<td>"+jsonData[i].phone+"</td>" +
                        "<td><img src="+jsonData[i].image+" class='img-fluid'></td>" +
                        "<td>"+contactIcon+"</td>" +
                        "<td> "+statusText+"</td>" +
                        "<td>"+jsonData[i].last_seen+"</td>" +
                        
                        "<td>"+userType+"</td>" +

                        "<td class='text-center'><a  class='courseDeleteBtn'  data-id=" + jsonData[i].id +" ><i class='fas fa-trash-alt text-danger'></i></a><a class='visitorShowBtn mx-4'  data-id=" + jsonData[i].id +" ><i class='fas fa-eye text-success'></i></a></td>"

                    ).appendTo('#visitor_table');

                });
                     $('.courseDeleteBtn').click(function(){
                      var id= $(this).data('id');
                      $('#serviceSelectId').html(id);
                      $('#deleteVisitorModal').modal('show');
                     });

                     $('.userPhoneSendSmsl').click(function(){
                      $("body").children().first().before($(".modal"));
                      $('#smsUserModal').modal('show');
                      var id= $(this).data('id');
                      var image= $(this).data('image');
                      $('#smsUserimage').attr('src',image);
                      $('#userSmsId').html(id);
                      var name= $(this).data('name');
                      $('#smsUserName').html(name);
                      var email= $(this).data('email');
                      $('#smsUseremail').html(email);
                      var phone= $(this).data('phone');
                      $('#smsUserPhone').val(phone);
                      var area= $(this).data('addrs');
                      $('#smsUserAddress').html(area);
                     
                     });

                     // find user
                     $('.visitorShowBtn').click(function(){
                      var id= $(this).data('id');
                      window.location.href = '/admin/singleUserPage/'+id+'';
                     })

                     // find user
                     $('.FindVisitor').click(function(){
                      var id= $(this).data('id');
                      window.location.href = '/admin/singleUserPage/'+id+'';
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



// send sms in phone no

$("#sendSmsBtn").click(function(){
  var msgText =$('#smsUserMessage').val();

  $('#sendSmsBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
  axios.post('/send-sms',{msgText:msgText}
  ).then(function(response){
          $('#sendSmsBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                
                toastr.success('Send SMS Successfull!!');
                $('#smsUserModal').modal('hide');
            } else {
                
                toastr.error('Send SMS Fail!! Fail');
                $('#smsUserModal').modal('hide');
            }
          }
          else{
            $('#smsUserModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#smsUserModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })

})

// showActiveUser

 $('#showActiveUser').click(function(){

    window.location.href = '/admin/active_user';
  })


// Course Delete Confirm
$('#visitorDeleteConfirmBtn').click(function(){
  var id= $('#serviceSelectId').html();
  VisitorDelete(id);
})

// visitor delete


function VisitorDelete(deleteID){
  $('#visitorDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/admin/DeleteUser',{
            id: deleteID
        })
  .then(function (response) {
   $('#visitorDeleteConfirmBtn').html("Yes");
   if (response.status==200) {
     if (response.data==1) {
       $('#deleteVisitorModal').modal('hide');
       toastr.success('Delete Success');
       getAllUsers();
     } else {
       $('#deleteVisitorModal').modal('hide');
       toastr.error('Delete fail');
       getAllUsers();
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
