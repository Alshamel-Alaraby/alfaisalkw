@extends('backend.layouts.app')
@section('title','متابعة السداد ')
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
                            قائمة التحصيلات
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        @can('Create Payments')
                            <a href="{{ route('backend.payments.create') }}" class="btn btn-primary">إضافة تحصيل جديد</a>
                        @endcan
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="col-xl-12 order-lg-2 order-xl-1">
                        <table id="clientSideDataTable" style="width:100%;" class="table table-bordered dt-responsive">
                            <thead>
                                <tr>
                                    <th class="tdesign">#</th>
                                    <th class="tdesign">رقم العقد</th>
                                    <th class="tdesign">العميل</th>

                                    <th class="tdesign">التاريخ</th>


                                    <th class="tdesign">الإجمالى</th>
                                    <th class="tdesign">إجمالى السداد</th>
                                    <th class="tdesign">اجمالي الخصم</th>
                                    <th class="tdesign">اجمالي الاضافة</th>
                                    <th class="tdesign">المتنبقي</th>
                                    <th class="tdesign no-print">العملية</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $order)
                                <tr>
                                    <td class="tdesign">{{ $loop->iteration }}</td>

                                    <td class="tdesign"  style="max-width: 20px">{{ str_replace(['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'], ['0','1','2','3','4','5','6','7','8','9'], $order->contract_number) }}</td>

                                    <td class="tdesign" style="max-width: 70px">{{ $order->client->name }}</td>

                                    <td class="tdesign">{{ $order->day }}</td>

                                    <td class="tdesign" style="width: 10px !important">{{ $order->final_total }}</td>
                                    <td class="tdesign" style="width: 10px !important">{{ $order->total_paid }}</td>
                                    <td class="tdesign" style="width: 10px !important">{{ $order->discounts()->sum('value') }}</td>
                                    <td class="tdesign" style="width: 10px !important">{{ $order->additions()->sum('value') }}</td>
                                    <td class="tdesign" style="width: 10px !important">{{ $order->remaining }}</td>
                                    <td class="tdesign">
                                        {{--  @if(auth()->user()->department->id == 5 &&  optional($order->status)->name == 'Pending')  --}}
                                        {{--  @can('Edit Orders')  --}}
                                        {{--  <a href="{{ route('backend.orders.edit',$order->id) }}" class="bluebutton"><i
                                                class="fa fa-edit"></i></a>&nbsp;  --}}
                                        {{--  @endcan  --}}
                                        {{--  @endif  --}}


                                        {{--  @can('Show Orders')  --}}
                                        <a href="{{ route('backend.payments.show',$order->id) }}" class="pinkbutton"><i
                                                class="fa fa-eye"></i></a>&nbsp;
                                        {{--  @endcan  --}}



                                        {{--  @can('Delete Orders')
                                        <a title="Delete" href="#"
                                            data-action="{{route('backend.orders.destroy',$order->id)}}"
                                            class="redbutton deleteRecord"><i class="fa fa-trash"></i></a>
                                        @endcan  --}}


                                    </td>

                                </tr>

                                @endforeach
                            </tbody>


                        </table>
                        <div class="justify-content-center">
                            {!! $list->links("pagination::bootstrap-4") !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
@include('backend.layouts.partial.datatable')
