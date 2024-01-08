@extends('backend.layouts.app')
@section('title','اﻷصناف')
@section('headerTitle')
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
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
                <div
                    class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            اﻷصناف
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        @can('Create Items')
                        <a href="{{ route('backend.items.create') }}" class="btn btn-primary">إضافة صنف</a>
                        @endcan
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="col-xl-12 order-lg-2 order-xl-1">
                        <table id="clientSideDataTable" class="display" style="width:100%;"
                            class="table table-bordered dt-responsive">
                            <thead>
                                <tr>
                                    <th class="tdesign">#</th>
                                    <th class="tdesign">الأسم</th>
                                    <th class="tdesign">الفئة</th>
                                    <th class="tdesign">النوع</th>
                                    <th class="tdesign">الكمية</th>
                                    <th class="tdesign">السعر</th>
                                    <th class="tdesign">الصورة</th>
                                    <th class="tdesign">العملية</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                {{-- @if(!$role->hasRole('Admin')) --}}
                                <tr>
                                    <td class="tdesign">{{ $loop->iteration }}</td>
                                    <td class="tdesign">{{ $item->name }}</td>
                                    <td class="tdesign">{{ optional($item->category)->name }}</td>
                                    <td class="tdesign">{{ ucfirst($item->type) }}</td>
                                    <td class="tdesign">{{ $item->qty }}</td>
                                    <td class="tdesign">{{ $item->price }}</td>
                                    <td class="tdesign">

                                        @if($item->hasMedia('images'))
                                            <img class="enlarge-image" width="60px" src="{{ asset('storage/' . $item->getFirstMedia('images')->id . '/' . $item->getFirstMedia('images')->file_name) }}" />

                                        @endif

                                        @if($item->hasMedia('extraimages'))
                                            @foreach($item->getMedia('extraimages') as $image)
                                                <img class="enlarge-image" width="50px" src="{{ asset('storage/' . $image->id . '/' . $image->file_name) }}" />
                                            @endforeach
                                        @endif
                                    </td>

                                    <td class="tdesign">

                                        @can('Edit Items')
                                        <a href="{{ route('backend.items.edit',$item->id) }}" class="bluebutton"><i
                                                class="fa fa-edit"></i></a>&nbsp;
                                        @endcan

                                        @can('Delete Items')
                                        <a title="Delete" href="#"
                                            data-action="{{route('backend.items.destroy',$item->id)}}"
                                            class="redbutton deleteRecord"><i class="fa fa-trash"></i></a>
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
