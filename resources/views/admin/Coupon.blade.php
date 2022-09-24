@extends('admin.layouts.app')
@section('title','Coupon')
@section('content')
<div class="container">
<h1 class="mb10">Coupon</h1>
    <a href="{{url('/coupon/manage_coupon')}}">
        <button type="button" class="btn btn-sm btn-info">
            Add Coupon
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Code</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->title}}</td>
                            <td>{{$list->code}}</td>
                            <td>{{$list->value}}</td>
                            <td>
                                <a href="{{url('/coupon/manage_coupon/')}}/{{$list->id}}"><i class="fas fa-edit mr-3" style="font-size:24px; color:#424C85;"></i></a>

                                @if($list->status==1)
                                    <a href="{{url('/coupon/status/0')}}/{{$list->id}}"><i class="fas fa-toggle-on" style="font-size:24px;  color:green;"></i></a>
                                 @elseif($list->status==0)
                                    <a href="{{url('/coupon/status/1')}}/{{$list->id}}"><i class="fas fa-toggle-off" style="font-size:24px; color:#F0D500;"></i></a>
                                @endif
                                
                                <a href="{{url('/coupon/delete/')}}/{{$list->id}}"><i class="fas fa-trash ml-3" style="font-size:24px; color:#850700;"></i></a>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

</div>

@endsection
@section('script')
<script type="text/javascript">

@endsection
