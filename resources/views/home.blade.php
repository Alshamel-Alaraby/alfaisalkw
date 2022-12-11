@extends('layouts.app')
@section('title','Home')
@section('content')
    <!-- - - - - - - - - - - - - - Revolution Slider - - - - - - - - - - - - - - - - -->
    <div class="rev-slider-wrapper">

        <div id="rev-slider" class="rev-slider dots-white tp-simpleresponsive"  data-version="5.0">
            <ul>
                @foreach($sliders as $slider)
                    <li data-transition="fade">
                        <img src="{{optional($slider->getFirstMedia('images'))->getUrl()}}" class="rev-slidebg" alt="">
                        <!-- - - - - - - - - - - - - - Layer 1 - - - - - - - - - - - - - - - - -->
                        <div class="tp-caption tp-resizeme scaption-white-large"
                             data-x="['center','center','center','center']" data-hoffset="0"
                             data-y="['middle','middle','middle','middle']" data-voffset="-50"
                             data-whitespace="nowrap"
                             data-frames='[{"delay":450,"speed":2000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[175%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
                             data-responsive_offset="on"
                             data-elementdelay="0.05"  >{{$slider->name}}
                            <br>
                            <a href="{{$slider->link?:route('frontend.list')}}" style="font-size:20px;text-align:center;background:#f05f79;padding:10px;color:white;font-family:tahoma;">@lang('tr.Reserve Your Occasions')</a>
                        </div>
                    </li>
                @endforeach
            </ul>

        </div>

    </div>
    <!-- - - - - - - - - - - - - - End of Slider - - - - - - - - - - - - - - - - -->
    <div class="secondmenu">
        <div class="container wide">
            <ul>
                <li><i class="fas fa-comments fa-2x"></i><span class="hints">@lang('tr.The ability to respond and communicate')</span></li>
                <li><i class="fas fa-cogs fa-2x"></i><span   class="hints">@lang('tr.Occasions Management')</span></li>
                <li><i class="fas fa-tasks fa-2x"></i><span  class="hints" >@lang('tr.Orgainze Occasions')</span></li>
                <li><i class="fas fa-history fa-2x"></i><span   class="hints" >@lang('tr.24 hours service')</span></li>
                <li><i class="fas fa-file-signature fa-2x"></i><span   class="hints" >@lang('tr.Contract Guarantee')</span></li>
            </ul>
        </div>

    </div>
    <div class="page-section">
        <div class="container wide">
            <div class="content-element4">
                <div class="align-center">
                    <h2 class="title-large style-2">@lang('tr.Make your day is nice from start to end')</h2>
                    <p class="p_description" >@lang('tr.We offer you everything you need for occasions')</p>
                </div>
            </div>
            <div class="icons-box type-2 style-2 color-style-2 item-col-3">
                <!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->
                @foreach($buffetList as $b)
                    <div class="icons-wrap">
                    <div class="icons-item">
                        <div class="item-box bg_card"  data-bg="{{optional($b->getFirstMedia('images'))->getUrl()}}">
                            <a href="/services#tab-30" class="overlink"></a>
                            <div class="box-wrap">
                                <div id="svg-ring-1" class="svg-icon"></div>
                                <h2 class="icons-box-title">{{$b->name}}</h2>
                            </div>
                        </div>
                        <div class="item-box with-bg">
                            <div class="box-wrap">
                                <div id="svg-ring-2" class="svg-icon"></div>
                                <h2 class="icons-box-title pink_color">{{$b->name}}</h2>
                                <p>{{$b->description}}</p>
                                <a href="{{route('frontend.getBuffet',$b->id)}}" class="btn btn-small">@lang('tr.More')</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="page-section">
        <div class="container wide">
            <div class="content-element4">
                <h2 class="textCenter title-large">@lang('tr.Our Achives')</h2>
                <p class="p_description" >
                    @lang('tr.We have had many weddings, birthdays and special occasions')
                </p>
            </div>
            <div class="carousel-type-2">
                <div class="entry-box owl-carousel owl-nav-outside" data-max-items="3" data-item-margin="30">
                    @foreach($gallery as $g)
                        <div class="entry-col">
                        <!-- Entry post -->
                        <div class="entry">
                            <div class="thumbnail-attachment">
                                <img src="{{optional($g->getFirstMedia('images'))->getUrl()}}" alt="{{$g->title}}">
                            </div>
                            <div class="entry-body">
                                <h4 class="entry-title">{{$g->title}}</h4>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
