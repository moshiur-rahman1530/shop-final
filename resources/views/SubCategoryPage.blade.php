@extends('layouts.app2')
@section('socialIcon')
    @include('layouts.socialhome')
@endsection

@section('content')

<div class="container my-5">
    <div class="mb-5">
      <h1 class="text-center">Category Name: <span style="background-color:#C17A74" class="p-1 rounded">{{$catName->cat_name}}</span></h1>

      <h4 class="text-center mt-5">Sub Category Name: <span style="background-color:#C17A74" class="p-1 rounded">{{$subcatname->name}}</span></h4>
    </div>
<div class="row">
  @foreach($product as $item)

    <div class="col-md-4 col-sm-12">


      <div class="card product-item border-0 mb-4">
          <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
              <img class="img-fluid w-100" src="{{$item->product_img}}" alt="">
          </div>
          <div class="card-body border-left border-right p-0 pt-4 pb-3">
              <h6 class="text-truncate mb-3">{{$item->product_name}}</h6>
              <p class="card-text">

                {{Str::limit($item->product_des, 50, $end='.......')}}

              </p>
              <div class="d-flex justify-content-center">
                  <h6>${{$item->product_price}}</h6>
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
