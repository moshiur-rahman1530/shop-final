@extends('profile.layouts.index')
@section('socialIcon')
    <div class="ssicon">
    {!! $socialShare !!}   
    </div>
@endsection
@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg mb-4" data-setbg="">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <div class="breadcrumb__option">
                        <a href="{{url('/')}}">Home</a> /
                        <a href="{{url('/userdashboard')}}">User Dashboard</a> /
                        <span>My Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<section class="shoping-cart spad mb-4">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-responsive-sm" id="userOrderTable">
                <thead>
                      <tr>
                        <th scope="col">Transaction id</th>
                        <th scope="col">Payment Type</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $item)
                      <tr>
                        <td>{{ $item->transaction_id }}</td>
                        <td>{{ $item->payment_type }}</td>
                        <td>{{ $item->subTotal }} TK</td>
                        <td>{{ $item->amount }} TK</td>
                        <td>
                            <input type="button" data-id="{{$item->id}}" value="View" class="orderViewBtn">
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
      </div>
</div>
</section>
@endsection

@section('script')

<script>


    $(document).ready(function () {
        $('#userOrderTable').DataTable();


        $('.orderViewBtn').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var url = "/userdashboard/orderDetails/"+id+"";
            // alert(url);
            window.location = "/userdashboard/orderDetails/"+id+"";
        })
    });

</script>

@endsection