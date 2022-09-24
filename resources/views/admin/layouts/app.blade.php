<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('<title>Home</title>')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/mdb.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/sidenav.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/datatables-select.min.css')}}">
    <link href="{{asset('css/toastr.css')}}" rel="stylesheet"/>

   

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @FilemanagerScript
</head>
<body class="fix-header fix-sidebar">

  @include('admin.layouts.menu')
  @yield('content')



</div>
</div>
<script src="{{asset('js/app.js')}}"></script>
<!-- <script src="{{asset('js/bootstrap.js')}}"></script> -->
<script src="{{asset('admin/js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/mdb.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('admin/js/sidebarmenu.js')}}"></script>
<script src="{{asset('admin/js/sticky-kit.min.js')}}"></script>
<script src="{{asset('admin/js/custom.min-2.js')}}"></script>
<script src="{{asset('admin/js/datatables.min.js')}}"></script>
<script src="{{asset('admin/js/datatables-select.min.js')}}"></script>
<script src="{{asset('admin/js/custom.js')}}"></script>
<script src="{{asset('admin/js/axios.min.js')}}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="js/toastr.js"></script>

@yield('script')
</body>
</html>
