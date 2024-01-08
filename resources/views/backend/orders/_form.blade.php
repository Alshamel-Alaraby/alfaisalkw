<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="contract_number">رقم العقد</label>
            <input id="contract_number" class="form-control" name="contract_number"
                value="{{ old('contract_number', $order->contract_number) }}">

        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="client_id">العميل</label>
            <div class="input-group">
                <select name="client_id" id="client_id" class="form-control select2" required>
                    <option value="">--- إختر العميل ---</option>
                    @foreach ($clients as $client)
                    <option mobile="{{$client->mobile}}" address="{{$client->address}}" @if($client->
                        id==$order->client_id) selected @endif value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-addon no-print" style="padding: 19px 5px;">
                    <a href="#" data-remote="{{route('backend.clients.create')}}" class="external" data-toggle="modal"
                        data-target="#addPersonModal">
                        <i class="fa fa-2x fa-plus-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="mobile">الهاتف</label>
            <input id="mobile" class="form-control" name="mobile" value="{{ old('mobile', $order->mobile ) }}">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="address">العنوان</label>
            <input type="text" name="address" id="address" value="{{ old('address', $order->address ) }}"
                class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="party_address">عنوان الحفل</label>
            <input type="text" name="party_address" id="party_address"
                value="{{ old('party_address', $order->party_address ) }}" class="form-control" required>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="order_day">اليوم</label>
            <input type="date" name="day" id="order_day" class="form-control" placeholder="@lang('tr.Date')"
                value="{{ old('day', $order->day??date(" Y-m-d")) }}" required>
                {{--  <input type="text" name="day" id="order_day" class="form-control" placeholder="@lang('tr.Date')" value="{{ old('day', $order->day ? \Carbon\Carbon::createFromFormat('Y-m-d', $order->day)->format('d/m/Y') : date('d/m/Y')) }}" required onfocus="(this.type='date')" onblur="(this.type='text')" pattern="\d{2}/\d{2}/\d{4}">  --}}



        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="order_from">الوقت من</label>
            <input type="time" name="start_time" value="{{ old('start_time', $order->start_time ) }}" id="order_from" class="form-control"
                placeholder="@lang('tr.From')" required>
        </div>



    </div>
    <div style="display: none;" class="col-lg-4">
        <div class="form-group">
            <label for="order_to">الوفت إلى</label>
            <input type="time" name="end_time" value="{{ old('end_time', $order->end_time ) }}" id="order_to" class="form-control"
                placeholder="@lang('tr.To')">
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">الحالة</label>
            <select id="status" class="form-control" name="status">
                @foreach($statuses as $k=>$v)
                <option {{$v==$order->status?"selected":""}} value="{{$v}}">{{trans("tr.$v")}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">تعليق على الحالة</label>
            <input class="form-control" name="comment">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="delegator_id">المندوب</label>


            <select name="delegator_id" id="delegator_id" class="form-control select2">
                @if(count(auth('admin')->user()->roles) >= 3 && auth('admin')->user()->roles[0]->id != 1 && auth('admin')->user()->roles[2]->id != 1)

                <option @if(auth('admin')->user()->id==$order->delegator_id) selected @endif value="{{
                    auth('admin')->user()->id }}">{{ auth('admin')->user()->name }}</option>
                @else
                <option value="">--- إختر المندوب ---</option>
                @foreach ($users as $user)
                <option @if($user->id==$order->delegator_id) selected @endif value="{{ $user->id }}">{{ $user->name }}
                </option>
                @endforeach
                @endif
            </select>


        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="supervisor_id">المشرف</label>
            <select name="supervisor_id" id="supervisor_id" class="form-control select2">
                <option value="">--- إختر المشرف ---</option>
                @foreach ($users as $user)
                <option @if($user->id==$order->supervisor_id) selected @endif value="{{ $user->id }}">{{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <ul class="nav  nav-pills" role="tablist">
            <li>
                <a class="nav-link active" data-toggle="pill" href="#items-list">اﻷصناف</a>
            </li>
            <li>
                <a class="nav-link" data-toggle="pill" href="#decor-list">الديكورات</a>
            </li>
            <li>
                <a class="nav-link" data-toggle="pill" href="#equipment-list">المعدات</a>
            </li>
            <li>
                <a class="nav-link" data-toggle="pill" href="#buffet-list">البوفيهات</a>
            </li>
            <li><input type="text" class="form-control p-2" style="margin-left: 10px;" id="searchInput"
                    placeholder="كلمة البحث ..."></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="items-list" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="row">
                    @php $i=0 ;$sel = array();$selected=false; @endphp
                    @if(isset($selectedProd))
                    @foreach($selectedProd as $item)
                    @php $i++ ;$sel[]=$item->id;$selected=true; @endphp
                    @include('backend.orders._item')
                    @endforeach
                    @endif
                    @php $selected=false; @endphp
                    @if($products)
                    @foreach($products->whereNotIn('id',$sel) as $item)
                    @php $i++ ; @endphp
                    @include('backend.orders._item')
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="decor-list">
                <div class="row">
                    @php $sel = array();$selected=false; @endphp
                    @if(isset($selectedDocor))
                    @foreach($selectedDocor as $item)
                    @php $i++ ;$sel[]=$item->id;$selected=true; @endphp
                    @include('backend.orders._item')
                    @endforeach
                    @endif
                    @php $selected=false; @endphp
                    @if($decors)
                    @foreach($decors->whereNotIn('id',$sel) as $item)

                    @php $i++ ; @endphp
                    @include('backend.orders._item')

                    @endforeach
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="equipment-list">
                <div class="row">
                    @php $sel = array();$selected=false; @endphp
                    @if(isset($selectedEq))
                    @foreach($selectedEq as $item)
                    @php $i++ ;$sel[]=$item->id;$selected=true; @endphp
                    @include('backend.orders._item')
                    @endforeach
                    @endif
                    @php $selected=false; @endphp
                    @if($equipments)
                    @foreach($equipments->whereNotIn('id',$sel) as $item)
                    @php $i++ ; @endphp
                    @include('backend.orders._item')
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="buffet-list">
                <div class="row">
                    @php $sel = array();$selected=false; @endphp
                    @if(isset($selectedBuffet))
                    @foreach($selectedBuffet as $item)
                    @php $i++ ;$sel[]=$item->id;$selected=true; @endphp
                    @include('backend.orders._buffet')
                    @endforeach
                    @endif
                    @php $selected=false; @endphp
                    @if($buffets)
                    @foreach($buffets->whereNotIn('id',$sel) as $item)
                    @php $i++ ; @endphp
                    @include('backend.orders._buffet')
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label>طريقة الدفع</label>
            <select name="payment_method" class="form-control paymentMethod" required>
                <option value="">إختر طريقة الدفع</option>
                <option {{$order->payment_method=='Cash'?'selected':''}} value="Cash">كاش</option>
                <option {{$order->payment_method=='Visa'?'selected':''}} value="Visa">فيزا</option>
                <option {{$order->payment_method=='Postpaid'?'selected':''}} value="Postpaid">أجل</option>
            </select>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            <label>قيمة العقد</label>
            <input id="mainAmount" onchange="setMainAmount(this)" type="number" value="{{ old('total', $order->total ) }}"
                name="total" class="form-control orderTotal0" required>


        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>العربون</label>
            <input id="deposit" onchange="setDepositAmount(this)" type="number" value="{{ old('paid', $order->paid ) }}"
                name="paid" class="form-control paid0" required>


        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>رقم الايصال</label>
            <input type="number" value="{{ old('rece_number', $order->rece_number ) }}" name="rece_number"
                class="form-control">
        </div>


    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>تاريخ الإيصال</label>
            <input type="date" value="{{ old('rece_date', $order->rece_date ) }}" name="rece_date" class="form-control">
        </div>
    </div>

</div>

<div class="row" id="disc-main">
    <div class="col-12">
        <div class="row">
            <div class="col-md-12 mb-3">
                السداد
                <span class="fa fa-plus-circle text-primary" onclick="addPayment()"></span>
            </div>

            <div class="col-md-12" id="payments">
                @isset($order)
                @foreach($order->payments as $payment)
                <div class="row">
                    <div class="col-md-1">
                        <span class="fa fa-minus-circle text-danger" onclick="del(this)"></span>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>دفعة سداد</label><input type="number" onchange="calcPayments()"
                            value="{{ old('value', $payment->value ) }}" name="payments[{{$payment->id}}][value]"
                                class="form-control paymentAmount" placeholder="دفعة سداد">


                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>رقم السند</label><input type="text" value="{{ old('receipt_number', $payment->receipt_number ) }}"
                                name="payments[{{$payment->id}}][receipt_number]" class="form-control"
                                placeholder="رفم السند">


                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>تاريخ السند</label><input type="date" value="{{ old('receipt_date', $payment->receipt_date ) }}"
                                name="payments[{{$payment->id}}][receipt_date]" class="form-control"
                                placeholder="تاريخ السند">


                        </div>
                    </div>
                </div>
                @endforeach
                @endisset
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-md-12 mb-3">
                الاضافات
                <span class="fa fa-plus-circle text-primary" onclick="addAdditionAmount()"></span>
            </div>

            <div class="col-md-12" id="additions">
                @isset($order)
                @foreach($order->additions as $addition)
                <div class="row">
                    <div class="col-md-1">
                        <span class="fa fa-minus-circle text-danger" onclick="del(this)"></span>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>مبلغ الاضافة</label><input type="number" value="{{ old('value', $addition->value ) }}"
                                onchange="calcAdditions()" name="addition_amounts[{{$addition->id}}][value]"
                                class="form-control additionAmount" placeholder="مبلغ الاضافة">


                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>بيان الاضافة</label><textarea rows="1"
                                name="addition_amounts[{{$addition->id}}][description]" class="form-control"
                                placeholder="بيان الاضافة">{{$addition->description}}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
                @endisset
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-md-12 mb-3">
                الخصومات
                <span class="fa fa-plus-circle text-primary" onclick="addDiscountAmount()"></span>
            </div>

            <div class="col-md-12" id="discounts">
                @isset($order)
                @foreach($order->discounts as $discount)
                <div class="row">
                    <div class="col-md-1">
                        <span class="fa fa-minus-circle text-danger" onclick="del(this)"></span>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>مبلغ الخصم</label>
                            <input type="number" value="{{ old('value', $discount->value ) }}" onchange="calcDiscounts()"
                                name="discount_amounts[{{$discount->id}}][value]" class="form-control discountAmount"
                                placeholder="مبلغ الخصم">



                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>بيان الخصم</label>
                            <textarea rows="1" name="discount_amounts[{{$discount->id}}][description]"
                                class="form-control" placeholder="بيان الخصم">{{$discount->description}}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
                @endisset
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>المبلغ المتبقي</label>
                            <input type="number" id="remAmount" value="0" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>










{{--<div class="row">--}}
    {{-- <div class="col-lg-4">--}}
        {{-- <div class="form-group">--}}
            {{-- <label>المبلغ المطلوب</label>--}}
            {{-- <input type="number" value="{{old('final_total')??$order->final_total}}" name="final_total"
                class="form-control final_total" required>--}}
            {{-- </div>--}}
        {{-- </div>--}}

    {{-- <div class="col-lg-4">--}}
        {{-- <div class="form-group">--}}
            {{-- <label>قيمة الخصم</label>--}}
            {{-- <input type="number" value="{{old('discount')??($order->discount??0)}}" name="discount"
                class="form-control orderDiscount" required>--}}
            {{-- </div>--}}
        {{-- </div>--}}

    {{-- <div class="col-lg-4">--}}
        {{-- <div class="form-group">--}}
            {{-- <label>المتبقى</label>--}}
            {{-- <input readonly type="number" value="{{old('due')??$order->due}}" name="due" class="form-control due"
                required>--}}
            {{-- </div>--}}
        {{-- </div>--}}
    {{--</div>--}}
{{--<div class="row">--}}
    {{-- <div class="col-md-4">--}}
        {{-- <div class="form-group">--}}
            {{-- <label>اجمالى السداد</label>--}}
            {{-- <input readonly type="number" value="{{$order->total_paid??''}}" name="total_paid"
                class="form-control">--}}
            {{-- </div>--}}
        {{-- </div>--}}

    {{--</div>--}}



<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label>ملحوظة</label>
            <textarea name="note" cols="15" rows="10" class="form-control">{{$order->note}}</textarea>
        </div>
    </div>
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i>&nbsp;حفظ
    </button>
    <a href="" class="btn btn-primary"><i class="fa fa-money"></i> متابعة السداد</a>
</div>
@push('js')
<script>
    $(document).on("change","#client_id",function(e){
            if($(this).val() != ''){
                var mobile = $(this).find('option:selected').attr('mobile');
                var address = $(this).find('option:selected').attr('address');
                $("#mobile").val(mobile);
                $("#address").val(address);
            }
        });
        $(document).on("change",".orderItemChk",function(e){

            if( $(this).is(":checked") ){
                $(this).closest(".item-row").find('.itemPrice').attr('disabled',false);
                $(this).closest(".item-row").find('.itemQty').attr('disabled',false);
                $(this).closest(".item-row").find('.itemQty').val(1);
                $(this).closest(".item-row").find('.RecivedQty').attr('disabled',false);
                $(this).closest(".item-row").find('.ItemID').attr('disabled',false);
            }else{
                $(this).closest(".item-row").find('.itemPrice').attr('disabled',true);
                $(this).closest(".item-row").find('.itemQty').attr('disabled',true);
                $(this).closest(".item-row").find('.itemQty').val("");
                $(this).closest(".item-row").find('.RecivedQty').attr('disabled',true);
                $(this).closest(".item-row").find('.ItemID').attr('disabled',true);
            }
            calculateOrderTotal();
        });
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".tab-content .produtItem").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        function calculateOrderTotal(){
            var total = 0;
            $(".orderItemChk:checked").each(function (){
                var produtItem = $(this).closest('.produtItem');
                var price = 0;
                if(produtItem.find(".itemPrice").val()){
                    price = parseFloat(produtItem.find(".itemPrice").val());
                }
                var qty = 1;
                if(produtItem.find(".itemQty").val()){
                    qty = parseFloat(produtItem.find(".itemQty").val());
                }
                total += (price * qty);
            });
            $(".orderTotal").val(total);
            $(".paid").trigger('input');
        }


        $(document).on('input','.itemPrice',function (){
            calculateOrderTotal();
        });
        $(document).on('input','.paid,.orderDiscount',function (){
            let ordertotal = parseFloat($(".orderTotal").val());
            let paid = 0;
            let orderDiscount = 0;
            if($(".orderDiscount").val()){
                orderDiscount = parseFloat($(".orderDiscount").val());
                ordertotal -= orderDiscount;
            }
            $(".final_total").val(ordertotal);
            if($('.paid').val()){
                paid = parseFloat($(this).val());
            }
            if($(".paymentMethod").val()=="Postpaid"){
                let due = ordertotal - paid;
                $(".due").val(due);
            }else{
                $(".paid").val(ordertotal);
            }

        });
        // calculateOrderTotal();
</script>




<script>
    var mainAmount = "{{old('total')??$order->total}}";
        var deposit = "{{old('paid')??$order->paid}}";
        var payments = 0;
        var additions = 0;
        var discounts = 0;

        calcPayments();
        calcAdditions();
        calcDiscounts();


        console.log(mainAmount)
        console.log(deposit)
        console.log(additions)
        console.log(discounts)


        function setMainAmount(el) {
            mainAmount = $(el).val();
            calc()
            console.log(mainAmount);
        }

        function setDepositAmount(el) {
            deposit = $(el).val();
            calc()
            console.log(deposit);
        }

        function calcPayments() {
            var sum = 0;
            $('.paymentAmount').each(function(){
                sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
            });
            payments = sum;
            calc()
            console.log(payments)
        }

        function calcAdditions() {
            var sum = 0;
            $('.additionAmount').each(function(){
                sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
            });
            additions = sum;
            calc()
            console.log(additions)
        }

        function calcDiscounts() {
            var sum = 0;
            $('.discountAmount').each(function(){
                sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
            });
            discounts = sum;
            calc()
            console.log(discounts)
        }

        function del(el) {
            $(el).parent().parent().remove()
            calcPayments();
            calcAdditions();
            calcDiscounts();
        }

        function addPayment() {

            var rnd = Math.random();

            var payment = '<div class="col-md-12">\n' +
                '                <div class="row">\n' +
                '                    <div class="col-md-1">\n' +
                '                        <span class="fa fa-minus-circle text-danger" onclick="del(this)"></span>\n' +
                '                    </div>\n' +
                '                    <div class="col-md-3">\n' +
                '                        <div class="form-group">\n' +
                '                            <label>دفعة سداد</label><input type="number" value="0" onchange="calcPayments()" name="payments['+rnd+'][value]" class="form-control paymentAmount" placeholder="دفعة سداد">\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                    <div class="col-md-3">\n' +
                '                        <div class="form-group">\n' +
                '                            <label>رقم السند</label><input type="text" name="payments['+rnd+'][receipt_number]" class="form-control" placeholder="رفم السند">\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                    <div class="col-md-3">\n' +
                '                        <div class="form-group">\n' +
                '                            <label>تاريخ السند</label><input type="date" name="payments['+rnd+'][receipt_date]" class="form-control" placeholder="تاريخ السند">\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            </div>';

            $('#payments').append(payment);
            calcPayments()
        }

        function addAdditionAmount() {
            var rnd = Math.random();
            var addition = '<div class="row">\n' +
                '                    <div class="col-md-1">\n' +
                '                        <span class="fa fa-minus-circle text-danger" onclick="del(this)"></span>\n' +
                '                    </div>\n' +
                '                    <div class="col-md-3">\n' +
                '                        <div class="form-group">\n' +
                '                            <label>مبلغ الاضافة</label><input type="number" value="0" onchange="calcAdditions()" name="addition_amounts['+rnd+'][value]" class="form-control additionAmount" placeholder="مبلغ الاضافة">\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                    <div class="col-md-6">\n' +
                '                        <div class="form-group">\n' +
                '                            <label>بيان الاضافة</label><textarea rows="1" name="addition_amounts['+rnd+'][description]" class="form-control" placeholder="بيان الاضافة"></textarea>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>'

            $('#additions').append(addition)
            calcAdditions()
        }

        function addDiscountAmount() {
            var rnd = Math.random();
            var addition = '<div class="row">\n' +
                '                    <div class="col-md-1">\n' +
                '                        <span class="fa fa-minus-circle text-danger" onclick="del(this)"></span>\n' +
                '                    </div>\n' +
                '                    <div class="col-md-3">\n' +
                '                        <div class="form-group">\n' +
                '                            <label>مبلغ الخصم</label><input type="number" value="0" onchange="calcDiscounts()" name="discount_amounts['+rnd+'][value]" class="form-control discountAmount" placeholder="مبلغ الخصم">\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                    <div class="col-md-6">\n' +
                '                        <div class="form-group">\n' +
                '                            <label>بيان الخصم</label><textarea rows="1" name="discount_amounts['+rnd+'][description]" class="form-control" placeholder="بيان الخصم"></textarea>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>'

            $('#discounts').append(addition)
            calcDiscounts()
        }



        function calc() {
            var rem = mainAmount - deposit - payments - discounts + additions
            $('#remAmount').val(rem)
            console.log(rem)
        }
</script>
@endpush
