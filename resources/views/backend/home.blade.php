@extends('backend.layouts.app')

@section('title','لوحة التحكم | الرئيسية')

@section('headerTitle')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
           {{-- <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    الرئيسية
                </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                </div>
            </div>--}}
        </div>
    </div>
@stop

@section('content')
    <br>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
                    <div class="kt-portlet__body">
                        <div class="kt-iconbox__body">
                            <div class="kt-iconbox__icon">
                                <i class="fa fa-calendar-day" ></i>
                            </div>
                            <div class="kt-iconbox__desc">
                                <h3 class="kt-iconbox__title">
                                    <a class="kt-link" href="{{route('backend.orders.index')}}">إجمالى الطلبات</a>
                                </h3>
                                <div class="kt-iconbox__content" >
                                    عدد الطلبات: {{$status['all']}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
                    <div class="kt-portlet__body">
                        <div class="kt-iconbox__body">
                            <div class="kt-iconbox__icon">
                                <i class="fa fa-calendar-day" ></i>
                            </div>
                            <div class="kt-iconbox__desc">
                                <h3 class="kt-iconbox__title">
                                    <a class="kt-link" href="{{route('backend.orders.index')}}?status={{\App\Enum\Status::PENDING}}">الطلبات المعلقة</a>
                                </h3>
                                <div class="kt-iconbox__content" >
                                    عدد الطلبات: {{$status[\App\Enum\Status::PENDING]}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
                    <div class="kt-portlet__body">
                        <div class="kt-iconbox__body">
                            <div class="kt-iconbox__icon">
                                <i class="fas fa-calendar-plus" ></i>
                            </div>
                            <div class="kt-iconbox__desc">
                                <h3 class="kt-iconbox__title">
                                    <a class="kt-link" href="{{route('backend.orders.index')}}?status={{\App\Enum\Status::INPROGRESS}}">طلبات قيد التنفيذ</a>
                                </h3>
                                <div class="kt-iconbox__content" >
                                    عدد الطلبات: {{$status[\App\Enum\Status::INPROGRESS]}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
                    <div class="kt-portlet__body">
                        <div class="kt-iconbox__body">
                            <div class="kt-iconbox__icon">
                                <i class="fa fa-calendar-check" ></i>
                            </div>
                            <div class="kt-iconbox__desc">
                                <h3 class="kt-iconbox__title">
                                    <a class="kt-link" href="{{route('backend.orders.index')}}?status={{\App\Enum\Status::FINISHED}}">الطلبات المكتملة</a>
                                </h3>
                                <div class="kt-iconbox__content" >
                                    عدد الطلبات: {{$status[\App\Enum\Status::FINISHED]}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="kt-portlet ">
                <div class="kt-portlet__body">
                    <div class="col-lg-12 calbg" >
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('css')
    <style>
        .fc-day-grid-event>.fc-content {
            white-space: normal;
            direction: rtl;
            font-size: 11px;
            text-align: center;
        }
    </style>
@endpush
@push('js')
<script src="{{asset('backend')}}/js/fullcalender.bundle.js" type="text/javascript"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'ar',
                plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction' ],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                buttonIcons: false, // show the prev/next text
                weekNumbers: false,
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: false, // allow "more" link when too many events
                events: JSON.parse(calander)
            });

            calendar.render();
        });
    </script>
@endpush
