@extends('layouts.app')
@section('title','Thank You ♥')
@section('content')
    <div class="breadcrumbs-wrap with-bg-img" data-bg="{{asset('frontend')}}/images/about/1920x266_bg1.jpg">
        <div class="container">
            <h1 class="page-title">
                @lang('tr.Thank You ♥')
            </h1>
        </div>
    </div>
    <div id="content" class="page-content-wrap">
        <div class="container wide">
            <div class="row col-no-space">
                <div class="col-lg-12 col-sm-12 col-xs-12 thankDiv">
                    @lang('tr.Your Order has been placed successfuly')
                </div>
            </div>
        </div>
    </div>
@stop
@push('css')
    <style>
        .thankDiv{
            border: 2px dashed #f05f79;
            color: #000;
            font-weight: bold;
            padding: 80px;
            font-size: 30px;
            text-align: center;
        }
    </style>
@endpush
