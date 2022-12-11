@extends('layouts.app')
@section('title','List')
@section('content')
    <div class="breadcrumbs-wrap with-bg-img" data-bg="{{asset('frontend')}}/images/about/1920x266_bg1.jpg">
        <div class="container">
            <h1 class="page-title">
                @lang('tr.Checkout')
            </h1>
        </div>
    </div>
    <div id="content" class="page-content-wrap">
        <div class="container wide">
            <div class="row col-no-space">
                <div class="col-lg-6 col-sm-12 col-xs-12" style="border: 2px dashed #f05f79; padding: 10px;">
                    <div class="checkout-title">
                        <h3>@lang('tr.Billing Details')</h3></div>
                    <hr>
                    <div class="theme-form">
                        <form action="{{route('frontend.checkout')}}" method="post" id="payment-form">
                            @csrf
                            <div class="row check-out ">
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label>@lang('tr.Mobile')</label>
                                    <input type="text" name="mobile"  class="form-control" value="{{auth('web')->user()->mobile}}" placeholder="@lang('tr.Mobile')" required>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label class="field-label">@lang('tr.Address')</label>
                                    <input type="text" name="address"  class="form-control" value="{{auth('web')->user()->address}}" placeholder="@lang('tr.Address')" required>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="field-label">@lang('tr.Party Address')</label>
                                    <input type="text" name="party_address"  class="form-control" value="" placeholder="@lang('tr.Party Address')" required>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="field-label">@lang('tr.Day')</label>
                                    <input type="date" name="day"  class="form-control"  value="" placeholder="@lang('tr.Day')" required>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="field-label">@lang('tr.Start Time')</label>
                                    <input type="time" name="start_time"  class="form-control" value="" placeholder="@lang('tr.Start Time')" required>
                                </div>
                                <div style="display: none;"  class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label class="field-label">@lang('tr.End Time')</label>
                                    <input type="time" name="end_time" class="form-control" value="" placeholder="@lang('tr.End Time')">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>@lang('tr.Payment Method')</label>
                                        <select name="payment_method" class="form-control paymentMethod" required>
                                            <option value="">--- @lang('tr.select') ---</option>
                                            <option value="Visa">@lang('tr.Visa')</option>
                                            <option value="Postpaid">@lang('tr.Postpaid')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>@lang('tr.Total')</label>
                                        <input readonly type="number" value="{{\Cart::getTotal()}}" name="total" class="form-control orderTotal" required>
                                        <input  type="hidden" value="{{\Cart::getTotal()}}" name="final_total" class="form-control final_total" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>@lang('tr.Note')</label>
                                        <textarea name="note" cols="10" class="form-control"></textarea>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn-normal btn">@lang('tr.Submit Payment')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5 col-sm-12 col-xs-12" style="border: 2px dashed #f05f79; padding: 10px;">
                    <div class="checkout-details theme-form  section-big-mt-space">
                        <div class="order-box">
                            <div class="title-box">
                                <h3>@lang('tr.Order Total')</h3>
                            </div>
                            <hr>
                            <ul class="qty">
                                @foreach(\Cart::getContent() as $item)
                                    <li style="border: 1px solid #00000069; padding: 5px; box-shadow: 1px 1px 1px 1px #00000029;margin-bottom:10px;">{{$item->name}} × <strong style="color:#b22827;">{{$item->quantity}}</strong> (buffet) <span> : @lang('tr.KD') {{$item->price}}</span></li>
                                @endforeach
                            </ul>
                            <hr>
                            <ul class="total">
                                <li>@lang('tr.Total') <span class="count">: @lang('tr.KD') {{ \Cart::getTotal()}}</span></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
