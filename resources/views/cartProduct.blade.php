<?php

use App\Models\Size;
use App\Models\Color;
 ?>
@extends('layouts.app2')
@section('socialIcon')
    @include('layouts.socialhome')
@endsection

@section('content')

<!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">


            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    @foreach(json_decode($detailsProduct->product_img) as $key=>$img)
                        <li data-target="#product-carousel" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
                    @endforeach

                    </ol>
                    <div class="carousel-inner">

                    @foreach(json_decode($detailsProduct->product_img) as $key=>$img)
                            <div class="carousel-item {{(($key==0)? 'active' : '')}}" style="height: 410px;">
                                <img class="img-fluid" src="{{$img}}" alt="Image">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>
                    <div class="col-lg-7 pb-5">
                        <h3 class="font-weight-semi-bold">{{$detailsProduct->product_name}}</h3>
                        <div class="d-flex mb-3">
                            <div class="text-primary mr-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star-half-alt"></small>
                                <small class="far fa-star"></small>
                            </div>
                            <small class="pt-1">(50 Reviews)</small>
                        </div>

                        @php 
                        $attr =$detailsProduct->attributes;
                        @endphp
                        @foreach($attr as $size)
                          @php
                          $sizeName = App\Models\Size::SizeName($size->size_id);
                          $priceid= $sizeName->id;
                          $pricedata = $size->where('size_id',$priceid)->first();
                        
                          @endphp

                          @endforeach
                        
                        <h3 class="font-weight-semi-bold mb-4"><span>{{$pricedata ->product_price}}</span> TK</h3>
                        <p class="mb-4">{{$detailsProduct->product_des}}</p>


                        <div class="d-flex mb-3">
                            <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>

                          
                          @php
                           
                           $attr =$detailsProduct->attributes;
                           $attr=$attr->unique("size_id");
                          @endphp
                          @foreach($attr as $size)
                          @php
                          $sizeName = App\Models\Size::SizeName($size->size_id);
                          $priceid= $sizeName->id;
                          $pricedata = $size->where('size_id',$priceid)->first();
                        
                          @endphp
                          <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input productSizeId" data-id={{$size}} id="{{$sizeName->name}}" name="size" checked>
                              <label class="custom-control-label" for="{{$sizeName->name}}">{{$sizeName->name}}</label>
                          </div>
                          @endforeach
                        </div>

                        <div class="d-flex mb-4">
                            <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                                @php
                                $attr =$detailsProduct->attributes;
                                $attr=$attr->unique("color_id");
                                $colors=explode(',',$detailsProduct->color_id);
                                @endphp
                                @foreach($attr as $color)
                                @php
                                $colorName = App\Models\Color::findColor($color->color_id);
                                
                                @endphp
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input productColorId" data-id={{$color}} id="{{$colorName->name}}" name="color" checked>
                                        <label class="custom-control-label" for="{{$colorName->name}}">{{$colorName->name}}</label>
                                    </div>
                                 @endforeach
                        </div>

                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="number" id="CartValue" class="form-control bg-secondary text-center" value="1" max="5" min="1" readonly>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <button data-id="{{$detailsProduct->id}}" class="btn addToCartBtn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                        </div>
                        <div class="d-flex pt-2">
                            <p class="text-dark font-weight-medium mb-0 mr-2 d-flex align-items-center">Share on:</p>
                            <div class="social-btn-sp">
                               {!! $socialShare !!}
                           </div>
                        </div>
                    </div>

        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews ({{ count($detailsProduct->ratings) }})</a>

                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p>{{$detailsProduct->product_des}}</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Additional Information</h4>
                        <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                  </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                  </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                               <div class="row">
                                <div class="col-md-8">
                                    <h4 class="mb-4">{{count($detailsProduct->ratings)}} review for "Colorful Stylish Shirt"</h4>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-sm btn-danger px-3 py-1" onClick="history.go(0);"><i class="fas fa-sync-alt" style="color:white;font-size:18px"></i></button>
                                </div>
                                <div class="col-md-2">
                                   
                                </div>
                               </div>
                                @foreach($detailsProduct->ratings as $rat)
                                
                                <div class="media mb-4">
                                    <img src="https://png.pngtree.com/png-clipart/20210915/ourmid/pngtree-user-avatar-login-interface-abstract-blue-icon-png-image_3917504.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6>{{$rat->name}}<small> - <i>{{$rat->created_at}}</i></small></h6>
                                        <div class="text-primary mb-2">

                                        @for($i=1; $i<=$rat->star_rating; $i++) 
                                         <i class="fa fa-star text-warning"></i>
                                        @endfor
                                        </div>
                                        <p>{{$rat->comments}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-primary">
                                        <div class="rate">
                                        <input type="hidden" id="rateval"/>
                                            <input type="radio" id="star5" class="rate rating" name="rating" value="5"/>
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" checked id="star4" class="rate rating" name="rating" value="4"/>
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" class="rate rating" name="rating" value="3"/>
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" class="rate rating" name="rating" value="2">
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" class="rate rating" name="rating" value="1"/>
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea name="review" id="review-text" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Your Name *</label>
                                        <input name="name" type="text" class="form-control" id="review-name">
                                        <input name="product_id" type="hidden" class="form-control" value="{{$detailsProduct->id}}" id="product_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" name="email" class="form-control" id="review-email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" id="review-submit" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                            <div class="d-flex justify-content-center">
                                <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="img/product-2.jpg" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                            <div class="d-flex justify-content-center">
                                <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="img/product-3.jpg" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                            <div class="d-flex justify-content-center">
                                <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="img/product-4.jpg" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                            <div class="d-flex justify-content-center">
                                <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="img/product-5.jpg" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                            <div class="d-flex justify-content-center">
                                <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

@endsection

@section('script')
    <script type="text/javascript"> 

            $(function() { 
                // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    // save the latest tab; use cookies if you like 'em better:
                    localStorage.setItem('lastTab', $(this).attr('href'));
                });

                // go to the latest tab, if it exists:
                var lastTab = localStorage.getItem('lastTab');
                if (lastTab) {
                    $('[href="' + lastTab + '"]').tab('show');
                }
            });
           
          $('.rating').click(function(){
            console.log(this.value);
            $('#rateval').val(this.value);
          })

        $('#review-submit').click(function(){
            var name = $('#review-name').val();
            var email = $('#review-email').val();
            var review = $('#review-text').val();
            var ratting =  Number($('#rateval').val());
            var product_id = Number($('#product_id').val());
            console.log(typeof(product_id));
            axios.post('/review-store',
            {
                name:name,
                email:email,
                review:review,
                ratting:ratting,
                product_id:product_id,
            }).then(function(response){
                if (response.status==200) {
                    toastr.success('Review Added Successfully!!');
                }else{
                    toastr.error('Review Added failed!!');
                }
            }).catch(function(error){
                toastr.error('Something Went Wrong!!');
            })
        })

        $('.addToCartBtn').click(function(e){
          e.preventDefault();
          var id = $(this).data('id');
          var quantity = $('#CartValue').val();
          var size = $('.productSizeId').data('id');
          var color = $('.productColorId').data('id');
          console.log(id,quantity,size,color);
          axios.post('/addToCart',{
            id:id,
            quantity:quantity,
            size:size,
            color:color,
          }).then(function(response){

            if (response.status==200) {
              if (response.data==1) {
                  toastr.warning('Already Added To Your Cart!!');
                  <?php
              
                  $id=Auth::id();
                  $coutcarttotal = App\Models\Cart::TotalCart($id);
                  ?>
                  
              }else if(response.data==2){
                toastr.success('Added Product successfully!!');
                totalCountCart();
              }else{
                  toastr.error('Product added to cart fail!!');
                  totalCountCart();
              }
            }else{
              toastr.error('Product added to cart fail!!');
            }
          }).catch(function(error){
            toastr.error('Something Went Wrong!!');
          })
        })
    </script>
@endsection
