@extends('profile.layouts.index')
@section('socialIcon')
    <div class="ssicon">
    {!! $socialShare !!}   
    </div>
@endsection
@section('content')

       <div class="container-fluid bg-secondary">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
                <h1 class="font-weight-semi-bold text-uppercase">My account</h1>
                <div class="d-inline-flex">
                    <p class="m-0"><a href="{{url('/')}}">Home</a></p>
                    <p class="m-0 px-2">-</p>
                    <p class="m-0">My Account</p>
                </div>
            </div>
        </div>


            <div class="container">
                <div class="row my-3">
                        <div class="col-md-6 col-xl-4 p-2">
                          <div class="card text-white o-hidden h-100 text-center" style="background-color: #30e379">
                            <div class="card-body">
                                <div class="card-body-icon mb-1">
                                <i class="fab fa-first-order text-danger fa-3x"></i>
                                </div>
                                @php 
                                $totalOrder = count(App\Models\Order::where('name',Auth::user()->name)->where('email',Auth::user()->email)->where('phone',Auth::user()->phone)->get());
                                @endphp
                                <div class="mb-0"><h4>Total Orders</h4><h4>({{$totalOrder}})</h4> </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="{{url('/userdashboard/order')}}">
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
                                <i class="fas fa-fw fa-bell text-warning fa-3x"></i>
                                </div>
                                <div class="mb-0"><h4>Total Notifications</h4><h4>({{count(Auth::user()->unreadNotifications)}})</h4> </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="{{url('/usernotifications')}}">
                                <span class="float-left">View details</span>
                                <span class="float-right">
                                <i class="fas fa-angle-right fa-lg"></i>
                                </span>
                            </a>
                        </div>
                    </div>


                    <div class="col-md-6 col-xl-4 p-2">
                        <div class="card text-white o-hidden h-100 text-center" style="background-color: #0866C6">
                            <div class="card-body">
                                <div class="card-body-icon mb-1">
                                <i class="fas fa-tools fa-3x text-secondary"></i>
                                </div>
                                <div class="mb-0"><h4>Settings</h4></div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="{{url('getpassword')}}">
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