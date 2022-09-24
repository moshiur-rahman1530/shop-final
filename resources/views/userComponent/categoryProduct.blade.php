<?php
  use App\Models\Product;
?>
<div class="container-fluid pt-4">
  <h4 class="mb-3">Categories</h4>
        <div class="row px-xl-1 pb-3">

          @if($category)

          @php $categorys = $category->take(9); @endphp
          @foreach($categorys as $dt)
          @php
            $productCategoryCount = App\Models\Product::CountCategory($dt->id)
          @endphp
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4 h-100" style="padding: 30px;">
                    <p class="text-right">{{$productCategoryCount}} Products</p>
                    <a href="{{url('/categoryPage/'.$dt->id)}}" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="{{$dt->cat_img}}" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">{{$dt->cat_name}}</h5>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
