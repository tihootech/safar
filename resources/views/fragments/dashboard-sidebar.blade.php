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
                <a href="#/home"><i class="mdi mdi-gauge"></i> <span> @lang('MAIN_DASHBOARD') </span> </a>
            </li>
            <li class="menu-list">
                <a href="javascript:void(0)">
                    <i class="mdi mdi-account-card-details"></i>
                    <span>  @lang('MANAGE_VISA') </span>
                </a>
                <ul class="child-list">
                    <li><a href="#/visa"> <i class="mdi mdi-plus"></i> @lang('NEW_VISA') </a></li>
                    <li><a href="#/visa-list"> <i class="mdi mdi-format-list-bulleted"></i> @lang('VISA_LIST') </a></li>
                </ul>
            </li>
            <li class="menu-list">
                <a href="javascript:void(0)">
                    <i class=" mdi mdi-tag-outline"></i>
                    <span>  @lang('MANAGE_AGENCIES') </span>
                </a>
                <ul class="child-list">
                    <li><a href="#/agency"> <i class="mdi mdi-plus"></i> @lang('NEW_AGENCY') </a></li>
                    <li><a href="#/agency-list"> <i class="mdi mdi-format-list-bulleted"></i> @lang('AGENCY_LIST') </a></li>
                </ul>
            </li>
            <li class="menu-list">
                <a href="javascript:void(0)">
                    <i class="mdi mdi-account-multiple"></i>
                    <span>  @lang('USERS') </span>
                </a>
                <ul class="child-list">
                    <li><a href="#"> Item 1 </a></li>
                    <li><a href="#"> Item 2 </a></li>
                    <li><a href="#"> Item 3 </a></li>
                    <li><a href="#"> Item 4 </a></li>
                </ul>
            </li>
            <li class="menu-list">
                <a href="javascript:void(0)">
                    <i class="mdi mdi-buffer"></i>
                    <span>  @lang('COUNSELING_SESSIONS') </span>
                </a>
                <ul class="child-list">
                    <li><a href="#"> Item 1 </a></li>
                    <li><a href="#"> Item 2 </a></li>
                    <li><a href="#"> Item 3 </a></li>
                    <li><a href="#"> Item 4 </a></li>
                </ul>
            </li>
            <li class="menu-list">
                <a href="javascript:void(0)">
                    <i class="mdi mdi-calendar-multiple-check"></i>
                    <span>  @lang('BANK_TRANSACTIONS') </span>
                </a>
                <ul class="child-list">
                    <li><a href="#"> Item 1 </a></li>
                    <li><a href="#"> Item 2 </a></li>
                    <li><a href="#"> Item 3 </a></li>
                    <li><a href="#"> Item 4 </a></li>
                </ul>
            </li>
            <li class="menu-list">
                <a href="javascript:void(0)">
                    <i class="mdi mdi-calendar-text"></i>
                    <span>  @lang('FACTORS') </span>
                </a>
                <ul class="child-list">
                    <li><a href="#"> Item 1 </a></li>
                    <li><a href="#"> Item 2 </a></li>
                    <li><a href="#"> Item 3 </a></li>
                    <li><a href="#"> Item 4 </a></li>
                </ul>
            </li>
            <li class="menu-list">
                <a href="javascript:void(0)">
                    <i class="mdi mdi-calendar-today"></i>
                    <span>  @lang('CONTRACTS') </span>
                </a>
                <ul class="child-list">
                    <li><a href="#"> Item 1 </a></li>
                    <li><a href="#"> Item 2 </a></li>
                    <li><a href="#"> Item 3 </a></li>
                    <li><a href="#"> Item 4 </a></li>
                </ul>
            </li>
            <li class="menu-list">
                <a href="javascript:void(0)">
                    <i class="mdi mdi-bookmark-plus"></i>
                    <span>  @lang('QUIZ_MAKER') </span>
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
                <a href="javascript:void(0)">
                    <i class="mdi mdi-google-circles-extended"></i>
                    <span> نام منو </span>
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
