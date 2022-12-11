<head>
    <base href="">
    <meta charset="utf-8">
    <title>@yield('title','لوحة التحكم | الرئيسية')</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">--}}

    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->


    <link rel="stylesheet" href="{{asset('backend')}}/css/animate.css">
    <!--end::Page Vendors Styles -->

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('backend')}}/select2/css/select2.min.css">
    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{asset('backend')}}/css/plugins.bundle.css" rel="stylesheet" type="text/css">
    {{--<link href="{{asset('backend')}}/css/style.bundle.css" rel="stylesheet" type="text/css">--}}
    <style>
        @import  url('https://fonts.googleapis.com/css?family=Almarai&display=swap');
        *{
            font-family: 'Almarai', sans-serif;
        }
    </style>
    <link href="{{asset('backend')}}/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />

    <link href="{{asset('backend')}}/css/styles.css" rel="stylesheet" type="text/css">

    <link href="{{asset('backend')}}/toastr/toastr.min.css" rel="stylesheet" type="text/css">


    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{asset('backend')}}/favicon.ico">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/datatables.min.css">
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">

    {{--<link href="{{asset('backend')}}/js/charts/Chart.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/css/chartstyle.css" rel="stylesheet" type="text/css">--}}

    <link href="{{asset('backend')}}/calendar/main1.css" rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/calendar/main2.css" rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/calendar/main3.css" rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/calendar/main4.css" rel="stylesheet" type="text/css">

    @stack('css')
    <style>
        @media print
        {
            .no-print, .no-print *
            {
                display: none !important;
            }
            @page { margin: .1cm; }
            body { margin: .1cm;}
            html, body {
                height:100vh;
                width: 100vh;
                margin: 0px !important;
                padding-right: 5px !important;
                /*overflow: hidden;*/
            }
            @page{
                size: auto;
                height:auto;
                margin-left: 0cm;
                margin-right: 0px;
                margin-top: 0cm;
                margin-bottom: 0px;
                padding: 0cm!important;
            }
        }
        .toast-top-right {
            left: 5px!important;
            right: auto!important;
            top:70px!important;
        }
        #toast-container>div {
            padding: 15px 45px 15px 50px!important;
        }
        a.external {
            color: #337ab7;
            text-decoration: none;
        }
        .kt-menu__link-bullet{
            color:#f5f6ff!important;
        }
        table#clientSideDataTable {
            font-size: 13px;
        }
        .fc-title{
            color: #f05f78 !important;
            font-weight: bold;
        }
        .fc-time{
            color: #84c8ef !important;
            font-weight: bold;
        }
        .kt-iconbox .kt-iconbox__body .kt-iconbox__desc .kt-iconbox__title {
            font-size: 16px;
            color: #000000;
        }
    </style>

</head>
