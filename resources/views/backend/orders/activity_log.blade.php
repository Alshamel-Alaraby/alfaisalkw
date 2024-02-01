@extends('backend.layouts.app')
@section('title','النشاط على العقد')
@section('headerTitle')
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid no-print">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                الرئيسية
            </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('backend.home')}}" class="kt-subheader__breadcrumbs-home"><i
                        class="flaticon2-shelter"></i></a>
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

                <div class="kt-portlet__body kt-portlet__body--fit">

                    <div class="col-xl-12 order-lg-2 order-xl-1">
                        <table id="clientSideDataTable" style="width:100%;" class="table table-bordered dt-responsive">
                            <thead>
                                <tr>
                                    <th class="tdesign">#</th>
                                    <th class="tdesign">الاسم</th>
                                    <th class="tdesign">الحدث</th>
                                    <th class="tdesign">موعد حدوثه</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activityLogs  as $log)
                                <tr>
                                    <td class="tdesign">{{ $loop->iteration }}</td>

                                    <td class="tdesign">{{ $log->causer->name}}</td>
                                    <td class="tdesign">{{ $log->description }}</td>
                                    <td class="tdesign">{{ $log->created_at }}</td>

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
