
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">العميل</label>
            <select name="client_id" id="client_id" class="form-control select2" required>
                <option value="">--- إختر العميل ---</option>
                @foreach (\App\Client::get() as $client)
                    <option @if(isset($client->id) && $client->id==optional($payment->order)->client_id) selected @endif value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="name">رقم الطلب</label>
            <select id="order_id" class="form-control select2" name="order_id">
                <option value="">إختر الطلب</option>
                @if(isset($payment->order_id))
                    <option selected value="{{$payment->order_id}}">رقم الطلب {{$payment->order_id}}</option>
                @endif
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="name">رقم الايصال</label>
            <input type="text" value="{{$payment->receipt_number??''}}" name="receipt_number" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="receipt_date">تاريخ الايصال</label>
            <input type="date" name="receipt_date" id="receipt_date" class="form-control" placeholder="@lang('tr.Date')"  value="{{ $payment->receipt_date??date("Y-m-d") }}" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="value">المبلغ المدفوع</label>
            <input type="number" value="{{$payment->value??''}}" name="value" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="value">ملاحظات</label>
            <input type="text" value="{{$payment->note??''}}" name="note" class="form-control">
        </div>
    </div>
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i>&nbsp;حفظ
    </button>
</div>
@push('js')
    <script>
        $(document).on("change","#client_id",function(e) {
            e.preventDefault();
            var personId = $(this).val();
            if(!personId) return false;
            $.ajax({
                url: "{{route('backend.getPersonInvoices')}}",
                data:{id:personId},
                type: 'GET',
                success: function (result) {
                    var data = JSON.parse(result);
                    $("#order_id").find('option').not(':first').remove();
                    $("#order_id").append(data.list);
                }
            });
        });
    </script>
@endpush
