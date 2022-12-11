@extends('layouts.app')
@section('title','List')
@section('content')
    <div id="content" class="page-content-wrap">
        <div class="breadcrumbs-wrap with-bg-img" data-bg="{{asset('frontend')}}/images/about/1920x266_bg1.jpg">
            <div class="container">
                <h1 class="page-title">
                   {{$buffet->title}}
                </h1>
            </div>
        </div>
        <div class="products-holder item-col-3">
            @foreach($list as $item)
                <div class="product">
                    <figure class="product-image">
                        <a href="{{route('frontend.product.show',$item->id)}}">
                            <img src="{{optional($item->getFirstMedia('images'))->getUrl()}}" style="width: 420px; height: 330px;" alt="">
                        </a>
                    </figure>
                    <div class="product-description">
                        <h5 class="product-name">
                            <a href="{{route('frontend.product.show',$item->id)}}">{{$item->name}}</a><br/>
                           <p> @lang('tr.Quantity'): {{$item->pivot->qty}}</p>
                        </h5>
                    </div>
                </div>
            @endforeach
    </div>
@stop
