@php
$img = optional($item->getFirstMedia('images'))->getUrl();
@endphp
<div class="col-lg-2 produtItem">
    <div class="form-group text-center">
        @if($img)
            <img style="height: 100px;" src="{{$img}}" class="img-responsive img-thumbnail">
        @endif
        <div class="item-row">
            <label for="">{{$item->name}}</label>
            <input @if($selected) checked @endif class="custom-checkbox form-control orderItemChk" type="checkbox" value="{{$item->id}}" name="detail[{{$i}}][item_id]" />&nbsp;
            <br>
            <label @if(!$item->has_price) style="display: none;" @endif class="text-primary">السعر</label>
            <input @if(!$item->has_price) style="display: none;" @endif  @if(!$selected) disabled @endif  type="number" value="{{$item->pivot->price??$item->price}}" name="detail[{{$i}}][price]" class="form-control itemPrice" placeholder="السعر">
            <br/>
            <label @if(!$item->has_qty) style="display: none;" @endif class="text-primary">الكمية المطلوبة</label>
            <input @if(!$item->has_qty) style="display: none;" @endif @if(!$selected) disabled @endif type="number" value="{{$item->pivot->qty??''}}" min="0" step="1" name="detail[{{$i}}][qty]" class="form-control itemQty"  placeholder="الكمية"/>
            <input @if(!$selected) disabled @endif class="ItemID" type="hidden" value="" name="detail[{{$i}}][buffet_id]" />&nbsp;
            <br/>
            <label @if($item->type=="equipments" && $order->id) style="display: block"  @else style="display: none;" @endif class="text-primary">الكمية المسترجعة</label>
            <input @if($item->type=="equipments" && $order->id) style="display: block"  @else style="display: none;" @endif @if(!$selected) disabled @endif type="number" value="{{$item->pivot->recived_qty??''}}" min="0" step="1" name="detail[{{$i}}][recived_qty]" class="form-control RecivedQty"  placeholder="الكمية المسترجعة"/>
        </div>
    </div>
</div>
