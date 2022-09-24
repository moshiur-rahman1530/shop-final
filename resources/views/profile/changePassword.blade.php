@extends('profile.layouts.index')
    @section('socialIcon')
        <div class="ssicon">
        {!! $socialShare !!}   
        </div>
    @endsection
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li> <a href="{{url('/')}}">Home</a> /
                        <a href="{{url('/userdashboard')}}">User Dashboard</a> /
                        </li>
                <li class="active">Update Password</li>
            </ol>
        </div><!--/breadcrums-->



        <div class="row px-3">
            <div class="col-12 col-md-10">

                @if(session('msg'))
                <div class="alert alert-info">  {{session('msg')}}</div>
                @endif

                <h4><span style='color:green'>{{ucwords(Auth::user()->name)}}</span>, Update your Password</h4>

                        <form class="forms-sample" id="bannereditform" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                        
                            <div class="col-12 col-md-8">
                        
                                <div class="mb-3 scheduler-border">
                                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleFormControlInput1" value="{{Auth::user()->name}}">
                                </div>
                                <div class="mb-3 scheduler-border">
                                    <label for="exampleFormControlInput2" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="exampleFormControlInput2" value="{{Auth::user()->email}}">
                                </div>
                                <div class="mb-3 scheduler-border">
                                    <label for="exampleFormControlInput3" class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="exampleFormControlInput3" value="{{Auth::user()->phone}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <img class="mb-2" src="{{Auth::user()->image}}" id="previewImg" alt="user-img" style="width:90%; height: 160px;">
                                <input type="file" class="form-control" name="image" id="updateUserImage">
                            </div>
                        
                            
                        </div> 
                        </form>
                        <div class="" align="right">
                                <button class="btn btn-sm btn-info my-2 mr-5 rounded" type="submit" id="UpdateInfo">Update Info</button>
                            </div>

                        

                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Password Change</legend>
                            <div class="passwordChangeMargin row ">

                                <div class="form-group mb-0 pb-0 col-12">
                                    <label for="example-text-input">Current Password</label>
                                    <div class="input-group">
                                    
                                        <input class="form-control oldPassword" id="oldPassword" type="password"  name="oldPassword">
                                        <span class="input-group-text" role="button"><i class="fa fa-eye-slash" 
                                        id="togglePassword"></i></span>
                                        
                                    </div>
                                    
                                    <!-- <br> -->

                                    <label for="example-text-input" >New Password</label>
                                    <div class="input-group">
                                        <input class="form-control" id="newPassword" type="password"  name="newPassword">
                                        <span class="input-group-text" role="button"><i class="fa fa-eye-slash" 
                                        id="togglePasswordNew"></i></span>
                                    </div>
                                    <div align="right"> <input type="submit" value="Save Change" id="updatePassword" class="btn btn-info btn-sm mt-3"></div>
                                </div>

                            </div>
                        </fieldset>

                            
                    </div>


                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

<script>

$(document).ready(function () {
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });


   

  $("#updateUserImage").change(function() {
   imgPreview(this);
  });
  function imgPreview(input) {
    var file = input.files[0];
    var mixedfile = file['type'].split("/");
    var filetype = mixedfile[0]; // (image, video)
    if(filetype == "image"){
      var reader = new FileReader();
      reader.onload = function(e){
        $("#previewImg").show().attr("src", e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }else{
        alert("Invalid file type");
    }
  }

    $('#updatePassword').click(function(){
        var oldPass = $('#oldPassword').val();
        var newPass = $('#newPassword').val();
       
        axios.post('/changepassword',{
            oldPass:oldPass,
            newPass:newPass
        }).then(function(response){
        if (response.data==1) {
            $('#oldPassword').val('');
            $('#newPassword').val('');
            toastr.success('Your Password Update Successfull!!!');
        }else{
            
            $('#oldPassword').val('');
            $('#newPassword').val('');
            toastr.warning('Your Password Update fail!!!');
        }

        }).catch(function(error){
            
            $('#oldPassword').val('');
            $('#newPassword').val('');
            toastr.error('Your Password Update fail!!!');
        })
    })

    $('#UpdateInfo').click(function(e){
        e.preventDefault();
        var formData = new FormData();

        let name = $("input[name=name]").val();
        let email = $("input[name=email]").val();
        let phone = $("input[name=phone]").val();
        var image = $('#updateUserImage').prop('files')[0];   

        formData.append('image', image);
        formData.append('name', name);
        formData.append('email', email);
        formData.append('phone', phone);
        
        $.ajax({
            url: '/updateuserinfo',
            type: 'POST',
            contentType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: (response) => {
                if (response) {
                     
                    var link = "{{asset('/')}}"+response;
                    console.log(link);
                    const boxes = document.querySelectorAll('#userImgStyle');
                    console.log(boxes); 
                    
                    boxes[0].setAttribute('src',link);
                    toastr.success('Your Information Update Successfull!!!');

                
                }else{
                console.log(response);
                toastr.warning('Your Information Update fail!!!');
                }
                
            },
            error: (response) => {
                toastr.error('Your Information Update fail!!!');
            }
        });
    })

    // password show for oldpassword in eye click

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#oldPassword");

togglePassword.addEventListener("click", function () {
   
  // toggle the type attribute
  const type = password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);
  // toggle the eye icon
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});

// password show for newpassword in eye click
const togglePasswordNew = document.querySelector("#togglePasswordNew");
const passwordNew = document.querySelector("#newPassword");

togglePasswordNew.addEventListener("click", function () {
   
  // toggle the type attribute
  const type = passwordNew.getAttribute("type") === "password" ? "text" : "password";
  passwordNew.setAttribute("type", type);
  // toggle the eye icon
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});

     
});

</script>


@endsection
