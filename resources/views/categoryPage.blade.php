@extends('layouts.app2')
@section('socialIcon')
    @include('layouts.socialhome')
@endsection

@section('content')

<div class="container my-5">
    <div class="mb-5">
      <h1 class="text-center">Category Name: <span style="background-color:#C17A74" class="p-1 rounded">{{$catName->cat_name}}</span></h1>
    </div>
<div class="row">
  @foreach($product as $item)

    <div class="col-md-3 col-sm-12">


      <div class="card product-item border-0 mb-4 h-100">
          <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">

          @php $imageData = json_decode($item->product_img);  @endphp
              <img class="img-fluid w-100" src="{{$imageData[0]}}" alt="">
          </div>
          <div class="card-body border-left border-right px-2 pt-4 pb-3">
              <h6 class="text-truncate mb-3">{{$item->product_name}}</h6>
              <p class="card-text">

                {{Str::limit($item->product_des, 50, $end='.......')}}

              </p>
              <div class="d-flex justify-content-center">

              @if($item->attributes->first())
              <h6>${{$item->attributes->first()->product_price}}</h6><h6 class="text-muted ml-2"><del>${{$item->attributes->first()->product_price+$item->attributes->first()->discount}}</del></h6>
              @else
              <h6>0</h6><h6 class="text-muted ml-2"><del>0</del></h6>
              @endif
                  
              </div>
          </div>
          <div class="card-footer d-flex justify-content-between bg-light border">
              <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
              <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
          </div>
      </div>

    </div>

  @endforeach
</div>

</div>

@endsection
