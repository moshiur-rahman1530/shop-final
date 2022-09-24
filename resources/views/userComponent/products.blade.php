<?php
use App\Models\Rating;
 ?>
<div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">

            
        
          @foreach($allProduct as $products)

        
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
               
                    <div class="card-header product-img home-product-discount-label-photo position-relative overflow-hidden bg-transparent border p-0">
                    <span class="home-product-discount-label text-white badge bg-danger p-2 rounded">${{$products->attributes->first()->discount}} off</span>
                    @php $imageData = json_decode($products->product_img);  @endphp
                        <img class="img-fluid w-100" src="{{$imageData[0]}}" alt="">
                        
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{$products->product_name}}</h6>
                        <div class="ratings mb-2">
                                @if(count($products->ratings)>0)
                                    @foreach($products->ratings as $rat)
                                        @php
                                            $av = round($rat->avg('star_rating'),2);
                                            $coutcarttotal = App\Models\Rating::ratAvg($rat->product_id);
                                        @endphp
                                    @endforeach
                                        @for($i = 1; $i <= 5; $i++)
                                                @if($coutcarttotal < $i)
                                                    @if (round($coutcarttotal) == $i)
                                                        <li class="list-inline-item me-0 small" style="font-size:12px; padding:0px!important; margin:0px!important;"><i
                                                                class="fas fa-star-half-alt text-warning"></i></li>
                                                        @continue
                                                    @endif
                                                    <li class="list-inline-item me-0 small" style="font-size:12px; padding:0px!important; margin:0px!important;"><i
                                                            class="far fa-star text-warning"></i></li>
                                                    @continue
                                                @endif
                                                <li class="list-inline-item me-0 small" style="font-size:12px; padding:0px!important; margin:0px!important;"><i
                                                        class="fas fa-star text-warning"></i></li>
                                            @endfor

                                    ({{ count($products->ratings) }})

                                @endif
                        </div>

                        @if($products->attributes->first())
                        <div class="d-flex justify-content-center">
                            <h6>${{$products->attributes->first()->product_price}}</h6><h6 class="text-muted ml-2"><del>${{$products->attributes->first()->product_price+$products->attributes->first()->discount}}</del></h6>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer d-flex justify-content-center bg-light border">
                        
                        <div class="b-cart">
                        <a href="{{url('/detailsProduct/'.$products->id)}}" data-id="{{$products->id}}" class="btn btn-sm text-dark p-0"><i class="addToCartBtn fas fa-shopping-cart text-primary mr-1"></i> ADD TO CART</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            
        </div>
    </div>







    