
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Web Fonts
    ================================================== -->

    <link href="https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700%7CCormorant:300,300i,400,400i,500,500i,600,600i,700,700i%7CGreat+Vibes" rel="stylesheet">
    <link href="{{asset('frontend')}}/font/fontawesome-free-5.12.0-web/css/all.css" rel="stylesheet">
    <!-- Basic Page Needs
    ================================================== -->

    <title>Al Faisal | Home</title>

    <!--meta info-->
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Vendor CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('frontend')}}/font/linearicons/demo.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/font/fontello/fontello.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/plugins/revolution/css/settings.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/plugins/revolution/css/layers.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/plugins/revolution/css/navigation.css">

    <!-- CSS theme files
    ============================================ -->
    <link rel="stylesheet" href="{{asset('frontend')}}/css/owl.carousel.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap-grid.min.css">
    @if(\Lang::getLocale() == 'en')
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{asset('frontend')}}/css/responsive.css">
    <!-- font -->
    <link rel="stylesheet" type="text/css" href="https://www.fontstatic.com/f=aures,diwanltr" />

    <link rel="stylesheet" href="{{asset('frontend')}}/toastr.min.css">

    <link href="{{asset('frontend')}}/rate/jquery.rateyo.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">

    <style>
        .form-control{
            color:black!important;
            width: 100%!important;
            padding: 0 22px!important;
            height: 45px!important;
            border: 1px solid #ddd!important;
        }
    </style>
    @stack('css')
</head>
<body>
<!-- - - - - - - - - - - - - -  start feedback  - - - - - - - - - - - - - - - - -->
<div id="feedback-main">
    <div id="feedback-div">

        <form action="{{route('frontend.contact')}}" method="post" class="form" id="feedback-form1" name="form1" enctype="multipart/form-data">
            @csrf
            <h4>@lang('tr.Contact Us')</h4>

            <p class="name">
                <input name="name" type="name" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input feedback-height" required placeholder="@lang('tr.Name')" id="feedback-name" />
            </p>

            <p class="name">
                <input name="mobile" type="mobile" class="validate[required,length[0,12]] feedback-input feedback-height" required placeholder="@lang('tr.Mobile')" id="feedback-mobile" />
            </p>

            <p class="email">
                <input name="email" type="email" class="validate[required,custom[email]] feedback-input feedback-height" id="feedback-email" placeholder="@lang('tr.Email')" required />
            </p>

            <p class="text">
                <textarea name="comment" type="comment" class="validate[required,length[6,300]] feedback-input" id="feedback-comment" required placeholder="@lang('tr.Comment')"></textarea>
            </p>

            <div class="feedback-submit">
                <div class="row">
                    <div class="col-lg-6"><input type="submit" class="btn btn-danger" value="@lang('tr.Send')" id="feedback-button-blue" /></div>
                    <div class="col-lg-6"><a onclick="toggle_visibility()" class="btn btn-danger" id="feedback-close">@lang('tr.Close')</a></div>
                </div>
            </div>
        </form>
    </div>
</div>

<button id="popup" class="feedback-button" onclick="toggle_visibility()" title="Feedback"> <i class="far fa-frown-open"></i>&nbsp;<i class="far fa-grin-hearts"></i>&nbsp;<i class="far fa-grin-stars"></i>&nbsp;<i class="far fa-grin"></i> </button>

<!-- - - - - - - - - - - - - -  end feedback  - - - - - - - - - - - - - - - - -->
<div id="loader" class="loader"></div>
<div id="wrapper" class="wrapper-container">
    <!-- - - - - - - - - - - - - start Header - - - - - - - - - - - - - - - -->
    <header id="header" class="header sticky-header">
        <!-- - - - - - - - - - - - - Mobile Menu - - - - - - - - - - - - - - -->
        <nav id="mobile-advanced" class="mobile-advanced"></nav>
        <!-- searchform -->
        <div class="searchform-wrap">
            <div class="vc-child h-inherit">
                <form class="search-form">
                    <button type="submit" class="search-button"></button>
                    <div class="wrapper">
                        <input type="text" name="search" placeholder="Start typing...">
                    </div>
                </form>
                <button class="close-search-form"></button>
            </div>
        </div>
        <!-- top-header -->
        <div class="top-header">
            <div class="container wide">
                <div class="our-info-wrap">
                    <div class="our-info">
                        <span class="info-item"><a href="mailto:info@alfaisalkw.com">info@alfaisalkw.com</a></span>&nbsp;|&nbsp;
                        <span class="info-item"><a class="info-item highlight" href="tel:96560909902"> 96560909902</a></span>
                    </div>
                    <ul class="social-icons">
                        <li><a href="https://www.facebook.com/m.azez69"><i class="icon-facebook"></i></a></li>
                        <li><a href="https://www.twitter.com/"><i class="icon-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/"><i class="icon-instagram-5"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- - - - - - - - - - - - / Mobile Menu - - - - - - - - - - - - - -->


        <!--main menu-->

        <div class="menu-holder">
            <div class="container wide">
                <div class="menu-wrap">
                    <!-- logo -->
                    <div class="logo-wrap">
                        <a href="/" class="logo "><img src="{{asset('frontend/images/logoo.png')}}" alt=""></a>
                    </div>
                    <div class="nav-item">
                        <!-- - - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - - - -->
                        <nav id="main-navigation" class="main-navigation">
                            <ul id="menu" class="clearfix">
                                <li class="current"><a href="{{route('frontend.home')}}">@lang('tr.Home')</a></li>
                                <li><a href="{{route('frontend.list')}}">@lang('tr.Reserve Your Occasions')</a></li>
                                @foreach(\App\Page::get() as $page)
                                    <li><a href="{{route('frontend.page',$page->slug)}}">{{$page->title}}</a></li>
                                @endforeach
                                @if (auth('web')->check())
                                    <li>
                                    <a href="#">Hi, {{auth('web')->user()->name}}</a>
                                    <div class="sub-menu-wrap">
                                        <ul>
                                            <li><a href="{{route('frontend.profile')}}">@lang("tr.My Account")</a></li>
                                            <li><a href="{{route('frontend.orders')}}">@lang("tr.My Orders")</a></li>
                                            <li>
                                                <a style="white-space:inherit;" href="{{route('frontend.logout')}}"
                                                   onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                                                    @lang("tr.Logout")
                                                </a>

                                                <form id="logout-form" action="{{route('frontend.logout')}}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                                @else
                                    <li>
                                        <a href="{{route('frontend.showLoginForm')}}">@lang('tr.Login')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('frontend.showRegistrationForm')}}">@lang('tr.Register')</a>
                                    </li>
                                @endif
                                <li class="">
                                    @if(app()->getLocale() == "ar" )
                                        <a rel="alternate" hreflang="en"
                                           href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                            English
                                        </a>
                                    @else
                                        <a rel="alternate" hreflang="ar"
                                           href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                                            عربي
                                        </a>
                                    @endif
                                </li>
                            </ul>
                        </nav>
                        <!-- - - - - - - - - - - - - end Navigation - - - - - - - - - - - - - - - -->
                        <!-- header buttons -->
                        <div class="header-btns">
                            <!-- shop button -->
                            <div class="head-btn">
                                <div class="dropdown-area">
                                    <a href="{{route('frontend.cart.show')}}" class="btn btn-primary">
                                        <i class="fa fa-cart-arrow-down"></i>
                                        <span class="badge badge-light TQ">{{\Cart::getTotalQuantity()}}</span>
                                    </a>
                                </div>
                            </div>
                            <!-- search button -->
                            <div class="head-btn">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- - - - - - - - - - - - - end Header - - - - - - - - - - - - - - - -->
    @yield('content')
</div>
<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->
<footer id="footer" class="footer style-5">
    <div class="bottom-footer">

        <p class="copyright">Copyright © 2020 Al Faisal. All Rights Reserved.</p>

    </div>

</footer>

<!-- - - - - - - - - - - - - end Footer - - - - - - - - - - - - - - - -->
<!-- JS Libs & Plugins
============================================ -->

<script src="{{asset('frontend')}}/font/fontawesome-free-5.12.0-web/js/all.js"></script>
<script src="{{asset('frontend')}}/js/libs/jquery.modernizr.js"></script>
<script src="{{asset('frontend')}}/js/libs/jquery-2.2.4.min.js"></script>
<script src="{{asset('frontend')}}/js/libs/jquery-ui.min.js"></script>
<script src="{{asset('frontend')}}/js/libs/retina.min.js"></script>
<script src="{{asset('frontend')}}/plugins/owl.carousel.min.js"></script>
<script src="{{asset('frontend')}}/plugins/instafeed.min.js"></script>
<script src="{{asset('frontend')}}/plugins/vivus.js"></script>
<script src="{{asset('frontend')}}/plugins/pathformer.js"></script>
<script src="{{asset('frontend')}}/plugins/revolution/js/jquery.themepunch.tools.min.js?ver=5.0"></script>
<script src="{{asset('frontend')}}/plugins/revolution/js/jquery.themepunch.revolution.min.js?ver=5.0"></script>
<script src="{{asset('frontend')}}/plugins/jquery.queryloader2.min.js"></script>
<script src="{{asset('frontend')}}/plugins/isotope.pkgd.min.js"></script>



<!-- JS theme files
============================================ -->
<script src="{{asset('frontend')}}/js/plugins.js"></script>
<script src="{{asset('frontend')}}/js/script.js"></script>
<script type="text/javascript" src="{{asset('frontend')}}/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="{{asset('frontend')}}/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="{{asset('frontend')}}/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="{{asset('frontend')}}/plugins/mad.customselect.js"></script>
<script src="{{asset('frontend')}}//toastr.min.js"></script>
<script src="{{asset('frontend')}}/plugins/fancybox/jquery.fancybox.min.js"></script>

<script> function toggle_visibility() {
        var e = document.getElementById('feedback-main');
        if(e.style.display == 'block')
            e.style.display = 'none';
        else
            e.style.display = 'block';
    }</script>


<script type="text/javascript" src="{{asset('frontend')}}/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="{{asset('frontend')}}/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="{{asset('frontend')}}/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@stack('js')
<script>
    $(function () {
        @if (session()->has('alert-success'))
        toastr.success("{{session('alert-success')}}");
        @elseif (session()->has('alert-danger'))
        toastr.error("{{session('alert-danger')}}");
        @endif
    });
</script>


</body>
</html>
