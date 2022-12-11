<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed no-print">
    <!-- begin: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
            <ul class="kt-menu__nav ">

            </ul>
        </div>
    </div>

    <!-- end: Header Menu -->    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">


        <!--begin: Search -->




        <!--end: Search -->


        <!--begin: Notifications -->
        {{--<div class="kt-header__topbar-item dropdown">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
		<span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
			<i class="flaticon2-bell-alarm-symbol"></i>
			<span class="kt-pulse__ring"></span>
		</span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
                <form>
                    <div class="tab-content">
                        <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                                <a href="" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-line-chart kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            New Order is placed #18
                                        </div>
                                        <div class="kt-notification__item-time">
                                            2020-09-04 02:28:21
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                            <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                    <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                        All caught up!
                                        <br>No new notifications.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>--}}

        <!--end: Notifications -->


        <!--begin: Quick Actions -->


        <!--end: Quick Actions -->


        <!--begin: Language bar -->
        {{--<div class="kt-header__topbar-item kt-header__topbar-item--langs">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
		    <span class="kt-header__topbar-icon">
						<img class="" src="/backend/images/flags/226-united-states.svg" alt="" />
					</span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">

                <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                    <li  class=" kt-nav__item kt-nav__item--active"  class=" kt-nav__item kt-nav__item--active">
                        <a href="http://wedding.test/dashboard/lang/en" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><img src="{{asset('backend')}}/images/flags/226-united-states.svg" alt="" /></span>
                            <span class="kt-nav__link-text">English</span>
                        </a>
                    </li>
                    <li   class="kt-nav__item"  class=" kt-nav__item kt-nav__item--active">
                        <a href="http://wedding.test/dashboard/lang/ar" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><img src="{{asset('backend')}}/images/flags/kw.jpg" style= alt="" /></span>
                            <span class="kt-nav__link-text">Arabic</span>
                        </a>
                    </li>
                </ul>


            </div>
        </div>--}}

        <!--end: Language bar -->



        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">مرحبا يا,</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">
									{{auth()->user()->name}}
							</span>



                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->

                    <!--<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">S</span>-->
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">



                <!--begin: Head -->


                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">
                    <a href="{{route('backend.users.edit',auth()->user()->id)}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                حسابى			</div>
                            <div class="kt-notification__item-time">
                                تعديل الحساب			</div>
                        </div>
                    </a>

                    <a target="_blank" href="/" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                الموقع			</div>
                            <div class="kt-notification__item-time">
                                إذهب للموقع			</div>
                        </div>
                    </a>

                    <div class="kt-notification__custom kt-space-between">
                        <a class="btn btn-danger" href="{{route('backend.auth.logout')}}"
                           onclick="event.preventDefault();
			document.getElementById('logout-form').submit();">
                            تسجيل خروج
                        </a>

                        <form id="logout-form" action="{{route('backend.auth.logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

                <!--end: Navigation -->


            </div>
        </div>

        <!--end: User Bar -->


    </div>

    <!-- end:: Header Topbar -->
</div>
<!-- end:: Header -->
