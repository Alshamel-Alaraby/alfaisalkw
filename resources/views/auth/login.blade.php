@extends('layouts.app')
@section('title','List')
@section('content')
    <div class="breadcrumbs-wrap with-bg-img" data-bg="{{asset('frontend')}}/images/about/1920x266_bg1.jpg">
        <div class="container">
            <h1 class="page-title">
                @lang('tr.Login')
            </h1>
        </div>
    </div>
    @php
        $class = app()->getLocale()=='ar'?'arInputStyle':'enInputStyle';
    @endphp
    <div id="content" class="page-content-wrap">
        <div class="container wide">
            <div class="row col-no-space">
                <div class="col-lg-12 col-sm-12 col-xs-12" style="border: 2px dashed #f05f79; padding: 10px;">
                    <div class="checkout-title">
                        <h3>@lang('tr.Login')</h3></div>
                    <hr>
                    <div class="theme-form">
                        <form action="{{ route('frontend.login') }}" method="POST" class="m-login__form m-form" action="">
                            @csrf
                            <div class="row check-out ">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>@lang('tr.Email')</label>
                                    <input type="email" name="email" style="color:black;width: 100%; padding: 0 22px; height: 45px; border: 1px solid #ddd;" value="" placeholder="@lang('tr.Email')" required>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>@lang('tr.Password')</label>
                                    <input type="password" name="password" style="color:black;width: 100%; padding: 0 22px; height: 45px; border: 1px solid #ddd;" value="" placeholder="@lang('tr.Password')" required>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>
                                        <input style="width: 20px;height: 20px;" type="checkbox" name="remember_me">
                                        <span>@lang('tr.Remember Me')</span>
                                    </label>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn-normal btn">@lang('tr.Login')</button>
                                    <a class="btn btn-primary" href="{{route('frontend.register')}}">@lang('tr.register')</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
