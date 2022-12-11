@extends('layouts.app')
@section('title','My Account')
@section('content')
    <div id="content" class="page-content-wrap">
        <div class="container wide">
            <div class="content-element8">
                <div class="shop-cart-form table-type-1 responsive-table" style="padding:20px;">
                    <div class="align-center">
                        <form action="{{ route('frontend.profile') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">@lang('tr.Name')</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="text" value="{{ $user->name }}" name="name" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">@lang('tr.Email')</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                        <p type="text" class="form-control" aria-describedby="basic-addon1">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">@lang('tr.Mobile')</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                        <input type="text" class="form-control" value="{{ $user->mobile }}" name="mobile" onkeypress='validate(event)' minlength="11" maxlength="11" placeholder="@lang('tr.Mobile')"  required aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">@lang('tr.Address')</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                        <input type="text" class="form-control" value="{{ $user->address }}" name="address" placeholder="@lang('tr.Address')"  required aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h4  style="font-family: 'diwanltr';text-align: center; color: #f05f79;margin-top: 20px; margin-bottom: 20px;">@lang('tr.Write Password If You Want to Change It')</h4>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">@lang('tr.New Password')</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="•••••••••">
                                </div>
                            </div>
                            <br>
                            <div class="form-group form-group-last row">
                                <label class="col-xl-3 col-lg-3 col-form-label">@lang('tr.Confirm Password')</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="•••••••••">
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i>&nbsp;@lang('tr.Save')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
