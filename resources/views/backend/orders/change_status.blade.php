@extends('backend.layouts.app')
@section('title','Order Status')
@section('headerTitle')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
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
                                @lang('tr.Order Status')
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">

                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="col-xl-12 order-lg-2 order-xl-1">
                            @include('backend.layouts.partial.error')
                            <form action="{{route('backend.orders.changeStatus',$order->id)}}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label> Select Status </label>
                                            {{ csrf_field()  }}
                                            <select class="form-control" name="status">
                                                @foreach($statuses as $k=>$v)
                                                    <option {{$v==$order->status?"selected":""}} value="{{$v}}">{{$v}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label> Comment </label>
                                            <textarea class="form-control" name="comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-save"></i>&nbsp;حفظ
                                    </button>
                                </div>
                            </form>
                            <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Comment</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->statuses as $status)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$status->name}}</td>
                                <td>{{$status->reason}}</td>
                                <td>{{$status->created_at}}</td>
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
        </div>
    </div>
@stop
