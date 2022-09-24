@extends('admin.layouts.app')
@section('title','Details Users')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid bg-light mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 160px">
          <h1 class="font-weight-semi-bold text-uppercase mb-3">Details Users Page</h1>
          <div class="d-inline-flex">
              <p class="m-0"><a href="{{url('/admin/home')}}">Home</a></p>
              <p class="m-0 px-2">-</p>
              <p class="m-0"><a href="{{url('/admin/users')}}">Users</a></p>
              <p class="m-0 px-2">-</p>
              <p class="m-0">Details Users</p>
          </div>
      </div>
  </div>
  <!-- Page Header End -->

<div class="usercard ml-3 pb-2 rounded">
  <img src="{{$result->image}}" alt="John" style="width:100%">
  <h1>{{$result->name}}</h1>
  <p class="usertitle">{{$result->phone}}</p>
  <p class="usertitle">{{$result->email}}</p>
  <p class="usertitle">{{$result->shippingArea}}</p>
</div>




@endsection
@section('script')
 <script type="text/javascript">


 </script>
@endsection
