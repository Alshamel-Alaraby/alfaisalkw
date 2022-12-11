@extends('layouts.app')
@section('title','List')
@section('content')
<div id="content" class="page-content-wrap">
    <div class="breadcrumbs-wrap with-bg-img" data-bg="{{asset('frontend')}}/images/about/1920x266_bg1.jpg">
        <div class="container">
            <h1 class="page-title">
                @lang('tr.We offer you everything you need for occasions')
            </h1>
        </div>
    </div>
    <div class="page-section">
        <div class="container wide">
            <div class="content-element4">
                <div class="align-center">
                    <h2 class="title-large style-2">{{$category->name}}</h2>
                </div>
            </div>
            <div class="icons-box type-2 style-4 color-style-2">
                @foreach($list as $b)
                    <div class="icons-wrap">
                        <div class="icons-img-col" data-bg="{{optional($b->getFirstMedia('images'))->getUrl()}}" style="background-image: url({{optional($b->getFirstMedia('images'))->getUrl()}});"></div>
                        <div class="icons-item">
                            <div class="item-box produtItem">
                                <h2 class="icons-box-title" style="color: #f05f79;">
                                    {{$b->title}}
                                </h2>
                                <p>@lang('tr.No Members'): {{$b->number_attendence}}</p>
                                <p>@lang('tr.Price'): {{$b->price}}</p>
                                <p>
                                    {{$b->description}}
                                </p>
                                <a rel="buffet_{{$b->id}}" href="" class="addItemToCart btn btn-small pull-right" >
                                    <i class="fa fa-cart-plus"></i> @lang('tr.Add To Cart')
                                </a>
                                <a href="{{route('frontend.getBuffetDetails',$b->id)}}" class="btn btn-small">@lang('tr.More')</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop
@push('js')
    @include('cart.js')
@endpush
