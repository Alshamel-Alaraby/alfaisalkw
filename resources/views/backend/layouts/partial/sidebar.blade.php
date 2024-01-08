<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{route('backend.home')}}">
                <img alt="Logo" src="{{asset("backend/logo.png")}}" style="width: 100px; margin-top: 5px; height: 63px; display: block; margin-left: auto; margin-right: auto;">
            </a>
        </div>

    </div>
    <!-- end:: Aside -->    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " style="overflow-y:hidden"
         data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            {!! $menu !!}
        </div>
    </div>

    <!-- end:: Aside Menu --></div>
<!-- end:: Aside -->
