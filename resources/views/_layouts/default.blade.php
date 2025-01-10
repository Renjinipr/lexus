@extends('_layouts.app')

@section('head-assets')

@endsection


@section('body-content') 
  <body class="nav-md">
    <div class="container body p-0">
      <div class="main_container bg-green-main">
      
    @include('_layouts.admin.menus')
        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a> 
              </div>
                <nav class="nav navbar-nav">                
            
                
                <ul class=" navbar-right">
                 
                  <li class="nav-item dropdown open" style="padding-left: 15px;">

                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="{{asset('production/images/img.jpg')}}" alt="">{{Auth::guard('admin')->user()->business_name}}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="{{url('/admin/profile')}}"> Profile</a>
                        <!-- <a class="dropdown-item"  href="{{url('/admin/change_email')}}">                          
                          <span>Change Email</span>
                        </a> -->
                    <a class="dropdown-item"  href="{{url('/admin/change_password')}}">Change Password</a>
                      <a class="dropdown-item"  href="{{url('/admin/logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
  
                  
                  <li>
                                        <input type="hidden" value="{{ url('/') }}" id="baseurl" name="baseurl" />

                           <div class="form-group mb-0">
                        <div class="input-group date mb-0 cal-header-top" id="myDatepickerr">
                          <span class="input-group-addon border-0 p-0 mr-2 bg-transparent">
                            <img src="{{asset('production/images/calender.svg')}}" height="20" alt="">
                            <!-- <span class="cal-icon-top icon-icons-1-01-10"></span> -->
                         </span>
                          <span class="py-1 date-sec-time mt-0">
                          <?php $date = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
                               echo $date->format('d M Y g:i A'); 
                           ?>
                            <!-- <input type="text" class="form-control" /> -->
                            </span>
                        </div>
                    </div>
                  </li>
                  <li>
<!--           <a href="" class="refresh-btn"><span class="fa fa-refresh"></span></a>
 -->             </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->
                <div class="right_col over-flow-scrool" role="main">


     @yield('content-area')
        <!-- footer content -->
         
  </div>
     
      <div class="clearfix"></div>
    
        <footer>
          <div class="pull-right">
           <a href=""></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
        
      </div>
    </div> 
</body>
@endsection

@section('footer-assets') 

@endsection