@php 
  $feature= DB::table('settings')->first();
@endphp

<div class="container-fluid pt-5">
       <div class="row px-xl-5 pb-3">
           <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
               <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                   <h1 class="{{$feature->icon1}} text-primary m-0 mr-3"></h1>
                   <h5 class="font-weight-semi-bold m-0">{{$feature->feature1}}</h5>
               </div>
           </div>
           <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
               <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                   <h1 class="{{$feature->icon2}} text-primary m-0 mr-2"></h1>
                   <h5 class="font-weight-semi-bold m-0">{{$feature->feature2}}</h5>
               </div>
           </div>
           <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
               <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                   <h1 class="{{$feature->icon3}} text-primary m-0 mr-3"></h1>
                   <h5 class="font-weight-semi-bold m-0">{{$feature->feature3}}</h5>
               </div>
           </div>
           <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
               <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                   <h1 class="{{$feature->icon4}} text-primary m-0 mr-3"></h1>
                   <h5 class="font-weight-semi-bold m-0">{{$feature->feature4}}</h5>
               </div>
           </div>
       </div>
   </div>
