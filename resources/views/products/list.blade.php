@extends('layouts.app')
@section('title','List')
@section('content')
    <div class="breadcrumbs-wrap with-bg-img" data-bg="{{asset('frontend')}}/images/about/1920x266_bg1.jpg">
        <div class="container">
            <h1 class="page-title">
                @lang('tr.We offer you everything you need for occasions')
            </h1>
        </div>
    </div>
    <div id="content" class="page-content-wrap">
        <div class="tabs style-2 tabs-section">
            <!--tabs navigation-->
            <ul class="tabs-nav clearfix">
                <li>
                    <a class="tablink" href="#itemsTab">@lang('tr.Items')</a>
                </li>
                <li>
                    <a class="tablink" href="#buffetsTab">@lang('tr.Buffet')</a>
                </li>
                <li>
                    <a class="tablink" href="#DecorTab">@lang('tr.Decor')</a>
                </li>
            </ul>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-content">
                        <div id="itemsTab">
                            <div class="main-navigation filterUl">
                                <ul>
                                    <li><a rel="" href="#" class="btn btn-info filter active">@lang('tr.All')</a></li>
                                    @foreach(\App\Category::where('show_in_home',1)->get() as $cat)
                                        <li>
                                            <a rel="{{$cat->name}}" class="btn btn-primary filter" href="">{{$cat->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="row">
                                @php $i=0 ;$sel = array();$selected=false; @endphp
                                @foreach($products as $item)
                                    @php $i++ ; @endphp
                                    @include('products._item',['selected'=>false])
                                @endforeach
                            </div>
                        </div>
                        <div id="buffetsTab">
                            <div class="main-navigation filterUl">
                                <ul>
                                    <li><a rel="" href="#" class="btn btn-info filter active">@lang('tr.All')</a></li>
                                    @foreach(\App\BuffetCategory::get() as $cat)
                                        <li>
                                            <a rel="{{$cat->name}}" class="btn btn-primary filter" href="">{{$cat->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="row">
                                @php $i=0 ;$sel = array();$selected=false; @endphp
                                @foreach($buffets as $item)
                                    @php $i++ ; @endphp
                                    @include('products._buffet',['selected'=>false])
                                @endforeach
                            </div>
                        </div>
                        <div id="DecorTab">
                            <div style="display: none;" class="main-navigation filterUl">
                                <ul>
                                    <li><a rel="" href="#" class="btn btn-info filter active">@lang('tr.All')</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                @php $i=0 ;$sel = array();$selected=false; @endphp
                                @foreach($decors as $item)
                                    @php $i++ ; @endphp
                                    @include('products._item',['selected'=>false])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-12">

            <a href="{{route('frontend.cart.show')}}" class="btn btn-normal ml-3">@lang('tr.Shopping Cart')</a>
            <a href="{{route('frontend.checkout')}}" class="btn btn-normal ml-3">@lang('tr.Check Out')</a>
        </div>
@stop
@push('css')
    <style>
        .filterUl ul li{
            padding: 0px 5px;
        }
        .filterUl{
            margin-bottom: 10px;
        }
        .filterUl .filter{
            background: #eee;
            border-radius: 5px;
            font-weight: bold;
        }
        .filterUl .btn:not(.btn-small):hover {
            background: #f9728a;
            color: #fff;
        }

        .filterUl .active {
            background: #f9728a;
            color: #fff;
            font-weight: bold;
        }
    </style>
@endpush
@push('js')
    <script>
        $(function () {
            $(document).on("change", ".orderItemChk", function (e) {
                if ($(this).is(":checked")) {
                    $(this).closest(".produtItem").find('.itemPrice').attr('disabled', false);
                    $(this).closest(".produtItem").find('.itemQty').attr('disabled', false);
                    $(this).closest(".produtItem").find('.itemQty').val(1);
                    $(this).closest(".produtItem").find('.ItemID').attr('disabled', false);
                    AddToCart($(this).closest(".produtItem").find('.ItemID').val(),1);
                } else {
                    $(this).closest(".produtItem").find('.itemPrice').attr('disabled', true);
                    $(this).closest(".produtItem").find('.itemQty').attr('disabled', true);
                    $(this).closest(".produtItem").find('.itemQty').val("");
                    $(this).closest(".produtItem").find('.ItemID').attr('disabled', true);
                    removeItemCart($(this).closest(".produtItem").find('.ItemID').val());
                }
            });

        });
        $(".filter").on("click", function(e) {
            e.preventDefault();
            $(".filterUl .active").removeClass('active');
            $(this).addClass("active");
            var value = $(this).attr('rel');
            $(".tabs-content .produtItem").filter(function() {
                $(this).toggle($(this).text().indexOf(value) > -1)
            });
        });
        $(".tablink").on("click", function() {
            var tabid = $(this).attr('href');
            $(tabid).find('.filter:first').trigger('click');
        });

    </script>
    @include('cart.js')
@endpush
