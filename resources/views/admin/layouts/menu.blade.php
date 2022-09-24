<div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item "> <a class="nav-link nav-toggler  hidden-md-up  waves-effect waves-dark" href="javascript:void(0)"><i class="fas  fa-bars"></i></a></li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="fas fa-bars"></i></a> </li>
                        @php
                            $st = App\Models\Settings::first();
                        @endphp
                     <li class="nav-item mt-3">{{$st->title_first_letter}}{{$st->title_remain}}</li>
					</ul>


                    @if(Auth::user())
                  <!-- notification -->
                  <div id="notifications" class="">
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
                            <a class="dropdown-item d-flex align-items-center" target="_blank" href="{{route('admin.notification',$notification->id)}}">

                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                            <i class="text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">{{$notification->created_at->format('F d, Y h:i A')}}</div>
                                            <span class="@if($notification->unread()) font-weight-bold @else small text-gray-500 @endif">{{$notification->data['name']}}</span>
                                        </div>
                                    </a>
                                    @if($loop->index+1==5)
                                        @php 
                                            break;
                                        @endphp
                                    @endif
                                @endforeach

                                <a class="dropdown-item text-center small text-gray-500" href="{{route('all.notification')}}">Show All Notifications</a>
                                
                            </div>
                        </div>
                    <!-- notification -->

                 @endif
                    <div class="dropdown">
                    

                   <button class="btn btn-secondary dropdown-toggle dropbtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}<i class="fas fa-angle-down ml-1"></i> 
                    </button>
                    <ul class="dropdown-menu me-4" aria-labelledby="dropdownMenuButton1" id="myDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                    </div>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                    <li class="nav-devider mt-0" style="margin-bottom: 5px"></li>
                    <li>
                    <a href="{{ url('/') }}">
                        <span>
                        <i class="fas fa-angle-double-left"></i>
                        </span>
                        <span class="hide-menu">Visit Client Area</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/admin/home') }}">
                        <span>
                        <i class="fas fa-home"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/category') }}">
                        <span>
                        <i class="fas fa-desktop"></i>
                        <!-- <i class="fab fa-cuttlefish"></i> -->
                        </span>
                        <span class="hide-menu">Category</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/products') }}">
                        <span>
                        <i class="fab fa-product-hunt"></i>
                        </span>
                        <span class="hide-menu">Products</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/subcategory') }}">
                        <span>
                        <i class="fas fa-code-branch"></i>
                        </span>
                        <span class="hide-menu">Sub Category</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/brands') }}">
                        <span>
                        <i class="fab fa-bandcamp"></i>
                        </span>
                        <span class="hide-menu">Brand</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/colors') }}">
                        <span>
                        <i class="fas fa-braille"></i>
                        </span>
                        <span class="hide-menu">Colors</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/size') }}">
                        <span>
                        <i class="fas fa-cross"></i>
                        </span>
                        <span class="hide-menu">Sizes</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/units') }}">
                        <span>
                        <i class="fas fa-underline"></i>
                        </span>
                        <span class="hide-menu">Units</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/banners') }}">
                        <span>
                        <i class="fas fa-sliders-h"></i>
                        </span>
                        <span class="hide-menu">Banners</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/allOrders') }}">
                        <span>
                        <i class="fab fa-first-order"></i>
                        </span>
                        <span class="hide-menu">Orders</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/upload-images') }}">
                        <span>
                        <i class="fas fa-camera"></i>
                        </span>
                        <span class="hide-menu">Photos</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/settings') }}">
                        <span>
                        <i class="fa fa-cog"></i>
                        </span>
                        <span class="hide-menu">Settings</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/coupon') }}">
                        <span>
                        <i class="fas fa-gift"></i>
                        </span>
                        <span class="hide-menu">Coupon</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/visitor') }}">
                        <span>
                        <i class="fas fa-user-secret"></i>
                        </span>
                        <span class="hide-menu">Visitor</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/admin/users') }}">
                        <span>
                        <i class="fas fa-user-tie"></i>
                        </span>
                        <span class="hide-menu">All Users</span>
                    </a>
                    </li>


                    <li>
                    <a href="{{route('shipping.index')}}">
                        <span>
                        <i class="fas fa-truck"></i>
                        </span>
                        <span class="hide-menu">Shipping</span>
                    </a>
                    </li>
                        
					</ul>
                </nav>
            </div>
        </aside>
<div class="page-wrapper">
