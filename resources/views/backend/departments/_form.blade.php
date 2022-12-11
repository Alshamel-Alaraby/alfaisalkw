
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="name">الأسم</label>
            <input type="text" value="{{$department->name??''}}" name="name" id="name" class="form-control" required>
        </div>
    </div>
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i>&nbsp;حفظ
    </button>
</div>
