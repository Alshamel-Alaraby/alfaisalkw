@extends('backend.layouts.app')
@section('title','Buffet Detail')
@section('headerTitle')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    </div>
@stop
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-xl-12 buffet-lg-2 buffet-xl-1">
            <div class="kt-portlet kt-portlet--height-fluid  ">
                <div class="no-print kt-portlet__head kt-portlet__head--lg kt-portlet__head--nobbuffet kt-portlet__head--break-sm">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            @lang('tr.Invoice') #{{$buffet->id}}
                        </h3>
                    </div>
                    <a style="margin: 10px;" href="javascript:void(0)" onclick="window.print()" type="button" class="btn btn-success float-right"> <i class="fa fa-print"></i> Print</a>
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
                                                <i class="fas fa-globe"></i> Al-Faisal Organization
                                                <small class="float-right">Created At: {{ $buffet->created_at->format('Y-m-d') }}</small>
                                            </h4>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            <address>
                                                <strong>795 Folsom Ave, Suite 600</strong><br>
                                                Phone: (804) 123-5432<br>
                                                Email: info@alfaisal.com
                                            </address>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <b>Invoice #{{$buffet->id}}</b><br>
                                            <b>Client:</b> {{optional($buffet->client)->name}}<br>
                                            <b>Mobile:</b> {{$buffet->mobile}}<br>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <b>Address:</b> {{$buffet->address}}<br/>
                                            <b>Day:</b> {{$buffet->day}}<br/>
                                            <b>Time:</b> {{date("h:i A", strtotime($buffet->start_time))." : ".date("h:i A", strtotime($buffet->end_time))}}<br/>

                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped table-bbuffeted">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Item</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($buffet->details as $item)
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
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                        <!-- accepted payments column -->
                                        <div class="col-6 ">
                                            @if($buffet->note)
                                            <div class="callout callout-info">
                                            <h5><i class="fas fa-info"></i> Note:</h5>
                                                {{$buffet->note}}
                                            </div>
                                            @endif
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:50%">Total:</th>
                                                        <td>{{$buffet->total}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paid</th>
                                                        <td>{{$buffet->paid}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Due:</th>
                                                        <td>{{$buffet->due}}</td>
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
