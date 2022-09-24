@extends('layouts.app2')
@section('socialIcon')
    @include('layouts.socialhome')
@endsection

@section('content')

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    @if (session()->has('success'))
        <div class="alert alert-dismissable alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>
                {!! session()->get('success') !!}
            </strong>
        </div>
    @endif


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                    

                    <div class="wrapper">
      <header>
      </header>
      <div class="price-input">
        <div class="field">
          <span>Min</span>
          <input type="number" class="input-min" value="0">
        </div>
        <div class="separator">-</div>
        <div class="field">
          <span>Max</span>
          <input type="number" class="input-max" value="3000">
        </div>
      </div>
      <div class="slider">
        <div class="progress"></div>
      </div>
      <div class="range-input">
        <input type="range" class="range-min" min="0" max="10000" value="0" step="100">
        <input type="range" class="range-max" min="0" max="10000" value="3000" step="100">
      </div>
    </div>


                    <!-- price range slider end -->
                </div>
                <!-- Price End -->

                <!-- category start-->

              

                <!-- category end -->
                
                <!-- Color Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                    
                        @foreach($colors as $color)
                        <div class="mb-3">

                        @php
                        $checked=[];
                        if(isset($_GET['color'])){
                            $checked=$_GET['color'];
                        }
                        @endphp
                            <div class="form-check">
                            <input class="form-check-input colorvalue" name="color[]" type="checkbox" value="{{$color->id}}" id="{{$color->id}}" @if (isset($_GET['color']) && $_GET['color']==$color->id) checked @endif>
                            <label class="form-check-label" for="{{$color->id}}">
                            {{$color->color}}
                            </label>
                            </div>
                        </div>
                        @endforeach
                        
                    <!-- </form> -->
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <div class="mb-5 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                    
                       @foreach($sizes as $size)

                        <div class="form-check">
                        <input class="form-check-input sizevalue" name="size[]" type="checkbox" value="{{$size->id}}" id="{{$size->id}}" @if (isset($_GET['size']) && $_GET['size']==$size->id) checked @endif>
                        <label class="form-check-label" for="{{$size->id}}">
                        {{$size->size}}
                        </label>
                        </div>
                       @endforeach
                        
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->

          
            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            
                                <div class="input-group">
                                    <input type="text" name="seatch_text" id="seatch_text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <h5 id="serchresulr"></h5>
                            

                            <div class="gridToList d-flex">
                            <button class="gridProduct mx-2"><i class="fas fa-border-all"></i></button>
                            <button class="listProduct mx-2"><i class="fas fa-list"></i></button>
                            </div>

                            
                            <div class="dropdown ml-4">

                                <select name="sortBy" id="sortBy" class="form-select btn border">
                                    <option selected>Sort By product</option>
                                    <option value="Popularity">Short by Popularity</option>
                                    <option value="Newest">Short by Newest</option>
                                    <option value="Sales">Short by Sales</option>
                                    <option value="LowToHigh">Short Price Low to High</option>
                                    <option value="HighToLow">Short Price High to Low</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="filterAllProduct row container" id="filterAllProduct">
                    @if($productss)
                  
                    @forelse($productss as $product)
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1 removeClass" id="removeClass">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                @php 
                                $decodeImg = json_decode($product->product_img);
                                
                                @endphp
                                @if($product->qtn<=0)
                                <div class="type-lb">
                                 <p class="sale">Outs of Stock</p>
                                </div>
                                @endif
                                <img class="img-fluid w-100" src="{{$decodeImg[0]}}" alt="">
                            </div>
                           
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{$product->product_name}}</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>{{$product->product_price}}</h6><h6 class="text-muted ml-2"><del>{{$product->product_price+$product->discount}}</del></h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                
                                @if($product->qtn>0)
                                <a href="{{url('/detailsProduct/'.$product->product_id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                <a href="{{url('/detailsProduct/'.$product->product_id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                @else
                                <a href="{{url('/detailsProduct/'.$product->product_id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                     <p class="text-center p-5 display-5">No Product Found</p>
                    @endforelse
                    @endif
                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                          <ul class="pagination justify-content-center mb-3">
                            
                            {{ $productss->links() }}

                          </ul>
                        </nav>
                    </div>
                    </div>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function(){

// grid to list

$('.gridProduct').on('click',function(e) {
        $('.removeClass').removeClass('col-12').addClass('col-lg-4 col-md-6 col-sm-12');
    
});

$('.listProduct').on('click',function(e) {
        $('.removeClass').removeClass('col-lg-4 col-md-6 col-sm-12').addClass('col-12');
    
});

// grid to list end

// color filter

$('.colorFilter').click(function(){
    


})
var colors = [];

$('input[name="color[]"]').on('change', function (e) {

    e.preventDefault();
    colors = []; // reset 
    var sizesColor = [];
    var sortVal = $("#sortBy").val();
    var minPriceval = $(".input-min").val();

    var maxPriceval = $(".input-max").val();

    $('input[name="color[]"]:checked').each(function()
    {
        colors.push(parseInt($(this).val()));
    });
    $(".sizevalue:checked").each(function() {  
        sizesColor.push(parseInt($(this).val()));
        }); 

        console.log(colors,sizesColor);

        axios.post("/colorFilter",{color_id:colors,size_id:sizesColor,min:minPriceval,max:maxPriceval,sortVal:sortVal}).then(function(response){
            console.log(response.data);
            var jsonData = response.data;

            $('.filterAllProduct').html('');
           $('.pagination').html('');
           
           if (jsonData.length==0) {
            $('<div class="col-lg-4 col-md-6 col-sm-12 pb-1 removeClass" id="removeClass">').html(
                   "<div class='mainbox'><div class='err'>4</div><i class='far fa-question-circle fa-spin'></i><div class='err2'>4</div><div class='msg'>Nothing Found <p>Let's go <a href='#'>home</a> and try from there.</p></div></div>").appendTo('.filterAllProduct');
           }

           $.each(jsonData, function(i, item){
           // $.each(jsonData.data, function(i, item){
           var jsonImg = JSON.parse(item.product_img);
               // console.log(item);
               $('<div class="col-lg-4 col-md-6 col-sm-12 pb-1 removeClass" id="removeClass">').html(
                   "<div class='card product-item border-0 mb-4'><div class='card-header product-img position-relative overflow-hidden bg-transparent border p-0'><img class='img-fluid w-100' src="+jsonImg[0]+" alt='></div><div class='card-body border-left border-right text-center p-0 pt-4 pb-3'><h6 class='text-truncate mb-3'>"+item.product_name+"</h6><div class='d-flex justify-content-center'><h6>"+item.product_price+"</h6><h6 class='text-muted ml-2'><del>"+item.product_price+"</del></h6></div></div><div class='card-footer d-flex justify-content-between bg-light border'><a href=' class='btn btn-sm text-dark p-0'><i class='fas fa-eye text-primary mr-1'></i>View Detail</a><a href='/detailsProduct/"+item.product_id+"' class='btn btn-sm text-dark p-0'><i class='fas fa-shopping-cart text-primary mr-1'></i>Add To Cart</a></div></div>"
               ).appendTo('.filterAllProduct');

           });
            
        }).catch(function(error){

        })

});  



// color filter
// size filter



$('input[name="size[]"]').on('change', function (e) {

    e.preventDefault();
    sizes = []; // reset 
    color = []; // reset 
    var sortVal = $("#sortBy").val();
    var minPriceval = $(".input-min").val();

    var maxPriceval = $(".input-max").val();

    $('input[name="size[]"]:checked').each(function()
    {
        sizes.push(parseInt($(this).val()));
    });
    $(".colorvalue:checked").each(function() {  
        color.push(parseInt($(this).val()));
        }); 

        axios.post("/sizeFilter",{color_id:color,size_id:sizes,min:minPriceval,max:maxPriceval,sortVal:sortVal}).then(function(response){
            console.log(response.data);
            var jsonData = response.data;

            $('.filterAllProduct').html('');
           $('.pagination').html('');
           
           if (jsonData.length==0) {
            $('<div class="col-lg-4 col-md-6 col-sm-12 pb-1 removeClass" id="removeClass">').html(
                   "<div class='mainbox'><div class='err'>4</div><i class='far fa-question-circle fa-spin'></i><div class='err2'>4</div><div class='msg'>Nothing Found <p>Let's go <a href='#'>home</a> and try from there.</p></div></div>").appendTo('.filterAllProduct');
           }

           $.each(jsonData, function(i, item){
           var jsonImg = JSON.parse(item.product_img);
               // console.log(item);
               $('<div class="col-lg-4 col-md-6 col-sm-12 pb-1 removeClass" id="removeClass">').html(
                   "<div class='card product-item border-0 mb-4'><div class='card-header product-img position-relative overflow-hidden bg-transparent border p-0'><img class='img-fluid w-100' src="+jsonImg[0]+" alt='></div><div class='card-body border-left border-right text-center p-0 pt-4 pb-3'><h6 class='text-truncate mb-3'>"+item.product_name+"</h6><div class='d-flex justify-content-center'><h6>"+item.product_price+"</h6><h6 class='text-muted ml-2'><del>"+item.product_price+"</del></h6></div></div><div class='card-footer d-flex justify-content-between bg-light border'><a href=' class='btn btn-sm text-dark p-0'><i class='fas fa-eye text-primary mr-1'></i>View Detail</a><a href='/detailsProduct/"+item.product_id+"' class='btn btn-sm text-dark p-0'><i class='fas fa-shopping-cart text-primary mr-1'></i>Add To Cart</a></div></div>"
               ).appendTo('.filterAllProduct');

           });
            
        }).catch(function(error){

        })
 
}); 

// size filter

// price range script start


const rangeInput = document.querySelectorAll(".range-input input"),
priceInput = document.querySelectorAll(".price-input input"),
range = document.querySelector(".slider .progress");
let priceGap = 1000;
priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);
        
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});
rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);
        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});

// price range script end
$(".range-input input").on('change', function(e){
    var sortVal = $("#sortBy").val();
    var minPriceval = $(".input-min").val();

    var maxPriceval = $(".input-max").val();

        console.log(minPriceval,maxPriceval);
        axios.post("/filterPriceData",{sortVal:sortVal,min:minPriceval,max:maxPriceval}).then(function(response){
           
           var jsonData = response.data;
           console.log(jsonData);
           $('.filterAllProduct').html('');
           $('.pagination').html('');
           
           if (jsonData.length==0) {
            $('<div class="col-lg-4 col-md-6 col-sm-12 pb-1 removeClass" id="removeClass">').html(
                   "<div class='mainbox'><div class='err'>4</div><i class='far fa-question-circle fa-spin'></i><div class='err2'>4</div><div class='msg'>Nothing Found <p>Let's go <a href='#'>home</a> and try from there.</p></div></div>").appendTo('.filterAllProduct');
           }

           $.each(jsonData, function(i, item){
           var jsonImg = JSON.parse(item.product_img);
               // console.log(item);
               $('<div class="col-lg-4 col-md-6 col-sm-12 pb-1 removeClass" id="removeClass">').html(
                   "<div class='card product-item border-0 mb-4'><div class='card-header product-img position-relative overflow-hidden bg-transparent border p-0'><img class='img-fluid w-100' src="+jsonImg[0]+" alt='></div><div class='card-body border-left border-right text-center p-0 pt-4 pb-3'><h6 class='text-truncate mb-3'>"+item.product_name+"</h6><div class='d-flex justify-content-center'><h6>"+item.product_price+"</h6><h6 class='text-muted ml-2'><del>"+item.product_price+"</del></h6></div></div><div class='card-footer d-flex justify-content-between bg-light border'><a href=' class='btn btn-sm text-dark p-0'><i class='fas fa-eye text-primary mr-1'></i>View Detail</a><a href='/detailsProduct/"+item.product_id+"' class='btn btn-sm text-dark p-0'><i class='fas fa-shopping-cart text-primary mr-1'></i>Add To Cart</a></div></div>"
               ).appendTo('.filterAllProduct');

           });
        }).catch(function(error){

    })
});



    $("#sortBy").on('change', function(e){
        
        var sortVal = $("#sortBy").val();
        var minPriceval = $(".input-min").val();
        var maxPriceval = $(".input-max").val();
        console.log(minPriceval,maxPriceval);

        axios.post("/filterdata",{sortVal:sortVal,min:minPriceval,max:maxPriceval}).then(function(response){
           
            var jsonData = response.data;
            console.log(jsonData);
            $('.filterAllProduct').html('');
            $('.pagination').html('');
            
            if (jsonData.length==0) {
            $('<div class="col-lg-4 col-md-6 col-sm-12 pb-1 removeClass" id="removeClass">').html(
                   "<div class='mainbox'><div class='err'>4</div><i class='far fa-question-circle fa-spin'></i><div class='err2'>4</div><div class='msg'>Nothing Found <p>Let's go <a href='#'>home</a> and try from there.</p></div></div>"
               ).appendTo('.filterAllProduct');
           }

            $.each(jsonData, function(i, item){
            var jsonImg = JSON.parse(item.product_img);
                // console.log(item);
                $('<div class="col-lg-4 col-md-6 col-sm-12 pb-1 removeClass" id="removeClass">').html(
                    "<div class='card product-item border-0 mb-4'><div class='card-header product-img position-relative overflow-hidden bg-transparent border p-0'><img class='img-fluid w-100' src="+jsonImg[0]+" alt='></div><div class='card-body border-left border-right text-center p-0 pt-4 pb-3'><h6 class='text-truncate mb-3'>"+item.product_name+"</h6><div class='d-flex justify-content-center'><h6>"+item.product_price+"</h6><h6 class='text-muted ml-2'><del>"+item.product_price+"</del></h6></div></div><div class='card-footer d-flex justify-content-between bg-light border'><a href=' class='btn btn-sm text-dark p-0'><i class='fas fa-eye text-primary mr-1'></i>View Detail</a><a href='/detailsProduct/"+item.product_id+"' class='btn btn-sm text-dark p-0'><i class='fas fa-shopping-cart text-primary mr-1'></i>Add To Cart</a></div></div>"
                ).appendTo('.filterAllProduct');

            });

            
        }).catch(function(error){

        })

    });
    $("#sort").on('change', function(e){
        e.preventDefault();
        this.form.submit();
        
    });


    $(".priceRange").on('change', function(e){
        e.preventDefault();
        this.form.submit();
    });


    $(".size").on('change', function(e){
        e.preventDefault();
        this.form.submit();
    });
});


</script>
@endsection
