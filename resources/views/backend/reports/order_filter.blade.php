<div class="col-xl-12 order-lg-1 order-xl-1">
    <form action="" method="">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="status">الحالة</label>
                <select id="status" class="form-control" name="status">
                    <option value="">الكل</option>
                    @foreach(\App\Enum\Status::toArray() as $k=>$v)
                        <option {{request('status')==$v?"selected":""}} value="{{$v}}">{{trans("tr.$v")}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <div class="form-group ">
                    <label>الفترة من</label>
                    <input autocomplete="off" style="direction: rtl;" name="fromdate" value="{{request()->fromdate}}" type="date" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>الفترة إلى</label>
                    <input autocomplete="off" style="direction: rtl;" name="todate" value="{{request()->todate}}" type="date" class="form-control">
                </div>
            </div>

            <div class="form-group col-md-3" style="margin-top: 25px;">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-search"></i>&nbsp;بحث
                </button>
            </div>
        </div>
    </form>
</div>
