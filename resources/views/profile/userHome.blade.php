@extends('profile.layouts.index')
@section('socialIcon')
    <div class="ssicon">
    {!! $socialShare !!}   
    </div>
@endsection
@section('content')

        <div class="container-fluid bg-secondary ">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                <h1 class="font-weight-semi-bold text-uppercase">My account</h1>
                <div class="d-inline-flex">
                    <p class="m-0"><a href="{{url('/')}}">Home</a></p>
                    <p class="m-0 px-2">-</p>
                    <p class="m-0">My Profile</p>
                </div>
            </div>
        </div>

 @include('profile.welcome')

@endsection