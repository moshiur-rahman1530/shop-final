@extends('admin.layouts.app')
@section('title','Details Users')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid bg-light mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 160px">
          <h1 class="font-weight-semi-bold text-uppercase mb-3">Active Users Page</h1>
          <div class="d-inline-flex">
              <p class="m-0"><a href="{{url('/admin/home')}}">Home</a></p>
              <p class="m-0 px-2">-</p>
              <p class="m-0"><a href="{{url('/admin/users')}}">Users</a></p>
              <p class="m-0 px-2">-</p>
              <p class="m-0">Active Users</p>
          </div>
      </div>
  </div>
  <!-- Page Header End -->
<div class="container">

    <div class="table-responsive">
        <table id="activeUser" class="table table-striped table-sm table-bordered">
            <thead>
            <tr>
                <th class="th-sm">NO</th>
                <th class="th-sm">Name</th>
                <th class="th-sm">Email</th>
                <th class="th-sm">Phone</th>
                <th class="th-sm">Login Status</th>
                <th class="th-sm">Photo</th>
                <th class="th-sm">Shipping</th>
                <th class="th-sm">User Type</th>
                <th class="th-sm">Last Seen</th>
                <th class="th-sm">Action</th>
            </tr>
            </thead>
            <tbody id="visitor_table">
            @foreach($results as $result)
            <tr>
                    <td>{{$result->id}}</td>
                    <td>{{$result->name}}</td>
                    <td>{{$result->email}}</td>
                    <td>{{$result->phone}}</td>

                    <td>
                        @if(Cache::has('is_online' . $result->id))
                            <span class="text-success">Online</span>
                        @else
                            <span class="text-secondary">Offline</span>
                        @endif
                    </td>

                    <td><img src="{{$result->image}}" class="img-fluid" alt="..."></td>
                    <td>{{$result->shippingArea}}</td>
                    <td>{{$result->is_admin}}</td>
                    <td>{{$result->last_seen}}</td>
                    @if(Auth::user()->id==$result->id)
                    <td class="d-flex justify-content-center align-items-center">
                        <p style="width:10px; height:10px; background-color: green; border-radius:50%;"></p><p class="ml-2">online</p>
                    </td>
                    @else
                    <td class="d-flex justify-content-between px-2 px-md-4"><a class='UserPhone'><i class='fas fa-phone text-success' style='font-size: 20px'></i><a class='UserMessage'><i class="fab fa-rocketchat text-info" style='font-size: 20px'></i></td>
                    @endif
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>





@endsection
@section('script')
 <script type="text/javascript">

$('#activeUser').DataTable({"order":false});
$('.dataTables_length').addClass('bs-select');
 </script>
@endsection
