@extends('layouts.app')
@section('title','List')
@section('content')
    <div class="breadcrumbs-wrap with-bg-img" data-bg="{{asset('frontend')}}/images/about/1920x266_bg1.jpg">
        <div class="container">
            <h1 class="page-title">
                Cart
            </h1>
        </div>
    </div>
    <div id="content" class="page-content-wrap">
        <div class="content-element4 ">
            <div class="align-center marginBottom">
                <h2 class="title-large style-2"><span class="TQ">{{\Cart::getTotalQuantity()}}</span> Quantity In Your Cart</h2>
                <p style="font-size: 27px; color: #f05f79; font-weight: bold;">Total: <span class="CARTTOTAL">{{ \Cart::getTotal()}}</span> @lang('tr.KD')</p>
            </div>
        </div>
        <div class="content-element8" style="padding:15px;">
            <div class="row">
                @foreach(\Cart::getContent() as $item)
                    <div class="col-lg-2">
                    <div class="produtItem">
                        <figure class="product-image" style="height: 200px;">
                            <a href="{{route('frontend.product.show',$item->attributes['item_id'])}}">
                                <img src="{{$item->attributes['img']??''}}" style="width: 100%; height: 200px;" alt="">
                            </a>
                        </figure>
                        <div style="border: 1px dashed #f05f79;padding:15px;">

                            @if(isset($item->attributes['extraimages']) && !empty($item->attributes['extraimages']))
                                <a class="greenbutton" data-fancybox="gallery-{{ $item->attributes['item_id'] }}"  href="{{$item->attributes['img']??''}}">
                                    <i class="fa fa-images"></i> معرض الصور
                                </a>
                                @foreach ($item->attributes['extraimages'] as $extra)
                                    <a style="display: none" data-fancybox="gallery-{{ $item->attributes['item_id'] }}" title="{{$item->name}}" href="{{$extra}}">
                                        <img style="" src="{{$extra}}">
                                    </a>
                                @endforeach
                                <hr/>
                            @endif
                            <p style="margin-bottom: 0;">{{$item->name}}</p>
                            <p style="margin-bottom: 0;">@lang('tr.Price'): {{$item->price}} @lang('tr.KD')</p>
                            <input class="ItemID" type="hidden" value="{{$item->id}}"/>&nbsp;
                            <input {{$item->attributes['type']=='buffet'?'readonly':''}} style="color: #848484; border: 1px solid; padding: 5px; width: 100%; margin-right: 18px; text-align: center; font-weight: bold;" type="number" value="{{$item->quantity}}" min="1" step="1" class="form-control itemQty"  placeholder="@lang('tr.Quantity')"/>
                            <hr>
                            <a href="{{route('frontend.cart.remove',$item->id)}}" style="background: transparent; color: #f05f79; border: 1px solid;" onclick="return confirm('tr.Are You Sure ?')" class="btn btn-primary col-12"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <hr>
            <div class="row cart-buttons">
                <div class="col-12">
                    <a href="{{route('frontend.cart.destroy')}}" class="btn btn-normal ml-3">@lang('tr.Empty Cart')</a>
                    <a href="{{route('frontend.checkout')}}" class="btn btn-normal ml-3">@lang('tr.Check Out')</a>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
@push('js')
    @include('cart.js')
@endpush
