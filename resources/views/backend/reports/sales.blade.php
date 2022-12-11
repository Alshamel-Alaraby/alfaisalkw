@extends('backend.layouts.app')
@section('title','تقرير المبيعات')
@section('headerTitle')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    تقرير المبيعات
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
                                تقرير المبيعات
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
                                    <th class="tdesign">رقم العقد</th>
                                    <th class="tdesign">العميل</th>
                                    <th class="tdesign">المشرف</th>
                                    <th class="tdesign">المندوب</th>
                                    <th class="tdesign">اليوم</th>
                                    <th class="tdesign">الحالة</th>
                                    <th class="tdesign">الهاتف</th>
                                    <th class="tdesign">إجمالى السداد</th>
                                    <th class="tdesign">المتبقى</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $order)
                                    {{-- @if(!$role->hasRole('Admin')) --}}
                                    <tr>
                                        <td class="tdesign">{{ $loop->iteration }}</td>
                                        <td class="tdesign">{{ $order->contract_number }}</td>
                                        <td class="tdesign">{{ optional($order->client)->name }}</td>
                                        <td class="tdesign">{{ optional($order->supervisor)->name }}</td>
                                        <td class="tdesign">{{ optional($order->delegator)->name }}</td>
                                        <td class="tdesign">{{ $order->day }}</td>
                                        <td class="tdesign">{{ trans("tr.".$order->status) }}</td>
                                        <td class="tdesign">{{ $order->mobile }}</td>
                                        <td class="tdesign">{{ $order->total_paid }}</td>
                                        <td class="tdesign">{{ $order->final_total - $order->total_paid }}</td>
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
