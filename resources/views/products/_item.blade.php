@php
    $img = optional($item->getFirstMedia('images'))->getUrl();
@endphp
<div class="col-lg-2 produtItem">
    <div class="text-center">
        <figure class="product-image" style="height: 200px;">
            <a title="{{$item->name}}" href="{{route('frontend.product.show',$item->id)}}">
                <img src="{{$img}}" style="width: 100%; height: 200px;" alt="">
            </a>
        </figure>
        <div style="border: 1px dashed #f05f79;padding:15px;text-align: center;">
            <p style="font-weight: bold; color: #f05f79;text-align: center">{{optional($item->category)->name}}</p>
            <p>{{$item->name}}</p>
            @if($item->has_price)
                <p>@lang('tr.Price'): {{$item->price}} @lang('tr.KD')</p>
            @endif
            <input class="form-control orderItemChk" type="checkbox" value="item" name="detail[{{$i}}][item_id]" />&nbsp;
            <input disabled class="ItemID" type="hidden" value=item_{{$item->id}}"" name="detail[{{$i}}][buffet_id]" />
            <input @if(!$item->has_price) style="display: none;" @endif  @if(!$selected) disabled @endif  type="hidden" value="{{$item->price}}" name="detail[{{$i}}][price]" class="form-control itemPrice" placeholder="@lang('tr.Price')">
            <input @if($item->has_qty) style="color: #848484; border: 1px solid; padding: 5px; width: 100%; text-align: center; font-weight: bold;" @else style="display: none;" @endif disabled type="number" value="" min="1" step="1" name="detail[{{$i}}][qty]" class="form-control itemQty"  placeholder="@lang('tr.Quantity')"/>
            <a style="margin-top: 10px;" class="btn btn-primary" href="{{route('frontend.product.show',$item->id)}}">@lang('tr.More')</a>
        </div>
    </div>
</div>
