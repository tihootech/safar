<!-- body content start-->

<!-- header section start-->
<div class="header-section">
    <!--logo and logo icon start-->
    <div class="logo">
        <a href="/#home">
            <span class="logo-img">
                <img src="assets/images/logo_sm.png" alt="" height="26">
            </span>
            <!--<i class="fa fa-maxcdn"></i>-->
            <span class="brand-name">@lang('BRAND')</span>
        </a>
    </div>

    <a class="toggle-btn"><i class="ti ti-menu"></i></a>



    <div class="notification-wrap">
        <!--right notification start-->
        <div class="right-notification">
            <ul class="notification-menu">

                <li>
                    <a href="javascript:;" data-toggle="dropdown">
                        <img src="assets/images/users/avatar-1.jpg" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-menu text-right">
                        <a class="dropdown-item" href="#/acc"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> @lang('MANAGE_ACC') </a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <a class="dropdown-item" href="#" onclick="$(this).parents('form').submit()">
                                <i class="mdi mdi-logout m-r-5 text-muted"></i> @lang('LOGOUT')
                            </a>
                        </form>
                    </div>

                </li>

                <li>
                    <div class="sb-toggle-right">
                        <i class="mdi mdi-apps"></i>
                    </div>
                </li>
            </ul>
        </div><!--right notification end-->
    </div>
</div>
<!-- header section end-->
