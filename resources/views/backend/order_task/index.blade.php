@extends('backend.layouts.app')
@section('title','المهام الخاصة بى')
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
                                المهام الخاصة بى
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">

                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="col-xl-12 order-lg-2 order-xl-1">

                            <table id="clientSideDataTable" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                                <thead>
                                <tr>
                                    <th class="tdesign">#</th>
                                    <th class="tdesign">المهمة</th>
                                    <th class="tdesign">الإدارة</th>
                                    <th class="tdesign">المسئول</th>
                                    <th class="tdesign">الطلب</th>
                                    <th class="tdesign">الحالة</th>
                                    <th class="tdesign">التاريخ</th>
                                    <th class="tdesign">العملية</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list as $t)
                                    {{-- @if(!$task->hasRole('Admin')) --}}
                                    <tr>
                                        <td class="tdesign">{{ $loop->iteration }}</td>
                                        <td class="tdesign">{{ optional($t->task)->title }}</td>
                                        <td class="tdesign">{{ optional($t->department)->name }}</td>
                                        <td class="tdesign">{{ optional($t->user)->name }}</td>
                                        <td class="tdesign">{{ $t->order_id }}</td>
                                        <td class="tdesign">{{ $t->status }}</td>
                                        <td class="tdesign">{{ date("Y-m-d h:i A",strtotime($t->start)) }}</td>
                                        <td class="tdesign">

                                            @can('Edit Tasks')
                                                <a href="{{ route('backend.ordertasks.edit',$t->id) }}" class="bluebutton" ><i class="fa fa-edit"></i></a>&nbsp;
                                            @endcan

                                            @can('Delete Tasks')
                                                <a title="Delete" href="#" data-action="{{route('backend.ordertasks.destroy',$t->id)}}" class="redbutton deleteRecord"><i class="fa fa-trash"></i></a>
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
