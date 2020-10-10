<!-- sidebar left start-->
<div class="sidebar-right">
    <div class="sidebar-right-info">

        <div class="user-box">
            <div class="d-flex justify-content-center">
                <img src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="" class="img-fluid rounded-circle">
            </div>
            <div class="text-center text-white mt-2">
                <h6>{{user('name')}}</h6>
                <p class="text-muted m-0">{{user('type')}}</p>
            </div>
        </div>

        <!--sidebar nav start-->
        <ul class="side-navigation">
            <li>
                <h3 class="navigation-title">@lang('MAIN_MENU')</h3>
            </li>
            <li class="active">
                <a href="index.html"><i class="mdi mdi-gauge"></i> <span> @lang('DASHBOARD') </span> </a>
            </li>
            <li class="menu-list">
                <a href="#">
                    <i class="mdi mdi-buffer"></i>
                    <span>  MENU_NAME </span>
                </a>
                <ul class="child-list">
                    <li><a href="#"> Item 1 </a></li>
                    <li><a href="#"> Item 2 </a></li>
                    <li><a href="#"> Item 3 </a></li>
                    <li><a href="#"> Item 4 </a></li>
                </ul>
            </li>
            <li>
                <h3 class="navigation-title">@lang('OTHER_SETTINGS')</h3>
            </li>
            <li class="menu-list">
                <a href="#">
                    <i class="mdi mdi-google-circles-extended"></i>
                    <span> MENU_NAME <!-- <span class="badge badge-primary noti-arrow pull-right">6</span> --> </span>
                </a>
                <ul class="child-list">
                    <li><a href="#"> Item 1 </a></li>
                    <li><a href="#"> Item 2 </a></li>
                    <li><a href="#"> Item 3 </a></li>
                    <li><a href="#"> Item 4 </a></li>
                </ul>
            </li>
        </ul><!--sidebar nav end-->
    </div>
</div><!-- sidebar left end-->
