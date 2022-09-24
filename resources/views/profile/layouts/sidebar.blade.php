<ul class="navbar-nav sidebar sidebar-dark accordion mb-0 mb-5 mt-4" id="accordionSidebar">

    <!-- Sidebar - Brand -->
      <div class="mt-4 mx-4">
        <div class="title-section">
            <h5 class="px-4">My Account</h5>

            <img src="{{Auth::user()->image}}" id="userImgStyle" alt="" class="userImgStyle">

            <h6 class="mt-2">{{Auth::user()->name}}</h6>
            <hr class="bg-light">
        </div>
        <div class="user-section-link ">
            <li class="">
            <a href="{{url('/userdashboard')}}">Dashboard</a>
            </li>
            <li class="">
            <a href="{{url('/userdashboard/order')}}">Orders</a>
            </li>
            <li class="">
            <a href="{{url('/updateusershippingarea')}}">Shipping Area</a>
            </li>
            <li class="">
            <a href="{{url('/getpassword')}}">Change User Info</a>
            </li>
            <li class="">
            @if(Auth::user())
                        <!-- notification -->
                    <div id="notifications" class="d-inline-block">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Notification<i class="fas fa-bell fa-fw" style="color: #0866C6"></i>
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
            </li>
            <li class="">
            <a   class="" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
            </li>
        </div>
      </div>
</ul>