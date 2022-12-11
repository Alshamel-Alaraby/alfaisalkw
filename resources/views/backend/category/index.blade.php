@extends('backend.layouts.app')
@section('title','الفئات')
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
                                الفئات
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            @can('Create Category')
                                <a href="{{ route('backend.category.create') }}" class="btn btn-primary">إضافة فئة جديدة</a>
                            @endcan
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="col-xl-12 order-lg-2 order-xl-1">
                            <div id="tree"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')

    <script src="{{asset('backend/js')}}/bootstrap-treeview.js"></script>

    <script type="text/javascript">

        var data = {!! $list !!};

        initializeTreeView(data);

        function initializeTreeView(elements)
        {
            $('#tree').treeview({
                data: elements,
                borderColor:'#3c8dbc',
                color: "#3c8dbc",
                levels:0,
                emptyIcon:'fa fa-stop',
                expandIcon:'fa fa-folder',
                collapseIcon:'fas fa-folder-open'
            });
        }

        $(document).on('click','.editRecord',function(event){
            event.stopPropagation();
            var href = $(this).attr('href');
            window.location = href;
        });
    </script>
@endpush
@push('css')
    <style>
        .catEdit{
           position: absolute;
           left: 10px;
        }
        .catDel{
            position: absolute;
            left: 70px;
        }
    </style>
@endpush
