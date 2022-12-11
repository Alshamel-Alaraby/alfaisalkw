@php
    $img = optional($item->getFirstMedia('images'))->getUrl();
@endphp
<div class="col-lg-2 produtItem">
    <div class="text-center">
        <figure class="product-image" style="height: 200px;">
            <a href="">
                <img src="{{$img}}" style="width: 100%; height: 200px;" alt="">
            </a>
        </figure>
        <div style="border: 1px dashed #f05f79;padding:15px;text-align: center;">
            <p style="font-weight: bold; color: #f05f79;text-align: center">{{optional($item->category)->name}}</p>
            <p>{{$item->title}}</p>
            <p>@lang('tr.Price'): {{$item->price}} @lang('tr.KD')</p>
            <input @if(!$selected) disabled @endif class="ItemID" type="hidden" value="buffet_{{$item->id}}" name="detail[{{$i}}][item_id]" />&nbsp;
            <input @if($selected) checked @endif class="custom-checkbox form-control orderItemChk" type="checkbox" value="buffet" name="detail[{{$i}}][buffet_id]" />
            <input @if(!$selected) disabled @endif  type="hidden" value="{{$item->price}}" readonly name="detail[{{$i}}][price]" class="form-control itemPrice" placeholder="السعر">
            <input @if(!$selected) disabled @endif type="hidden" value="{{1}}" name="detail[{{$i}}][qty]" class="form-control itemQty"/>
            <input @if(!$selected) disabled @endif type="hidden" value="" name="detail[{{$i}}][recived_qty]" class="form-control RecivedQty"/>
        </div>
    </div>
</div>
