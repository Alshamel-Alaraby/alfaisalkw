
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="name">الأسم</label>
            <input type="text" value="{{$client->name??''}}" name="name" id="name" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="email">البريد الإلكترونى</label>
            <input type="email" value="{{$client->email??''}}" name="email" id="email" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="mobile">الهاتف</label>
            <input type="text" name="mobile" value="{{$client->mobile??''}}" id="mobile" class="form-control" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="address">العنوان</label>
            <input type="text" name="address" id="address" value="{{$client->address??''}}" class="form-control">
        </div>
    </div>
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i>&nbsp;حفظ
    </button>
</div>
