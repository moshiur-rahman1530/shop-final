<?php
use App\Models\Cart;
 ?>
<!DOCTYPE html>
<!-- <html lang="en"> -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="asset('/css/app.css')">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/template.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/frontendHome.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/axios.min.js')}}"></script>
    <link href="{{asset('css/toastr.css')}}" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

   

</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center shareshocialhomeicon">
                    @yield('socialIcon')
                </div>
            </div>
        </div>
        @php
        $data = DB::table('settings')->first();
        @endphp
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">{{$data->title_first_letter}}</span>{{$data->title_remain}}</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" id="searchProductText" class="searchProductText form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
            @if(Auth::user())
                        <!-- notification -->
                    <div id="notifications" class="d-inline-block">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">
                                    @if(count(Auth::user()->unreadNotifications) >5 )<span data-count="5" class="count">5+</span>
                                    @else 
                                        <span class="count" data-count="{{count(Auth::user()->unreadNotifications)}}">{{count(Auth::user()->unreadNotifications)}}</span>
                                    @endif
                                </span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                Notifications Center
                                </h6>
                                @foreach(Auth::user()->unreadNotifications as $notification)
                            <a class="dropdown-item d-flex align-items-center" target="_blank" href="{{route('user.notification',$notification->id)}}">

                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                            <i class="text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">{{$notification->created_at->format('F d, Y h:i A')}}</div>
                                            <span class="@if($notification->unread()) font-weight-bold @else small text-gray-500 @endif">{{$notification->data['title']}}</span>
                                        </div>
                                    </a>
                                    @if($loop->index+1==5)
                                        @php 
                                            break;
                                        @endphp
                                    @endif
                                @endforeach

                                <a class="dropdown-item text-center small text-gray-500" href="{{route('userall.notification')}}">Show All Notifications</a>
                                
                            </div>
                        </div>
                    <!-- notification -->
                        @endif
                <div class="d-inline-block">
                <a href="" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                @php
                  $id=Auth::id();
                  $coutcarttotal = App\Models\Cart::TotalCart($id)
                @endphp
                <a href="{{url('/shipping-details')}}" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge totalCartCount"></span>
                </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
        
            <div class="col-lg-3 d-none d-lg-block">
            @if(isset($category))
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: auto">
                    <li class="catDropdown">
                        <ul class="dropdown border-0 shadow">
                        <?php
                            foreach($category as $cat_info){
                                if($cat_info->subcategories->count()>0){
                                    ?>
                                    <li><a href="{{url('/categoryPage/'.$cat_info->id)}}"><?php echo $cat_info->cat_name; ?><i class="fa fa-angle-down float-right"></i></a>
                                        <ul class="dropdown sub-dropdown border-0 shadow">
                                            <?php
                                            foreach($cat_info->subcategories as $sub_menu){
                                                ?>
                                                <li><a href="{{url('/SubCategoryPage/'.$sub_menu->id)}}"><?php echo $sub_menu->name; ?></a></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                else{
                                    ?>
                                        <li><a href="{{url('/categoryPage/'.$cat_info->id)}}"><?php echo $cat_info->cat_name; ?></a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>

                        

                    </div>
                </nav>
                @endif
            </div>
            
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">{{$data->title_first_letter}}</span>{{$data->title_remain}}</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{url('/')}}" class="nav-item nav-link">Home</a>
                            <a href="{{url('/shop')}}" class="nav-item nav-link">Shop</a>
                            <a href="{{url('/shipping-details')}}" class="nav-item nav-link active">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="{{url('/shipping-details')}}" class="dropdown-item">Shopping Cart</a>
                                    <a href="{{url('/checkout')}}" class="dropdown-item">Checkout</a>
                                </div>
                            </div>
                            <a href="{{url('/contact-us')}}" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">

                       

                          @guest
                                  <a class="nav-link nav-item" href="{{ route('login') }}">{{ __('Login') }}</a>

                              @if (Route::has('register'))

                                      <a class="nav-link nav-item" href="{{ route('register') }}">{{ __('Register') }}</a>

                              @endif
                          @else

                                  <a id="navbarDropdown" class="dropdown nav-link nav-item dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                      {{ Auth::user()->name }} <span class="caret"></span>
                                  </a>

                                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                          {{ __('Logout') }}
                                      </a>

                                      <a class="dropdown-item" href="{{url('userdashboard')}}">
                                          {{ __('Dashboard') }}
                                      </a>

                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                                  </div>
                                 
                          @endguest
                        </div>
                    </div>
                </nav>
                @if(count($banners)>0)
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                            @foreach($banners as $key=>$banner)
                        <li data-target="#header-carousel" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
                            @endforeach

                    </ol>
                    <div class="carousel-inner">

                        @foreach($banners as $key=>$banner)
                            <div class="carousel-item {{(($key==0)? 'active' : '')}}" style="height: 410px;">
                                <img class="img-fluid" src="{{$banner->photo}}" alt="Image">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                       
                                            <h4 class="text-light text-uppercase font-weight-medium mb-3">

                                            @php 
                                            
                                            $countDescWord = Str::of($banner->description)->wordCount();
                                          
                                                $datass = nl2br(e(Str::words($banner->description, '7')));
                                                $datass2=str_replace('...','',$datass)
                                                
                                            @endphp

                                            @if($countDescWord>7)
                                            {{$datass2}}
                                            @else
                                            {{$banner->description}}
                                            @endif
                                            
                                            </h4>

                                            
                                       
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">{{$banner->title}}</h3>
                                        <a href="{{url('/shop')}}" class="btn btn-light py-2 px-3">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Navbar End -->

<div class="searchList"></div>
   @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">{{$data->title_first_letter}}</span>{{$data->title_remain}}</h1>
                </a>
                <p>{{$data->short_des}}</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$data->address1}}</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{$data->email}}</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{$data->phone}}</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-3 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="{{url('/')}}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="{{url('/shop')}}"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="{{url('/shipping-details')}}"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="{{url('/shipping-details')}}"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="{{url('/checkout')}}"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark mb-2" href="{{url('/contact-us')}}"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>

                            @if(isset($category))
                    @php 
                    $categorys = $category->take(2);
                    
                    @endphp
                        @foreach($categorys as $cat)


                     
                        <a class="text-dark mb-2" href="{{url('/categoryPage/'.$cat->id)}}"><i class="fa fa-angle-right mr-2"></i>{{$cat->cat_name}}</a>
                        @endforeach
                        @else
                       
                      @endif
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-5 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Location</h5>
                        <div class="d-flex flex-column justify-content-start">
                           
                            <div>
            <!-- Google Map Copied Code -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d116814.14083368072!2d91.08663440000001!3d23.80288029999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e3!4m0!4m5!1s0x37540d00480e1e3f%3A0xd0de1410dfe10984!2sChargas%20-%20Manderpur%20Rd%2C%20Manderpur!3m2!1d23.8013157!2d91.09505639999999!5e0!3m2!1sen!2sbd!4v1663997322530!5m2!1sen!2sbd" 
                   
                    frameborder="0"
                    style="border:0;width:90%;height:180px;"
                    allowfullscreen=""
                    aria-hidden="false"
                    tabindex="0">
            </iframe>
        </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">{{$data->footer1}}  </a>{{$data->footer2}}
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">{{$data->footer3}}</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{asset('img/payments.png')}}" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('js/toastr.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script> totalCountCart();</script>

    <script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>


<script>
    $(document).ready(function(){
        $('.searchProductText').on('keyup',function () {
            var query = $(this).val();
            console.log(query);
           if (query.length>0) {
            

            $('.searchList').html('');

            
                $.ajax({
                url:'{{ route('searchproduct') }}',
                type:'GET',
                data:{'name':query},
                success:function (data) {
                   
                    $('.homecontainer').addClass('d-none');
                    $('#header-carousel').addClass('d-none');

                    $.each(data, function(index, value) {
                   
                       $("<div class='col-12 col-sm-6 col-md-4 p-2'>").html(
                          "<div class='gallery'><h1>"+value['product_name']+"</h1></div>").appendTo('.searchList'); 
                   
                    });
                    
                }
            })

           }else{
            $('.homecontainer').removeClass('d-none');
            $('#header-carousel').removeClass('d-none');
            $('.searchList').html('');
           }
            
            
            
        });
        
    });
   
</script>



<!-- facebook messanger add -->

<!-- Messenger Chat Plugin Code -->
<div id="fb-root"></div>

<!-- Your Chat Plugin code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "107910413878114");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v14.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

<!-- end facebook messanger add -->

    @yield('script')

    
</body>

</html>
