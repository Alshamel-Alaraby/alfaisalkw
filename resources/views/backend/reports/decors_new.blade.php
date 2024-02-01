@extends('backend.layouts.app')
@section('title','تقرير الكوش المحجوزه')
@section('headerTitle')
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                تقرير الكوش المحجوزه
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
                <div
                    class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            تقرير الكوش المحجوزه
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a style="margin: 10px;" href="javascript:void(0)" onclick="window.print()" type="button"
                            class="btn btn-success float-right"> <i class="fa fa-print"></i> طباعة</a>
                    </div>
                </div>
                <div
                    class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                    {{--  @include('backend.reports.order_filter')  --}}
                    <div class="col-xl-12 order-lg-1 order-xl-1">
                        <form action="" method="">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label>يوم :</label>
                                        <input autocomplete="off" style="direction: rtl;" name="fromdate" value="{{request()->fromdate}}" type="date" class="form-control">

                                    </div>
                                </div>


                                <div class="form-group col-md-3 no-print" style="margin-top: 25px;">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-search"></i>&nbsp;بحث
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="col-xl-12 order-lg-2 order-xl-1">
                        <table id="clientSideDataTable" class="display" style="width:100%;"
                            class="table table-bordered dt-responsive">
                            <thead>
                                <tr>
                                    <th class="tdesign">#</th>
                                    <th class="tdesign">اسم الصنف</th>
                                    <th class="tdesign">الرصيد</th>
                                    <th class="tdesign">المحجوز منه</th>
                                    <th class="tdesign">المتاح</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $item)

                                <tr>
                                    <td class="tdesign">{{ $loop->iteration }}</td>

                                    <td class="tdesign">{{ $item->name }}</td>
                                    <td class="tdesign">{{ $item->balance}}</td>
                                    <td class="tdesign">{{ $item->reserved }}</td>
                                    <td class="tdesign">{{ $item->remaining }}</td>

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
