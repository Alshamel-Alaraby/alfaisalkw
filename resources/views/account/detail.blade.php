@extends('layouts.app')
@section('title','#'.$order->id)
@section('content')
    <div id="content" class="page-content-wrap">
        <div class="container wide">
            <div class="content-element8">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="kt-portlet__head-title">
                            @lang('tr.Invoice') #{{$order->id}}
                        </h3>
                        <div class="row">
                            <div class="col-12">
                                <!-- Main content -->
                                <div class="invoice p-3 mb-3">
                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            <address>
                                                <strong>العنوان: 10 شارع خالد بن الوليد</strong><br>
                                                الهاتف: (804) 123-5432<br>
                                                الإيميل: info@alfaisal.com
                                            </address>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <b>رقم الفاتورة #{{$order->id}}</b><br>
                                            <b>العميل:</b> {{optional($order->client)->name}}<br>
                                            <b>الهاتف:</b> {{$order->mobile}}<br>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <b>العنوان:</b> {{$order->address}}<br/>
                                            <b>اليوم:</b> {{$order->day}}<br/>
                                            <b>الوقت:</b> {{date("h:i A", strtotime($order->start_time))." : ".date("h:i A", strtotime($order->end_time))}}<br/>

                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-md-12" id="accordion">
                                            @if(count($selectedProd))
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                        <h5 class="mb-0 mt-5">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                اﻷصناف المطلوبة
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="col-12 table-responsive">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>الصنف</th>
                                                                        <th>الكمية</th>
                                                                        <th>السعر</th>
                                                                        <th>الإجمالى</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($selectedProd as $item)
                                                                        <tr>
                                                                            <td>{{$loop->iteration}}</td>
                                                                            <td>{{$item->name}}</td>
                                                                            <td>{{$item->pivot->qty}}</td>
                                                                            <td>{{$item->pivot->price}}</td>
                                                                            <td>{{$item->pivot->qty * $item->pivot->price}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(count($selectedBuffet))
                                                <div class="card">
                                                    <div class="card-header" id="heading2">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                                البوفيه
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="col-12 table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>الصنف</th>
                                                                        <th>السعر</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($selectedBuffet as $item)
                                                                        <tr>
                                                                            <td>{{$loop->iteration}}</td>
                                                                            <td>{{$item->title}}</td>
                                                                            <td>{{$item->pivot->price}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <table class="table table-bordered">
                                                                                    <thead>
                                                                                    <tr class="bg-green">
                                                                                        <td colspan="3">الأصناف</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>الصنف</th>
                                                                                        <th>الكمية</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach($item->details as $bitem)
                                                                                        <tr>
                                                                                            <td>{{$loop->iteration}}</td>
                                                                                            <td>{{$bitem->name}}</td>
                                                                                            <td>{{$bitem->pivot->qty}}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(count($selectedEq))
                                                <div class="card">
                                                    <div class="card-header" id="heading3">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                                المعدات المطلوبة
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="col-12 table-responsive">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>الصنف</th>
                                                                        <th>الكمية</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($selectedEq as $item)
                                                                        <tr>
                                                                            <td>{{$loop->iteration}}</td>
                                                                            <td>{{$item->name}}</td>
                                                                            <td>{{$item->pivot->qty}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(count($selectedDocor))
                                                <div class="card">
                                                    <div class="card-header" id="heading4">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                                الديكورات المطلوبة
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapse4" class="collapse show" aria-labelledby="heading4" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="col-12 table-responsive">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>الصنف</th>
                                                                        <th>الكمية</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($selectedDocor as $item)
                                                                        <tr>
                                                                            <td>{{$loop->iteration}}</td>
                                                                            <td>{{$item->name}}</td>
                                                                            <td>{{$item->pivot->qty}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
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
                                                <table style="margin-top: 10px;" class="table">
                                                    <tr>
                                                        <th style="width:50%">الإجمالى:</th>
                                                        <td>{{$order->total}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>المدفوع:</th>
                                                        <td>{{$order->paid}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>المتبقى:</th>
                                                        <td>{{$order->due}}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('css')
    <style>
        h5{
            margin-top: 25px;
            margin-bottom: 10px;
        }
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
            border: 1px solid #000;
        }
    </style>
@endpush
