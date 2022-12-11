
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name">الأسم</label>
            <input type="text" value="{{$user->name??''}}" name="name" id="name" class="form-control" placeholder="@lang('tr.Enter User Name')" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="email">@lang('tr.Email')</label>
            <input type="email" value="{{$user->email??''}}" name="email" id="email" class="form-control" placeholder="@lang('tr.Enter User Email')" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="calendar">الكالندر</label>
            <select required multiple class="form-control select2" id="calendar" name="calendar[]">
                <option disabled value="">-- إختر --</option>
                <option {{$user->calendar&&in_array('الطلبات',$user->calendar)?'selected':''}} value="الطلبات"> الطلبات </option>
                <option {{$user->calendar&&in_array('المهمات',$user->calendar)?'selected':''}} value="المهمات"> المهمات </option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="department_id">الإدارة</label>
            <select required class="form-control" id="department_id" name="department_id">
                <option value="">-- إختر الإدارة التابع لها --</option>
                @foreach($departments as $department)
                    <option @if($user->department_id==$department->id) selected @endif value="{{$department->id}}"> {{$department->name}} </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="role">@lang('tr.Role')</label>
            <select required class="form-control" id="Role" name="role">
                <option value="">-- إختر الصلاحية --</option>
                @foreach($roles as $role)
                    <option @if($user->first_role->name==$role) selected @endif value="{{$role}}"> {{$role}} </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="password">@lang('tr.Password')</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="******">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="password_confirmation">@lang('tr.Confirm Password')</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="******">
        </div>
    </div>
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i>&nbsp;حفظ
    </button>
</div>
