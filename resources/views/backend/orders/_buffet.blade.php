@php
$img = optional($item->getFirstMedia('images'))->getUrl();
@endphp
<div class="col-lg-2 produtItem">
    <div class="form-group text-center">
        @if($img)
            <img style="height: 100px;" src="{{$img}}" class="img-responsive img-thumbnail">
        @endif
        <div class="item-row">
            <label for="">{{$item->title}}</label>
            <input @if(!$selected) disabled @endif class="ItemID" type="hidden" value="" name="detail[{{$i}}][item_id]" />&nbsp;
            <input @if($selected) checked @endif class="custom-checkbox form-control orderItemChk" type="checkbox" value="{{$item->id}}" name="detail[{{$i}}][buffet_id]" />&nbsp;
            <br>
            <label class="text-primary">السعر</label>
            <input @if(!$selected) disabled @endif  type="number" value="{{$item->pivot->price??$item->price}}" name="detail[{{$i}}][price]" class="form-control itemPrice" placeholder="السعر">
            <input @if(!$selected) disabled @endif type="hidden" value="{{$item->pivot->qty??1}}" name="detail[{{$i}}][qty]" class="form-control itemQty"/>
            <input @if(!$selected) disabled @endif type="hidden" value="{{$item->pivot->recived_qty??1}}" name="detail[{{$i}}][recived_qty]" class="form-control RecivedQty"/>
        </div>
    </div>
</div>
