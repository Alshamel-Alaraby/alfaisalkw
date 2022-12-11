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
                                تعيين المهام للطلب رقم {{$order->id}}
                                <a target="_blank" href="{{route('backend.orders.show',$order->id)}}">تفاصيل الطلب</a>
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">

                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="col-xl-12 order-lg-2 order-xl-1">
                            @include('backend.layouts.partial.error')
                            <table class="table table-bordered table-striped">
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
                            <hr>
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
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="party_address">عنوان الحفل</label>
                                            <input disabled type="text" name="party_address" id="party_address" value="{{$order->party_address??''}}" class="form-control">
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
@stop
@push('js')
    <script>
        $(document).on("change",'.departmentList',function(e){
            var value = $(this).val();
            $(".optionelm").hide();
            $(".dep"+value).show();
        });
    </script>
@endpush
