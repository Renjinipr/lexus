<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('admin/dashboard') }}" class="site_title">
                <!--<i class="fa fa-desktop border-0"></i>-->
                <span class="logo-dashboard"><img src="{{asset('assets/images/newlogo.jpg')}}" alt=""></span>
                <span class="logo-dashboard logo-small"><img src="{{ asset('img/favicon.png') }}"
                        alt=""></span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->

        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu menu-sec-side">
            <?php if (empty($menu)) {
                $menu = null;
            }
            if (empty($submenu)) {
                $submenu = null;
            }
            ?>



            <div class="menu_section">
                <h3>Activity</h3>
                <ul class="nav side-menu">
                    <li class="{{ Request::segment(1) === 'admin' && Request::segment(2) === 'enquiries' ? 'current-page' : '' }}"><a href="{{ route('Admin.enquiries.index') }}">
                            <!--<i class="fa fa-exchange"></i>--><span class="icon-menu icon-icons-1-01-09"></span><span
                                class="menu-text-a">Enquiries</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'admin' && Request::segment(2) === 'model_management' ? 'current-page' : '' }}"><a href="{{ route('Admin.model_management.index') }}">
                            <!--<i class="fa fa-exchange"></i>--><span class="icon-menu icon-icons-1-01-05"></span><span
                                class="menu-text-a">Model Management</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'admin' && Request::segment(2) === 'settings' ? 'current-page' : '' }}"><a href="{{ route('settings') }}">
                            <!--<i class="fa fa-exchange"></i>--><span class="icon-menu icon-icons-1-01-07"></span><span
                                class="menu-text-a">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
