@extends('layouts.app')
@section('title','My Orders')
@section('content')
    <div id="content" class="page-content-wrap">
        <div class="container wide">
            <div class="content-element8">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('tr.Day')</th>
                                    <th>@lang('tr.From')</th>
                                    <th>@lang('tr.To')</th>
                                    <th>@lang('tr.Status')</th>
                                    <th>@lang('tr.Total')</th>
                                    <th>@lang('tr.Address')</th>
                                    <th>@lang('tr.Mobile')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$order->day}}</td>
                                    <td>{{date("h:i A", strtotime($order->start_time))}}</td>
                                    <td>{{date("h:i A", strtotime($order->end_time))}}</td>
                                    <td>{{ trans("tr.".$order->status) }}</td>
                                    <td>{{ $order->final_total }}</td>
                                    <td>{{$order->address}}</td>
                                    <td>{{$order->mobile}}</td>
                                    <td>
                                        <a href="{{route('frontend.order.show',$order->id)}}" class="btn btn-small">@lang('tr.detailes')</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('css')
<style>
    .table {
        margin-bottom: 0;
    }
    .table {
        border: 1px solid #020202 !important;
    }
    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
    .table>tbody>tr>td, .table>tfoot>tr>td {
        border-top: 1px solid #f4f4f4;
    }
    .table-bordered>tbody>tr>td {
        vertical-align: middle;
        padding: 2px!important;
    }
    .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
        border: 1px solid #ddd;
    }
</style>
@endpush
