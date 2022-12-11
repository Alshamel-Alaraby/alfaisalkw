<!DOCTYPE html>
<html  direction="rtl" dir="rtl" style="direction: rtl"  >
@include('backend.layouts.partial.head')
<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed no-print">
    <div class="kt-header-mobile__logo">
        <a href="/">
            <img alt="Logo" src="{{asset('backend/logo.png')}}" style="width: 100px; margin-top: 5px; height: 63px; display: block; margin-left: auto; margin-right: auto;" />
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>

        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
    </div>
</div>

<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        @include('backend.layouts.partial.sidebar')
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            @include('backend.layouts.partial.header')
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                <!-- begin:: Subheader -->
                @yield('headerTitle')
                <!-- end:: Subheader -->
                @yield('content')
            </div>
            @include('backend.layouts.partial.footer')
        </div>
    </div>
</div>

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->

@include('backend.layouts.partial.script')
<iframe src="about:blank" style="display: none;"></iframe>
</body>
</html>
