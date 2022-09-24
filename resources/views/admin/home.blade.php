@extends('admin.layouts.app')

@section('title','Home')
@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-light">
      <div class="d-flex flex-column align-items-center justify-content-start" style="min-height: 20px">
          <div class="d-inline-flex">
            @php
            $st = App\Models\Settings::first();
            @endphp
              <p class="m-0"><a href="{{url('/admin/home')}}">{{$st->title_first_letter}}{{$st->title_remain}}</a></p>
              <p class="m-0 px-2">-</p>
              <p class="m-0">Dashboard</p>
          </div>
      </div>
  </div>
  <!-- Page Header End -->

    <div class="container">
        <div class="row mb-4 mt-2 g-4">

            <div class="col-md-6 col-xl-4 p-2">
                <div class="card text-white o-hidden h-100 text-center" style="background-color: #0866C6">
                    <div class="card-body">
                        <div class="card-body-icon mb-1">
                        <i class="fas fa-fw fa-globe fa-2x text-dark"></i>
                        </div>
                        @php 
                        $totalVisitor = count(App\Models\Visitor::all());
                        @endphp
                        <div class="mb-0"><h4>Total Visitors</h4><h4>({{$totalVisitor}})</h4> </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{url('/visitor')}}">
                        <span class="float-left">View details</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right fa-lg"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 p-2">
                <div class="card text-white o-hidden h-100 text-center" style="background-color: #5B93D3">
                    <div class="card-body">
                        <div class="card-body-icon mb-1">
                        <i class="fab fa-first-order fa-2x text-dark"></i>
                        </div>
                        @php 
                        $totalOrder = count(App\Models\Order::all());
                        @endphp
                        <div class="mb-0"><h4>Total Orders</h4><h4>({{$totalOrder}})</h4> </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{url('allOrders')}}">
                        <span class="float-left">View details</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right fa-lg"></i>
                        </span>
                    </a>
                </div>
            </div>


            <div class="col-md-6 col-xl-4 p-2">
                <div class="card text-white bg-info o-hidden h-100 text-center">
                    <div class="card-body">
                        <div class="card-body-icon mb-1">
                        <i class="fas fa-fw fa-users fa-2x text-dark"></i>
                        </div>
                        @php 
                        $totalUser = count(App\Models\User::all());
                        @endphp
                        <div class="mb-0"><h4>Total Users</h4><h4>({{$totalUser}})</h4> </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{url('/admin/users')}}">
                        <span class="float-left">View details</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right fa-lg"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 p-2">
                <div class="card text-white o-hidden h-100 text-center" style="background-color: #6f42c1">
                    <div class="card-body">
                        <div class="card-body-icon mb-1">
                        <i class="fab fa-product-hunt fa-2x text-dark"></i>
                        </div>
                        @php 
                        $totalProduct = count(App\Models\Product::all());
                        @endphp
                        <div class="mb-0"><h4>Total Products</h4><h4>({{$totalProduct}})</h4> </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{url('/products')}}">
                        <span class="float-left">View details</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right fa-lg"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 p-2">
                <div class="card text-white o-hidden h-100 text-center" style="background-color: #816aab">
                    <div class="card-body">
                        <div class="card-body-icon mb-1">
                        <i class="fas fa-desktop fa-2x text-dark"></i>
                        </div>
                        @php 
                        $totalCategory = count(App\Models\Category::all());
                        @endphp
                        <div class="mb-0"><h4>Total Categories</h4><h4>({{$totalCategory}})</h4> </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{url('/category')}}">
                        <span class="float-left">View details</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right fa-lg"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 p-2">
                <div class="card text-white o-hidden h-100 text-center" style="background-color: #7f788b">
                    <div class="card-body">
                        <div class="card-body-icon mb-1">
                        <i class="fas fa-code-branch fa-2x text-dark"></i>
                        </div>
                        @php 
                        $totalSubCategory = count(App\Models\SubCategory::all());
                        @endphp
                        <div class="mb-0"><h4>Total Sub Categories</h4><h4>({{$totalSubCategory}})</h4> </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{url('/subcategory')}}">
                        <span class="float-left">View details</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right fa-lg"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 p-2">
                <div class="card text-white bg-success o-hidden h-100 text-center">
                    <div class="card-body">
                        <div class="card-body-icon mb-1">
                        <i class="fab fa-bandcamp fa-2x text-dark"></i>
                        </div>
                        @php 
                        $totalBrand = count(App\Models\Brand::all());
                        @endphp
                        <div class="mb-0"><h4>Total Brands</h4><h4>({{$totalBrand}})</h4> </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{url('/brands')}}">
                        <span class="float-left">View details</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right fa-lg"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 p-2">
                <div class="card text-white o-hidden h-100 text-center" style="background-color: #30e379">
                    <div class="card-body">
                        <div class="card-body-icon mb-1">
                        <i class="fas fa-sliders-h fa-2x text-dark"></i>
                        </div>
                        @php 
                        $totalBanner = count(App\Models\Banner::all());
                        @endphp
                        <div class="mb-0"><h4>Total Banners</h4><h4>({{$totalBanner}})</h4> </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{url('/banners')}}">
                        <span class="float-left">View details</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right fa-lg"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 p-2">
                <div class="card text-white o-hidden h-100 text-center" style="background-color: #0a5a2b">
                    <div class="card-body">
                        <div class="card-body-icon mb-1">
                        <i class="fas fa-tools fa-2x text-dark"></i>
                        </div>
                        <div class=""><h4>Settings</h4></div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{url('/settings')}}">
                        <span class="float-left">View details</span>
                        <span class="float-right">
                        <i class="fas fa-angle-right fa-lg"></i>
                        </span>
                    </a>
                </div>
            </div>


        </div>
    </div>

@endsection
@section('script')
@endsection