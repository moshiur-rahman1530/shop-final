@extends('admin.layouts.app')

@section('title','Settings')
@section('content')

<div class="card">
    <h5 class="card-header">Website Settings</h5>
    <div class="card-body">
        <div class="form-group">
          <label for="title_first_letter" class="col-form-label">Title First Letter <span class="text-danger">*</span></label>
          <input type="text" id="title_first_letter" class="form-control" name="title_first_letter" required value="{{$data->title_first_letter}}">
          @error('title_first_letter')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="title_remain" class="col-form-label">Title Remaining<span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="title_remain" name="title_remain" required value="{{$data->title_remain}}">
          @error('title_remain')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="short_des" class="col-form-label">Short Description <span class="text-danger">*</span></label>
          <textarea class="form-control" id="quote" name="short_des">{{$data->short_des}}</textarea>
          @error('short_des')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
          <textarea class="form-control" id="description" name="description">{{$data->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Logo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail1" class="form-control" type="text" name="logo" value="{{$data->logo}}">
        </div>
        <div id="holder1" style="margin-top:15px;max-height:100px;"></div>

          @error('logo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail1" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail2" class="form-control" type="text" name="photo" value="{{$data->photo}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="address1" class="col-form-label">Address 1 <span class="text-danger">*</span></label>
          <input id="address1" type="text" class="form-control" name="address1" required value="{{$data->address1}}">
          @error('address1')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="address2" class="col-form-label">Address 2 <span class="text-danger">*</span></label>
          <input id="address2" type="text" class="form-control" name="address2" required value="{{$data->address2}}">
          @error('address2')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
          <input type="email" id="email" class="form-control" name="email" required value="{{$data->email}}">
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="phone" class="col-form-label">Phone Number <span class="text-danger">*</span></label>
          <input type="text" id="phone" class="form-control" name="phone" required value="{{$data->phone}}">
          @error('phone')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="footer1" class="col-form-label">Footer Start <span class="text-danger">*</span></label>
          <input type="text" id="footer1" class="form-control" name="footer1" required value="{{$data->footer1}}">
          @error('footer1')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="footer2" class="col-form-label">Footer Middle <span class="text-danger">*</span></label>
          <input id="footer2" type="text" class="form-control" name="footer2" required value="{{$data->footer2}}">
          @error('footer2')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="footer3" class="col-form-label">Footer End <span class="text-danger">*</span></label>
          <input id="footer3" type="text" class="form-control" name="footer3" required value="{{$data->footer3}}">
          @error('footer3')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <!-- feature -->
        <div class="form-group">
          <label for="icon1" class="col-form-label">First Feature Icon <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="icon1" name="icon1" required value="{{$data->icon1}}">
          @error('icon1')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="feature1" class="col-form-label">First Feature <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="feature1" name="feature1" required value="{{$data->feature1}}">
          @error('feature1')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="icon2" class="col-form-label">Second Feature Icon <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="icon2" name="icon2" required value="{{$data->icon2}}">
          @error('icon2')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="feature2" class="col-form-label">Second Feature <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="feature2" name="feature2" required value="{{$data->feature2}}">
          @error('feature2')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="icon3" class="col-form-label">Third Feature Icon <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="icon3" name="icon3" required value="{{$data->icon3}}">
          @error('icon3')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="feature3" class="col-form-label">Third Feature <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="feature3" name="feature3" required value="{{$data->feature3}}">
          @error('feature3')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="icon4" class="col-form-label">Fourth Feature Icon <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="icon4" name="icon4" required value="{{$data->icon4}}">
          @error('icon4')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="feature4" class="col-form-label">Fourth Feature <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="feature4" name="feature4" required value="{{$data->feature4}}">
          @error('feature4')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <!-- vendor image update start -->

        <label for="feature4" class="col-form-label mt-3 mb-1">Vendor Photo Update <span class="text-danger">*</span></label>
        <div class="container vendorUpdate row mb-3">
          
          <!-- vendor image 1 -->
          <div class="vendor1 col-12 col-md-3">
            <input type="hidden" id="profile-photo1" name="profile-photo1" value="{{$data->vendor1}}">
            <img src="{{$data->vendor1}}" id="profile-photo1-preview" style="width:140px">
            <button class="btn btn-sm btn-info" onclick="filemanager.selectFile('profile-photo1')"><i class="fa fa-check-circle fa-2x align-bottom"></i> <span class="align-middle">Choose Vendor Img 1</span></button>
          </div>
          <!-- vendor image 2 -->
          <div class="vendor2 col-12 col-md-3">
            <input type="hidden" id="profile-photo2" name="profile-photo2" value="{{$data->vendor2}}">
            <img src="{{$data->vendor2}}" id="profile-photo2-preview" style="width:140px">
            <button class="btn btn-sm btn-info" onclick="filemanager.selectFile('profile-photo2')"><i class="fa fa-check-circle fa-2x align-bottom"></i> <span class="align-middle">Choose Vendor Img 2</span></button>
          </div>
          
          <!-- vendor image 3 -->
          <div class="vendor3 col-12 col-md-3">
            <input type="hidden" id="profile-photo3"  name="profile-photo3" value="{{$data->vendor3}}">
            <img src="{{$data->vendor3}}" id="profile-photo3-preview" style="width:140px">
            <button class="btn btn-sm btn-info" onclick="filemanager.selectFile('profile-photo3')"><i class="fa fa-check-circle fa-2x align-bottom"></i> <span class="align-middle">Choose Vendor Img 3</span></button>
          </div>
          <!-- vendor image 4 -->
          <div class="vendor4 col-12 col-md-3">
            <input type="hidden" id="profile-photo4"  name="profile-photo4" value="{{$data->vendor4}}">
            <img src="{{$data->vendor4}}" id="profile-photo4-preview" style="width:140px">
            <button class="btn btn-sm btn-info" onclick="filemanager.selectFile('profile-photo4')"><i class="fa fa-check-circle fa-2x align-bottom"></i> <span class="align-middle">Choose Vendor Img 4</span></button>
          </div>
          
          <!-- vendor image 5 -->
          <div class="vendor5 col-12 col-md-3">
            <input type="hidden" id="profile-photo5"  name="profile-photo5" value="{{$data->vendor5}}">
            <img src="{{$data->vendor5}}" id="profile-photo5-preview" style="width:140px">
            <button class="btn btn-sm btn-info" onclick="filemanager.selectFile('profile-photo5')"><i class="fa fa-check-circle fa-2x align-bottom"></i> <span class="align-middle">Choose Vendor Img 5</span></button>
          </div>
          <!-- vendor image 6 -->
          <div class="vendor6 col-12 col-md-3">
            <input type="hidden" id="profile-photo6"  name="profile-photo6" value="{{$data->vendor6}}">
            <img src="{{$data->vendor6}}" id="profile-photo6-preview" style="width:140px">
            <button class="btn btn-sm btn-info" onclick="filemanager.selectFile('profile-photo6')"><i class="fa fa-check-circle fa-2x align-bottom"></i> <span class="align-middle">Choose Vendor Img 6</span></button>
          </div>
          <!-- vendor image 7 -->
          <div class="vendor7 col-12 col-md-3">
            <input type="hidden" id="profile-photo7"  name="profile-photo7" value="{{$data->vendor7}}">
            <img src="{{$data->vendor7}}" id="profile-photo7-preview" style="width:140px">
            <button class="btn btn-sm btn-info" onclick="filemanager.selectFile('profile-photo7')"><i class="fa fa-check-circle fa-2x align-bottom"></i> <span class="align-middle">Choose Vendor Img 7</span></button>
          </div>
          <!-- vendor image 8 -->
          <div class="vendor8 col-12 col-md-3">
            <input type="hidden" id="profile-photo8"  name="profile-photo8" value="{{$data->vendor8}}">
            <img src="{{$data->vendor8}}" id="profile-photo8-preview" style="width:140px">
            <button class="btn btn-sm btn-info" onclick="filemanager.selectFile('profile-photo8')"><i class="fa fa-check-circle fa-2x align-bottom"></i> <span class="align-middle">Choose Vendor Img 8</span></button>
          </div>
        </div>


        <!-- vendor image update end -->

      


        <div class="form-group mb-3">
           <button class="btn btn-success settingsubmit" id="settingsubmit" type="submit">Update</button>
        </div>
      <!-- </form> -->
    </div>

    
</div>

@endsection

@section('script')
<script type="text/javascript">


$(document).ready(function (e) {

  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

  $("#settingsubmit").click(function(e) {
    e.preventDefault();
    var title_first_letter = $('#title_first_letter').val();
    var title_remain = $('#title_remain').val();
    var short_des = $('#quote').val();
    var description = $('#description').val();
    var logo = $('#thumbnail1').val();
    var photo = $('#thumbnail2').val();
    var address1 = $('#address1').val();
    var address2 = $('#address2').val();    
    var email = $('#email').val();
    var phone = $('#phone').val();
    var footer1 = $('#footer1').val();
    var footer2 = $('#footer2').val();
    var footer3 = $('#footer3').val();
    var icon1 = $('#icon1').val();
    var feature1 = $('#feature1').val();
    var icon2 = $('#icon2').val();
    var feature2 = $('#feature2').val();
    var icon3 = $('#icon3').val();
    var feature3 = $('#feature3').val();
    var icon4 = $('#icon4').val();
    var feature4 = $('#feature4').val();
    var vendor1 = $('#profile-photo1').val();
    var vendor2 = $('#profile-photo2').val();
    var vendor3 = $('#profile-photo3').val();
    var vendor4 = $('#profile-photo4').val();
    var vendor5 = $('#profile-photo5').val();
    var vendor6 = $('#profile-photo6').val();
    var vendor7 = $('#profile-photo7').val();
    var vendor8 = $('#profile-photo8').val();


    console.log(title_first_letter,title_remain,short_des,description,logo,photo,address1,address2,email,phone,footer1,footer2,footer3,icon1,icon2,icon3,icon4,feature1,feature2,feature3,feature4,vendor1,vendor2,vendor3,vendor4,vendor5,vendor6,vendor7,vendor8);

    axios.post('/setting/update',{
      title_first_letter:title_first_letter,title_remain:title_remain,short_des:short_des,description:description,logo:logo,photo:photo,address1:address1,address2:address2,email:email,phone:phone,footer1:footer1,footer2:footer2,footer3:footer3,icon1:icon1,icon2:icon2,icon3:icon3,icon4:icon4,feature1:feature1,feature2:feature2,feature3:feature3,feature4:feature4,vendor1:vendor1,vendor2:vendor2,vendor3:vendor3,vendor4:vendor4,vendor5:vendor5,vendor6:vendor6,vendor7:vendor7,vendor8:vendor8
    }).then(function (response) {
               
if (response.data==1) {
  toastr.success('Update Successfull!!');
}else{
  toastr.error('Update Failed!!');
}
            }).catch(function (error) {
              toastr.error('Something went wrong!!');
            })

});



})
</script>
@endsection


@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

@endpush