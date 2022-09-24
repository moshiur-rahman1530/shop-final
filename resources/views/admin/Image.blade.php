@extends('admin.layouts.app')
@section('title','Brands')
@section('content')



        <div class="container-fluid m-0 ">

            <div class="col-md-12">
                <button class="btn my-3 btn-sm btn-primary font-weight-bold" onclick="filemanager.bulkSelectFile('myBulkSelectCallback')"><i class="fas fa-plus"></i> Add New Images</button>


            </div>

            <div class="row showPhotos">

            </div>
            <button class="btn btn-sm btn-success font-weight-bold" id="LoadMoreImage">Load More </button>
        
        </div> 

 <!-- Modal -->
 <div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Photo</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> 

                </div>

                <div class="modal-body">

              

                <form id="multiple-image-upload-preview-ajax" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="card-title fw-bold">Images Upload</h4>
                            </div>

                            <div class="card-body">
                                <label for="file"> Image(s) <span class="text-danger">*</span> </label>
                                <input type="file" name="images[]" id="images" multiple class="form-control">
                            </div>

                           
                                <div class="preview-image row p-4" id="preview-image"> </div>

                            <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-success" id="submitdata">Submit</button>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">

$(document).ready(function (e) {



    loadPhoto();

    function loadPhoto(){
        axios.get('/getImages').then(function(response){

            if (response.status==200 && response.data) {
                var data = response.data;
                $.each(response.data, function(index, value) {
                    // console.log(value);

                    $("<div class='col-12  col-sm-6 col-md-4 p-2'>").html(
                        "<div class='gallery'><a target='_blank' href='img_5terre.jpg'><img data-id="+ value['id']+" class='' src=" + value['absolute_url'] + "> </a>"+
                        "<button data-id="+ value['id']+" data-photo="+ value['absolute_url']+" class='btn deletePhoto btn-sm btn-danger ml-5'> Delete</button></div>"
                        ).appendTo('.showPhotos');

                        $('.deletePhoto').on('click',function (event) {
                            let id=$(this).data('id');
                            // console.log(id);
                            let photo=$(this).data('photo');

                            PhotoDelete(photo,id);

                            event.preventDefault();
                        })
                   
                });
            }else{
                toastr.error('Photo Load Faild');
            }

        }).catch(function(error){
            toastr.error('Photo Load Faild');
        })
    }

    $('#LoadMoreImage').on('click',function () {
           let loadMoreBtn=$(this);
           let FirstImgID= $(this).closest('div').find('img').data('id');
           LoadByID(FirstImgID,loadMoreBtn);
        })



    $('#addNewPhotoBtnId').click(function(){
        $('#PhotoModal').modal('show');
    })


    var  ImgID=0;
        function LoadByID(FirstImgID,loadMoreBtn){
            ImgID=ImgID+10;
            let PhotoID=ImgID+FirstImgID;
            let URL="/getImages/"+PhotoID

             loadMoreBtn.html("<div class='spinner-border spinner-border-sm' role='status'></div>")
             axios.get(URL).then(function (response) {
                 loadMoreBtn.html("Load More");
                $.each(response.data, function(i, value) {
                    $("<div class='col-md-3 col-lg-4 col-12 p-1'>").html(
                        "<div class='gallery'><a target='_blank' href='img_5terre.jpg'><img data-id="+ value['id']+" class='' src=" + value['absolute_url'] + "> </a>"+
                        "<button data-id="+ value['id']+" data-photo="+ value['absolute_url']+" class='btn deletePhoto btn-sm btn-danger ml-5'> Delete</button></div>"
                    ).appendTo('.showPhotos');
                });

                $('.deletePhoto').on('click',function (event) {
                    let id=$(this).data('id');
                    // console.log(id);
                    let photo=$(this).data('photo');
                    // console.log('data=',photo);

                    PhotoDelete(photo,id);

                    event.preventDefault();
                })

            }).catch(function (error) {

            })

        }

        // multiple image pick using haruncpi filemanger

            var imgArray=[];
            window.myBulkSelectCallback = function (data) {
            // the JSON data will come here
            // console.log(data);
            data.map(d=>imgArray.push(d.absolute_url))
            };
            console.log(imgArray);


    function PhotoDelete(image, id){
        let url ='/image-delete';
        let formData=new FormData();
        formData.append('path',image);
        formData.append('id',id);
        axios.post(url,{id:id,path:image}).then(function(response){
            if(response.status==200 && response.data==1){
                // loadPhoto();
                toastr.success('Image Delete Success');
                window.location.href="/upload-images";
            }
            else{
                toastr.error('Delete Fail Try Again');
            }

        }).catch(function(error){
            toastr.error('Something went wrong');
        })

       }
   
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
   });
  
  $(function() {
    // Multiple images preview with JavaScript
    var multiImgPreview = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var htm = '<div class="col-sm-4 col-md-4"><img class="img-fluid" src='+event.target.result+'></div>'
                    $('#preview-image').append(htm);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    $('#images').on('change', function() {
        multiImgPreview(this, 'div.preview-image');
    });
  }); 
  
  
   $('#multiple-image-upload-preview-ajax').submit(function(e) {
     e.preventDefault();
      var formData = new FormData(this);
      let TotalImages = $('#images')[0].files.length; //Total Images
      let images = $('#images')[0];
      for (let i = 0; i < TotalImages; i++) {
          formData.append('images' + i, images.files[i]);
      }
      formData.append('TotalImages', TotalImages);
  
     $.ajax({
        type:'POST',
        url: "{{ url('upload-images-ajax')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
           this.reset();
           $('#PhotoModal').modal('hide');
        window.location.href="/upload-images";
        toastr.success('Photo Upload Success');
           $('.preview-image').html("")
        },
        error: function(data){
           $('#PhotoModal').modal('hide');
           console.log(data);
           toastr.error('Photo Upload Faild');
         }
       });

   });
});


</script>
@endsection
