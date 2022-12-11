@extends('backend.layouts.app')
@section('title','تقرير الكوش المحجوزة')
@section('headerTitle')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    تقرير الديكورات المحجوزة
                </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{route('backend.home')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                </div>
            </div>

        </div>
    </div>
@stop
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-xl-12 order-lg-2 order-xl-1">
                <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
                    <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                تقرير الكوش المحجوزة
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a style="margin: 10px;" href="javascript:void(0)" onclick="window.print()" type="button" class="btn btn-success float-right"> <i class="fa fa-print"></i> طباعة</a>
                        </div>
                    </div>
                    <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                        @include('backend.reports.order_filter')
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="col-xl-12 order-lg-2 order-xl-1">
                            <table id="clientSideDataTable" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                                <thead>
                                <tr>
                                    <th class="tdesign">#</th>
                                    <th class="tdesign">العقد</th>
                                    <th class="tdesign">رقم الطلب</th>
                                    <th class="tdesign">تاريخ الإضافه</th>
                                    <th class="tdesign">الكوشة</th>
                                    <th class="tdesign">العميل</th>
                                    <th class="tdesign">اليوم</th>
                                    <th class="tdesign">الفترة من</th>

                                    <th class="tdesign">الحالة</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $detail)
                                    @php
                                        $order = optional($detail->order);
                                    @endphp
                                    {{-- @if(!$role->hasRole('Admin')) --}}
                                    <tr>
                                        <td class="tdesign">{{ $loop->iteration }}</td>
                                        <td class="tdesign">{{ $order->contract_number }}</td>
                                        <td class="tdesign"><a class="bluebutton" href="{{ route("backend.orders.show",$order->id) }}">رقم الطلب# {{ $order->id }}</a></td>
                                        <td class="tdesign">{{ $order->created_at->format('Y-m-d') }}</td>
                                        <td class="tdesign">{{ optional($detail->item)->name }}</td>
                                        <td class="tdesign">
                                            @can('Show Clients')
                                                <a href="{{ route('backend.clients.show',$order->client_id) }}" class="pinkbutton"><i class="fa fa-eye"></i> {{ optional($order->client)->name }}</a>
                                            @endcan

                                        </td>
                                        <td class="tdesign">{{ $order->day }}</td>
                                        <td class="tdesign">{{date("h:i A", strtotime($order->start_time))}}</td>
                                        <td class="tdesign">{{ trans("tr.".$order->status) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@include('backend.layouts.partial.datatable')
