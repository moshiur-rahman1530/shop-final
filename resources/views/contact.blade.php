@extends('layouts.app2')
@section('socialIcon')
    @include('layouts.socialhome')
@endsection

@section('content')

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Contact Us</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Contact</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Contact For Any Queries</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">

                    <div id="success">
                    @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                    </div>
                    <div id="frmContact">
                        <div id="mail-status"></div>

                        <span id="name-info" class="info text-danger"></span>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="name-info">Your Name:</span>
                            <input type="text" name="name" id="name" class="demoInputBox form-control" placeholder="Jhon Doe, For example" aria-describedby="name-info">
                        </div>
                        <span id="email-info" class="info text-danger"></span>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="email-info">Your Email:</span>
                            <input type="text" name="email" id="email" class="demoInputBox form-control" placeholder="example@gmail.com" aria-describedby="email-info">
                        </div>
                        <span id="phone-info" class="info text-danger"></span>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="phone-info">Your Phone:</span>
                            <input type="text" name="phone" id="phone" class="demoInputBox form-control" placeholder="880190000000,For example" aria-describedby="phone-info">
                        </div>
                        <span id="subject-info" class="info text-danger"></span>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="subject-info">Your Subject:</span>
                            <input type="text" name="subject" id="subject" class="demoInputBox form-control" placeholder="880190000000,For example" aria-describedby="subject-info">
                        </div>
                        <span id="message-info" class="info text-danger"></span>
                        <div class="control-group mt-2">
                            <span class="input-group-text" id="subject-info">Your Message:</span>
                            <textarea class="form-control demoInputBox" rows="5" id="message" placeholder="Your Short Message"
                                required="required"
                                data-validation-required-message="Please enter your message" aria-describedby="message-info"></textarea>
                        </div>
                        
                        <div>
                            <button name="submit" class="btnAction btn btn-primary font-weight-bold py-2 mt-2 px-4" onClick="sendContact();" style="border-radius:2px">Send</button>
                        </div>
                    </div>



                </div>
            </div>
            @foreach(App\Models\Settings::first()->get() as $contact)
            <div class="col-lg-5 mb-5">
                <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
                <p>{{$contact->short_des}}</p>
               
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-semi-bold mb-3">Store 1</h5>
                    
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$contact->address1}}</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{$contact->email}}</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>{{$contact->phone}}</p>
                </div>
                <div class="d-flex flex-column">
                    <h5 class="font-weight-semi-bold mb-3">Store 2</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$contact->address2}}</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{$contact->email}}</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{$contact->phone}}</p>
                </div>
                
            </div>
            @endforeach
        </div>
    </div>
    <!-- Contact End -->

@endsection

@section('script')
<script type="text/javascript">


function sendContact() {
    var valid;	
    valid = validateContact();
    if(valid) {
        $.ajax({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/contact-us",
            data:'name='+$("#name").val()+'&email='+
            $("#email").val()+'&phone='+
            $("#phone").val()+'&subject='+
            $("#subject").val()+'&message='+
            $("#message").val(),
            type: "POST",
            success:function(data){
                $("#mail-status").html(data);
                toastr.success('Contact info store success!!');
                $("#name").val('');
                $("#email").val('');
                $("#phone").val('');
                $("#subject").val('');
                $("#message").val('');
            },
            error:function (){}
        });
    }
}


function validateContact() {
    var valid = true;	
    $(".demoInputBox").css('background-color','');
    $(".info").html('');
    if(!$("#name").val()) {
        $("#name-info").html("(*Name field required)");
        $("#name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#email").val()) {
        $("#email-info").html("(*Email fieldrequired)");
        $("#email").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
        $("#email-info").html("(invalid)");
        $("#email").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#phone").val()) {
        $("#phone-info").html("(*Phone field required)");
        $("#phone").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#subject").val()) {
        $("#subject-info").html("(*Subject field required)");
        $("#subject").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#message").val()) {
        $("#message-info").html("(*Message field required)");
        $("#message").css('background-color','#FFFFDF');
        valid = false;
    }
    return valid;
}

</script>
@endsection
