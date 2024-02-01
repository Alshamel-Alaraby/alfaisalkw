@extends('backend.layouts.app')
@section('title','تفاصيل السداد')
@section('headerTitle')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    </div>
@stop
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-xl-12 order-lg-2 order-xl-1">
            <div class="kt-portlet kt-portlet--height-fluid  ">
                <div class="no-print kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            @lang('tr.Invoice') #{{$order->id}}
                        </h3>
                    </div>
                    <a style="margin: 10px;" href="javascript:void(0)" onclick="window.print()" type="button" class="btn btn-success float-right"> <i class="fa fa-print"></i> طباعة</a>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                {{--<div class="callout callout-info">
                                    <h5><i class="fas fa-info"></i> Note:</h5>
                                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                                </div>--}}


                                <!-- Main content -->
                                <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fas fa-globe"></i> الفيصل تأجير معدات الافراح
                                                {{--  <small class="float-right">التاريخ: {{ $order->created_at->format('Y-m-d') }}</small>  --}}
                                            </h4>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            <address>
                                                <strong>العنوان: الجهراء ق2 شارع 2 مجمع الزيد التجاري
                                                    </strong><br>
                                                الهاتف: (804) 99414639 - 1822218<br>
                                                الإيميل: info@alfaisal.com
                                            </address>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <b>رقم العقد #{{$order->contract_number}}</b><br>
                                            <b>العميل:</b> {{optional($order->client)->name}}<br>
                                            <b>الهاتف:</b> {{$order->mobile}}<br>
                                            <b>اسم المندوب:</b> {{$order->delegator->name}}<br>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <b>العنوان:</b> {{$order->address}}<br/>
                                            <b>عنوان الحفل:</b> {{$order->party_address}}<br/>
                                            <b>اليوم:</b> {{$order->day}}<br/>
                                            <b>الوقت:</b> {{date("h:i A", strtotime($order->start_time))." : ".date("h:i A", strtotime($order->end_time))}}<br/>

                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->



                                    <div class="row">
                                        <!-- accepted payments column -->
                                        <div class="col-6 ">
                                            @if($order->note)
                                            <div class="callout callout-info">
                                            <h5><i class="fas fa-info"></i> ملحوظة:</h5>
                                                {{$order->note}}
                                            </div>
                                            @endif
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:50%">الإجمالى:</th>
                                                        <td>{{$order->final_total}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:50%">قيمة العقد:</th>
                                                        <td>{{$order->total}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>اجمالي الاضافات:</th>
                                                        <td>{{@$order->additions()->sum('value')?:0}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>العربون:</th>
                                                        <td>{{$order->paid}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>اجمالي السداد:</th>
                                                        <td>{{@$order->payments()->sum('value')?:0}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>اجمالي الخصومات:</th>
                                                        <td>{{@$order->discounts()->sum('value')?:0}}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>المتبقى:</th>
                                                        <td>{{$order->remaining}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.invoice -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
