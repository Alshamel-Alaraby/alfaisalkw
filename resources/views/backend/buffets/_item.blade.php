@php
$img = optional($item->getFirstMedia('images'))->getUrl();
@endphp
<div class="col-lg-2 produtItem">
    <div class="form-group text-center">
        @if($img)
            <img src="{{$img}}" class="img-responsive img-thumbnail">
        @endif
        <div class="item-row">
            <label for="">{{$item->name}}</label>
            <input @if($selected) checked @endif class="custom-checkbox form-control buffetItemChk" type="checkbox" value="{{$item->id}}" name="detail[{{$i}}][item_id]" />&nbsp;
            <br>
            <label @if(!$item->has_qty) style="display: none;" @endif class="text-primary">Required Qty</label>
            <input @if(!$item->has_qty) style="display: none;" @endif @if(!$selected) disabled @endif type="number" value="{{$item->pivot->qty??1}}" min="0" step="1" name="detail[{{$i}}][qty]" class="form-control itemQty"  placeholder="Quantity"/>
        </div>
    </div>
</div>
