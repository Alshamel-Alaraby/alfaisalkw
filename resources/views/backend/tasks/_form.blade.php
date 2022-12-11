
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name">العنوان</label>
            <input type="text" value="{{$task->title??''}}" name="title" id="title" class="form-control" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="department_id">الإدارة</label>
            <select required class="form-control" id="department_id" name="department_id">
                <option value="">-- إختر الإدارة التابع لها --</option>
                @foreach($departments as $department)
                    <option @if($task->department_id==$department->id) selected @endif value="{{$department->id}}"> {{$department->name}} </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label>التفاصيل</label>
            <textarea name="description" cols="15" rows="5" class="form-control">{{$task->description}}</textarea>
        </div>
    </div>
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i>&nbsp;حفظ
    </button>
</div>
