@extends('admin.layouts.app')
@section('title','Details Visitor')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid bg-light mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 160px">
          <h1 class="font-weight-semi-bold text-uppercase mb-3">Details Visitor Page</h1>
          <div class="d-inline-flex">
              <p class="m-0"><a href="{{url('/admin/home')}}">Home</a></p>
              <p class="m-0 px-2">-</p>
              <p class="m-0"><a href="{{url('/visitor')}}">Visitor</a></p>
              <p class="m-0 px-2">-</p>
              <p class="m-0">Details Visitor</p>
          </div>
      </div>
  </div>
  <!-- Page Header End -->


<h1>this is details visitor {{$result->id}}</h1>



<h4>Ip Address: {{$result->ip_address}}</h4>
<h4>Visit Time: {{$result->visit_time}}</h4>




@endsection
@section('script')
 <script type="text/javascript">


 </script>
@endsection
