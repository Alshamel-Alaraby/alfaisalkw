@extends('backend.layouts.app')
@section('title','قائمة العملاء')
@section('headerTitle')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    الرئيسية
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
                            قائمة التحصيلات
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        @can('Create Payments')
                            <a href="{{ route('backend.payments.create') }}" class="btn btn-primary">إضافة تحصيل جديد</a>
                        @endcan
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="col-xl-12 order-lg-2 order-xl-1">

                        <table id="clientSideDataTable" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">العميل</th>
                                <th class="tdesign">رقم الطلب</th>
                                <th class="tdesign">المبلغ</th>
                                <th class="tdesign">رقم الايصال</th>
                                <th class="tdesign">تاريخ الإيصال</th>
                                <th class="tdesign">ملحوظة</th>
                                <th class="tdesign">العملية</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($list as $payment)
                                @php
                                    $order = optional($payment->order);
                                @endphp
                                {{-- @if(!$payment->hasRole('Admin')) --}}
                                <tr>
                                    <td class="tdesign">{{ $loop->iteration }}</td>
                                    <td class="tdesign">{{ optional($order->client)->name }}</td>
                                    <td class="tdesign">{{ $order->id }}</td>
                                    <td class="tdesign">{{ $payment->value }}</td>
                                    <td class="tdesign">{{ $payment->receipt_number }}</td>
                                    <td class="tdesign">{{ $payment->receipt_date }}</td>
                                    <td class="tdesign">{{ $payment->note }}</td>
                                    <td class="tdesign">
                                        @can('Edit Payments')
                                            <a href="{{ route('backend.payments.edit',$payment->id) }}" class="bluebutton" ><i class="fa fa-edit"></i></a>&nbsp;
                                        @endcan

                                        @can('Delete Payments')
                                                <a title="Delete" href="#" data-action="{{route('backend.payments.destroy',$payment->id)}}" class="redbutton deleteRecord"><i class="fa fa-trash"></i></a>
                                        @endcan
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
    </div>
@stop
@include('backend.layouts.partial.datatable')
