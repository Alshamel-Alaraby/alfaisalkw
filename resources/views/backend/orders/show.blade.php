@extends('backend.layouts.app')
@section('title','تفاصيل الطلب')
@section('headerTitle')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    </div>
@stop
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-xl-12 order-lg-2 order-xl-1">
            <div class="kt-portlet kt-portlet--height-fluid  ">
                <div class="no-print kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            @lang('tr.Invoice') #{{$order->id}}
                        </h3>
                    </div>
                    <a style="margin: 10px;" href="javascript:void(0)" onclick="window.print()" type="button" class="btn btn-success float-right"> <i class="fa fa-print"></i> طباعة</a>
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
                                                <i class="fas fa-globe"></i> الفيصل لتنظيم قاعات الأفراح
                                                <small class="float-right">التاريخ: {{ $order->created_at->format('Y-m-d') }}</small>
                                            </h4>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            <address>
                                                <strong>العنوان: 10 شارع خالد بن الوليد</strong><br>
                                                الهاتف: (804) 123-5432<br>
                                                الإيميل: info@alfaisal.com
                                            </address>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <b>رقم العقد #{{$order->contract_number}}</b><br>
                                            <b>العميل:</b> {{optional($order->client)->name}}<br>
                                            <b>الهاتف:</b> {{$order->mobile}}<br>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <b>العنوان:</b> {{$order->address}}<br/>
                                            <b>عنوان الحفل:</b> {{$order->party_address}}<br/>
                                            <b>اليوم:</b> {{$order->day}}<br/>
                                            <b>الوقت:</b> {{date("h:i A", strtotime($order->start_time))." : ".date("h:i A", strtotime($order->end_time))}}<br/>

                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="nav  nav-pills" role="tablist">
                                                <li>
                                                    <a class="nav-link active" data-toggle="pill" href="#orderdetails">تفاصيل الطلب</a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" data-toggle="pill" href="#taskslist">المهمات</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="orderdetails" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                    <div class="row">
                                                        <div class="col-md-12" id="accordion">
                                                            @if(count($selectedProd))
                                                                <div class="card">
                                                                    <div class="card-header" id="headingOne">
                                                                        <h5 class="mb-0">
                                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                                اﻷصناف المطلوبة
                                                                            </button>
                                                                        </h5>
                                                                    </div>
                                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                                        <div class="card-body">
                                                                            <div class="col-12 table-responsive">
                                                                                <table class="table table-striped table-bordered">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>الصنف</th>
                                                                                        <th>الكمية</th>
                                                                                        <th>السعر</th>
                                                                                        <th>الإجمالى</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach($selectedProd as $item)
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
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if(count($selectedBuffet))
                                                                <div class="card">
                                                                    <div class="card-header" id="heading2">
                                                                        <h5 class="mb-0">
                                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                                                البوفيه
                                                                            </button>
                                                                        </h5>
                                                                    </div>
                                                                    <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#accordion">
                                                                        <div class="card-body">
                                                                            <div class="col-12 table-responsive">
                                                                                <table class="table table-bordered">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>الصنف</th>
                                                                                        <th>السعر</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach($selectedBuffet as $item)
                                                                                        <tr>
                                                                                            <td>{{$loop->iteration}}</td>
                                                                                            <td>{{$item->title}}</td>
                                                                                            <td>{{$item->pivot->price}}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="3">
                                                                                                <table class="table table-bordered">
                                                                                                    <thead>
                                                                                                    <tr class="bg-green">
                                                                                                        <td colspan="3">الأصناف</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>#</th>
                                                                                                        <th>الصنف</th>
                                                                                                        <th>الكمية</th>
                                                                                                    </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                    @foreach($item->details as $bitem)
                                                                                                        <tr>
                                                                                                            <td>{{$loop->iteration}}</td>
                                                                                                            <td>{{$bitem->name}}</td>
                                                                                                            <td>{{$bitem->pivot->qty}}</td>
                                                                                                        </tr>
                                                                                                    @endforeach
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if(count($selectedEq))
                                                                <div class="card">
                                                                    <div class="card-header" id="heading3">
                                                                        <h5 class="mb-0">
                                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                                                المعدات المطلوبة
                                                                            </button>
                                                                        </h5>
                                                                    </div>
                                                                    <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion">
                                                                        <div class="card-body">
                                                                            <div class="col-12 table-responsive">
                                                                                <table class="table table-striped table-bordered">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>الصنف</th>
                                                                                        <th>الكمية</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach($selectedEq as $item)
                                                                                        <tr>
                                                                                            <td>{{$loop->iteration}}</td>
                                                                                            <td>{{$item->name}}</td>
                                                                                            <td>{{$item->pivot->qty}}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if(count($selectedDocor))
                                                                <div class="card">
                                                                    <div class="card-header" id="heading4">
                                                                        <h5 class="mb-0">
                                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                                                الديكورات المطلوبة
                                                                            </button>
                                                                        </h5>
                                                                    </div>
                                                                    <div id="collapse4" class="collapse show" aria-labelledby="heading4" data-parent="#accordion">
                                                                        <div class="card-body">
                                                                            <div class="col-12 table-responsive">
                                                                                <table class="table table-striped table-bordered">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>الصنف</th>
                                                                                        <th>الكمية</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach($selectedDocor as $item)
                                                                                        <tr>
                                                                                            <td>{{$loop->iteration}}</td>
                                                                                            <td>{{$item->name}}</td>
                                                                                            <td>{{$item->pivot->qty}}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="taskslist" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                    <div class="row">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th class="tdesign">#</th>
                                                                <th class="tdesign">المهمة</th>
                                                                <th class="tdesign">الإدارة</th>
                                                                <th class="tdesign">المسئول</th>
                                                                <th class="tdesign">الحالة</th>
                                                                <th class="tdesign">التاريخ</th>
                                                                <th class="tdesign">العملية</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($orderTasks as $t)
                                                                <tr>
                                                                    <td class="tdesign">{{ $loop->iteration }}</td>
                                                                    <td class="tdesign">{{ optional($t->task)->title }}</td>
                                                                    <td class="tdesign">{{ optional($t->department)->name }}</td>
                                                                    <td class="tdesign">{{ optional($t->user)->name }}</td>
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
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header" id="headingOne">
                                                                    <h5 class="mb-0">
                                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                            إضافة مهمة جديدة
                                                                        </button>
                                                                    </h5>
                                                                </div>

                                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                                    <div class="card-body">
                                                                        @include('backend.layouts.partial.error')
                                                                        <form action="{{route('backend.orders.assignTask',$order->id)}}" method="post" enctype="multipart/form-data" >
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="client_id">العميل</label>
                                                                                        <input disabled class="form-control" value="{{optional($order->client)->name}}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="mobile">الهاتف</label>
                                                                                        <input disabled id="mobile" class="form-control" name="mobile" value="{{$order->mobile??''}}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="address">العنوان</label>
                                                                                        <input disabled type="text" name="address" id="address" value="{{$order->address??''}}" class="form-control" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="order_day">اليوم</label>
                                                                                        <input disabled type="date" name="day" id="order_day" class="form-control"  min="{{ date("Y-m-d") }}"  value="{{ $order->day }}" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="order_from">الوقت من</label>
                                                                                        <input disabled type="time" name="start_time" value="{{$order->start_time??''}}" id="order_from" class="form-control" placeholder="@lang('tr.From')" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="order_to">الوفت إلى</label>
                                                                                        <input disabled type="time" name="end_time" value="{{$order->end_time??''}}" id="order_to" class="form-control" placeholder="@lang('tr.To')"  required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="department_id">الإدارة</label>
                                                                                        <select style="width: 100%;" required class="form-control select2 departmentList" id="department_id" name="department_id">
                                                                                            <option value="">-- إختر الإدارة --</option>
                                                                                            @foreach($departments as $department)
                                                                                                <option value="{{$department->id}}"> {{$department->name}} </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="task_id">المهام</label>
                                                                                        <select required class="form-control " id="task_id" name="task_id">
                                                                                            <option value="">-- إختر المهمة --</option>
                                                                                            @foreach($tasks as $task)
                                                                                                <option class="dep{{$task->department_id}} optionelm" value="{{$task->id}}"> {{$task->title}} </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="user_id">المسئول</label>
                                                                                        <select class="form-control " id="user_id" name="user_id">
                                                                                            <option value="">-- إختر المسئول --</option>
                                                                                            @foreach($users as $user)
                                                                                                <option class="dep{{$user->department_id}} optionelm" value="{{$user->id}}"> {{$user->name}} </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label for="start">اليوم</label>
                                                                                        <input type="datetime-local" name="start" id="start" class="form-control" required="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label for="status">الحالة</label>
                                                                                        <select name="status" id="status" class="form-control" required="">
                                                                                            <option value="">إختر الحاله</option>
                                                                                            <option value="بدأ">بدأ</option>
                                                                                            <option value="قيد الانتظار">قيد الانتظار</option>
                                                                                            <option value="تمت">تمت</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label>ملحوظة</label>
                                                                                        <textarea name="note" cols="15" rows="5" class="form-control"></textarea>
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                        <!-- accepted payments column -->
                                        <div class="col-6 ">
                                            @if($order->note)
                                            <div class="callout callout-info">
                                            <h5><i class="fas fa-info"></i> ملحوظة:</h5>
                                                {{$order->note}}
                                            </div>
                                            @endif
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:50%">الإجمالى:</th>
                                                        <td>{{$order->final_total}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:50%">قيمة العقد:</th>
                                                        <td>{{$order->total}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>اجمالي الاضافات:</th>
                                                        <td>{{@$order->additions()->sum('value')?:0}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>العربون:</th>
                                                        <td>{{$order->paid}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>اجمالي السداد:</th>
                                                        <td>{{@$order->payments()->sum('value')?:0}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>اجمالي الخصومات:</th>
                                                        <td>{{@$order->discounts()->sum('value')?:0}}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>المتبقى:</th>
                                                        <td>{{$order->remaining}}</td>
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
