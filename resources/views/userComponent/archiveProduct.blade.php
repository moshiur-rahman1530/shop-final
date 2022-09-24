<!-- Products Start -->
   <div class="container-fluid pt-5">
       <div class="text-center mb-4">
           <h2 class="section-title px-5"><span class="px-2">Just Arrived</span></h2>
       </div>
       <div class="row px-xl-5 pb-3">
      
         @foreach($newArive as $newProduct)

         @php 
             
         @endphp
           <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
               <div class="card product-item border-0 mb-4">
                   <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <?php $imageData = json_decode($newProduct->product_img);  ?>
                       <img class="img-fluid w-100" src="{{$imageData[0]}}" alt="">
                   </div>
                   <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                       <h6 class="text-truncate mb-3">{{$newProduct->product_name}}</h6>
                        <p class="card-text">
                          {{Str::limit($newProduct->product_des, 40, $end='.......')}}
                        </p>
                       <div class="d-flex justify-content-center align-item-center">
                           <h6>${{$newProduct->attributes->first()->product_price}} <span class="text-white ml-3 badge bg-danger p-2 rounded">${{$newProduct->attributes->first()->discount}} off</span></h6>
                       </div>
                   </div>
                   <div class="card-footer d-flex justify-content-center bg-light border">
                       <a href="{{url('/detailsProduct/'.$newProduct->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                   </div>
               </div>
           </div>
           @endforeach
          
       </div>
   </div>
   <!-- Products End -->