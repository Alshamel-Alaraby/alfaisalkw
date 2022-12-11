@extends('layouts.app')
@section('title','Details')
@section('content')
    <div class="breadcrumbs-wrap with-bg-img" data-bg="{{asset('frontend')}}/images/about/1920x266_bg1.jpg">
        <div class="container">
            <h1 class="page-title">
                {{$item->name}}
            </h1>
        </div>
    </div>
    <div id="content" class="page-content-wrap">
        <div class="container wide">
            <div class="col-lg-12 col-md-12">
                <div class="products-holder">
                    <div class="row">
                        <div class="col-lg-4">
                            <img style="width: 100%; border: 2px dashed #f05f7999;" src="{{optional($item->getFirstMedia('images'))->getUrl()}}" alt="" srcset="">
                        </div>
                        <div class="col-lg-8">
                            <h4>{{$item->name}}</h4>
                            <hr>
                            <p>{{$item->description}}</p>
                            <hr>
                            <h5 style="font-family:tahoma;">@lang('tr.Price'): {{$item->price}} @lang('tr.KD')</h5>

                            <hr>
                            <input type="number" style="border: 2px dashed #f05f79; color: #f05f79; padding: 10px; width: 30%; font-weight: bold; text-align: center;" name="quantity" value="1" min="1" step="1" id="requiredQty">
                            <hr>
                            <a rel="item_{{$item->id}}" href="" class="addItemToCart btn btn-primary " >
                                <i class="fa fa-cart-plus"></i> @lang('tr.Add To Cart')
                            </a>
                        </div>
                        @if(\Cart::getContent()->has('item_'.$item->id))
                            @foreach ($item->getMedia('extraimages') as $extra)
                                <div class="col-md-3">
                                    <a data-fancybox="ajax-gallery-1" title="{{$item->name}}" href="{{$extra->getUrl()}}">
                                        <img style="" src="{{$extra->getUrl()}}">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- Product -->
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
@push('js')
    @include('cart.js')
@endpush
