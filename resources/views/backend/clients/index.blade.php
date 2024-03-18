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
                            قائمة العملاء
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        @can('Create Clients')
                            <a href="{{ route('backend.clients.create') }}" class="btn btn-primary">إضافة عميل جديد</a>
                        @endcan
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="col-xl-12 order-lg-2 order-xl-1">

                        <table id="clientSideDataTable" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">الأسم</th>
                                <th class="tdesign">الإيميل</th>
                                <th class="tdesign">الهاتف</th>
                                <th class="tdesign">العنوان</th>
                                <th class="tdesign">العملية</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($list as $client)
                                {{-- @if(!$client->hasRole('Admin')) --}}
                                <tr>
                                    <td class="tdesign">{{ $loop->iteration }}</td>
                                    <td class="tdesign">{{ $client->name }}</td>
                                    <td class="tdesign">{{ $client->email }}</td>
                                    <td class="tdesign">{{ $client->mobile }}</td>
                                    <td class="tdesign">{{ $client->address }}</td>
                                    <td class="tdesign">

                                        {{--  @can('Show Clients')
                                            <a href="{{ route('backend.clients.show',$client->id) }}" class="pinkbutton"><i class="fa fa-eye"></i></a>&nbsp;
                                        @endcan  --}}

                                        @can('Edit Clients')
                                            <a href="{{ route('backend.clients.edit',$client->id) }}" class="bluebutton" ><i class="fa fa-edit"></i></a>&nbsp;
                                        @endcan

                                        @can('Delete Clients')
                                                <a title="Delete" href="#" data-action="{{route('backend.clients.destroy',$client->id)}}" class="redbutton deleteRecord"><i class="fa fa-trash"></i></a>
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
