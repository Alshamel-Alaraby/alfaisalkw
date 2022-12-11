@extends('backend.layouts.app')
@section('title','تعيين المهام')
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
                                تعيين المهام
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">

                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="nav  nav-pills" role="tablist">
                                    <li>
                                        <a class="nav-link active" data-toggle="pill" href="#taskslist">تفاصيل المهمة</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-toggle="pill" href="#orderdetails">تفاصيل الطلب</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="taskslist" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <div class="col-xl-12 order-lg-2 order-xl-1">
                                            @include('backend.layouts.partial.error')
                                            <form action="{{route('backend.ordertasks.update',$ordertask->id)}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                {{ method_field('PUT') }}
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
                                                            <select required class="form-control select2 departmentList" id="department_id" name="department_id">
                                                                <option value="">-- إختر الإدارة --</option>
                                                                @foreach($departments as $department)
                                                                    <option @if(isset($ordertask) && $ordertask->department_id==$department->id ) selected @endif value="{{$department->id}}"> {{$department->name}} </option>
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
                                                                    <option @if(isset($ordertask) && $ordertask->task_id==$task->id ) selected @endif class="dep{{$task->department_id}} optionelm" value="{{$task->id}}"> {{$task->title}} </option>
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
                                                                    <option @if(isset($ordertask) && $ordertask->user_id==$user->id ) selected @endif class="dep{{$user->department_id}} optionelm" value="{{$user->id}}"> {{$user->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="start">اليوم</label>
                                                            <input type="datetime-local" value="{{isset($ordertask->start)?date('Y-m-d',strtotime($ordertask->start)).'T'.date('H:i',strtotime($ordertask->start)):''}}" name="start" id="start" class="form-control" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="status">الحالة</label>
                                                            <select name="status" id="status" class="form-control" required="">
                                                                <option value="">إختر الحاله</option>
                                                                <option @if(isset($ordertask) && $ordertask->status=="بدأ" ) selected @endif  value="بدأ">بدأ</option>
                                                                <option @if(isset($ordertask) && $ordertask->status=="قيد الانتظار" ) selected @endif  value="قيد الانتظار">قيد الانتظار</option>
                                                                <option @if(isset($ordertask) && $ordertask->status=="تمت" ) selected @endif  value="تمت">تمت</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>ملحوظة</label>
                                                            <textarea name="note" cols="15" rows="5" class="form-control">{{$ordertask->note??''}}</textarea>
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
                                    <div class="tab-pane" id="orderdetails" role="tabpanel" aria-labelledby="v-pills-home-tab">
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
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script>
        $(document).on("change",'.departmentList',function(e){
            var value = $(this).val();
            $(".optionelm").hide();
            $(".dep"+value).show();
        });
        $(".departmentList").trigger("change");
    </script>
@endpush
