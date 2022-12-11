<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">

<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <title> لوحة التحكم | تسجيل الدخول </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin::Global Theme Styles -->

    <link href="{{ asset('frontend/login/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/login/assets/demo/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/login/loginCSS/loginStyle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles -->
    <link rel="shortcut icon" href="{{ asset('frontend/login/assets/demo/media/img/logo/favicon.ico')}}" />
    @php($class = 'arInputStyle')
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
    class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->

<div class="m-grid m-grid--hor m-grid--root m-page page_design"
     style="background-image: url({{ asset('frontend/login/images/loginbg.jpg') }});background-color: #6247474f;">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1"
         id="m_login">

        @if(Session::has('error_login'))
            <div class="row">
                <div class="alert alert-danger" style="display: block; margin-left: auto; margin-right: auto; margin-top: 33px; border-radius: 50px;">
                    <h5>@lang('tr.Email Address Or Password Incorrect')</h5>
                </div>
            </div>
        @endif

        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="m-login__container overlay_div">
                <div class="m-login__logo">
                    <a href="#">
                        <img src="{{ asset('frontend/login/assets/demo/media/img/logo/logoo.png')}}">
                    </a>

                </div>

                <!--  ***************************  START THE LOGIN TAP   ********************   -->
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <div class="m-login__desc">مرحبًا بك في موقعنا على الويب ، قم بتسجيل الدخول إلى لوحة التحكم </div>
                    </div>
                    <form method="POST" class="m-login__form m-form" action="{{ route('backend.auth.login') }}">
                        @csrf
                        <div class="form-group m-form__group">

                            <input required class="form-control m-input {{ $class }}" type="email" placeholder="البريد الإلكترونى"
                                   name="email">
                        </div>
                        <div class="form-group m-form__group">
                            <input required class="form-control m-input m-login__form-input--last {{ $class }}" type="password"
                                   placeholder="كلمة المرور" name="password">
                        </div>
                        <div class="row m-login__form-sub">
                             <div class="col m--align-right">
                                <label class="m-checkbox m-checkbox--focus">
                                    <input type="checkbox" name="remember_me"> تذكرنى
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="m-login__form-action">
                            <button type="submit"
                                    class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">تسجيل دخول</button>
                        </div>
                    </form>
                </div>
                <!--  ***************************  END THE LOGIN TAP   ********************   -->


            </div>

        </div>
        <p class="copyright" > <span>2020 ©  جميع الحقوق محفوظة </span> برمجة وتصميم <a href="http://electedapps.com">ElectedApps</a></p>

    </div>

</div>
<!-- end:: Page -->

<!--begin::Global Theme Bundle -->
<script src="{{ asset('frontend/login/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{ asset('frontend/login/assets/demo/base/scripts.bundle.js')}}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Scripts -->
<script src="{{ asset('frontend/login/assets/snippets/custom/pages/user/login.js')}}" type="text/javascript"></script>

<!--end::Page Scripts -->

<script>
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>
</body>

<!-- end::Body -->

</html>
