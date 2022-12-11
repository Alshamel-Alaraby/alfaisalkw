@extends('layouts.app')
@section('title','About')
@section('content')
    <div class="breadcrumbs-wrap with-bg-img" data-bg="{{optional($page->getFirstMedia('images'))->getUrl()}}" style="background-image: url(&quot;{{asset('frontend')}}/images/about/1920x266_bg1.jpg&quot;);">
        <div class="container">
            <h1 class="page-title">{{$page->title}}</h1>
        </div>
    </div>
    <div class="page-section">

        <div class="container wide">
            <div class="container wide">
                <div class="content-element">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
@stop
