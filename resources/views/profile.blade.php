@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">


    <style>
        /* Note: Try to remove the following lines to see the effect of CSS positioning */
        .affix {
            top: 0;
            width: 70%;
            z-index: 9999 !important;
        }

        .affix + .container-fluid {
            padding-top: 70px;
        }
    </style>
@stop


@section('main')
    @if(Auth::user()->level != getValueInfo('adminLevel'))
        <div class="top_part navbar-fixed-top">
            <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
            <img onclick="document.location.href = '{{route('profile')}}'" src="{{URL::asset('images/left.png')}}" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">
        </div>
    @else
        <img class="menu_icon" src="{{URL::asset('images/menuIcon.png')}}" id="menu-toggle" width="50px">
    @endif

    <div class="nav_slide">
        <div class="col-md-4 col-xs-12 add_padding ">
            <div class="box" id="test">

                <div class="box_mid2" style="background-image: url({{$user->photo}});">
                    <h2 style="color: #32245f;font-size: 24px;margin-top: 160px; ">{{$user->firstName}} {{$user->lastName}}</h2>
                </div>
                <div class="box_down">
                    <div class="down_tile active" id="test">
                        <p onclick="show_sub(this)">آزمون</p>
                    </div>
                    <div class="sub_m hiden" style="float: left;">
                        <div class="down_tile">
                            <p onclick="document.location.href = '{{route('result', ['quizId' => \App\models\Quiz::first()->id])}}'">گزارش آزمون</p>
                        </div>
                        <div class="down_tile">
                            <p onclick="document.location.href = '{{route('likesList')}}'">تعیین علاقمندی‌ها</p>
                        </div>
                    </div>
                    <div class="down_tile active">
                        <p onclick="document.location.href = '{{route('setting')}}'">تنظیمات</p>
                    </div>
                    <div class="down_tile">
                        <p onclick="document.location.href = '{{route('logout')}}'">خـــــــــروج</p>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="container-fluid">
        @if(Auth::user()->level == getValueInfo('adminLevel'))
            @include('layout.bigMenuBar')
        @else
            <img class="menu_icon" src="{{URL::asset('images/menuIcon.png')}}" id="menu-toggle" width="50px">
            <div class="top_part navbar-fixed-top">
                <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
            </div>
        @endif


        <div id="wrapper">
            @include('layout.profile')
            <div class="col-md-4"></div>
            <div class="col-md-8 col-xs-12 add_padding add_marg ">
                <div class="box" style="background-color: transparent;">
                    <div id="sticky-anchor"></div>
                    @include('layout.tabs')
                    {{--<div class="filter_part">--}}
                    {{--<button class="right_filter">برگزیده‌ها</button>--}}
                    {{--<button class="left_filter active ">همه</button>--}}
                    {{--</div>--}}
                    <div class="add_padding row" style="margin-bottom: 90px;">

{{--                        {{باید بعدا وقتی jquery زده شد با اون تطابق داده بشه}}--}}

                        {{--@foreach($contents as $content)--}}
                            {{--<p>{{$tip->name}}</p>--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div class="news_part">--}}
                                    {{--<div class="news_header">--}}
                                        {{--<p style="font-size: 2.5vh;float: right;padding-top: 10px;padding-right: 20px;font-weight: bold; cursor: pointer;"--}}
                                           {{--onclick="document.location.href = '{{route('contentShowComplete', ['id' => $content->id])}}'">{{$content->title}}</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="">--}}
                                        {{--<div class="news_pic"--}}
                                             {{--style="background-image: url('images/contentPhotos/{{$content->photo}}');">--}}
                                        {{--<div style="border: solid #3b0069 1px;height: 200px; "></div>--}}
                                        {{--<!--<img src="images/news.jpg">-->--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="news_detail">--}}
                                        {{--<p>{!! html_entity_decode($content->text) !!}</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="read-more pt-3 mt-2" style="float: left"><a--}}
                                                {{--class="btn btn-success button"--}}
                                                {{--onclick="document.location.href = '{{route('contentShowComplete', ['id' => $content->id])}}'"--}}
                                                {{--target="_blank">بیشتر بخوانید</a></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    </div>
                </div>
            </div>
        </div>
    </div>






    <!-- Bootstrap core JavaScript -->
    <script src="{{\Illuminate\Support\Facades\URL::asset('js/jquery/jquery.min.js')}}"></script>
    <script src="{{\Illuminate\Support\Facades\URL::asset('js/bootstrap.js')}}"></script>


    <script>

        //            $("div").scroll(function(){
        //                alert("done!");
        //            });
        //        $(function() {
        //            $(".container-fluid").scroll(function () {
        //                alert("done!");
        //            });
        //            sticky_relocate();
        //        });

        function show_sub(e) {
            $(".sub_m").toggleClass("hiden");
            $("#test").toggleClass("active").scrollTop(0);

        }

        var $el, $ps, $up, totalHeight;

        $(".news_detail .button").click(function () {

            totalHeight = 0;

            $el = $(this);
            $p = $el.parent();
            $up = $p.parent();
            $ps = $up.find("p:not('.read-more')");

            // measure how tall inside should be by adding together heights of all inside paragraphs (except read-more paragraph)
            $ps.each(function () {
                totalHeight += $(this).outerHeight();
            });

            $up
                    .css({
                        // Set height to prevent instant jumpdown when max height is removed
                        "height": $up.height(),
                        "max-height": 9999
                    })
                    .animate({
                        "height": totalHeight
                    });

            // fade out read-more
            $p.fadeOut();

            // prevent jump-down
            return false;

        });
    </script>
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
            $(".nav_slide").toggleClass("toggled");
            $(".menu_icon").toggleClass("toggled");
            if ($("#menu-toggle").hasClass("toggled")) {
                document.getElementById("menu-toggle").src = "images/cross.png";
            } else {
                document.getElementById("menu-toggle").src = "images/menuIcon.png";
            }

        });
        $(".right_filter").click(function (e) {
            $(".right_filter").toggleClass("active");
            $(".left_filter").toggleClass("active");
        });
        $(".left_filter").click(function (e) {
            $(".left_filter").toggleClass("active");
            $(".right_filter").toggleClass("active");

        });

        $("#wrapper").click(function (e) {

            $(".nav_slide").removeClass("toggled");
            $("#menu-toggle").removeClass("toggled");
            if ($("#menu-toggle").hasClass("toggled")) {
                document.getElementById("menu-toggle").src = "images/cross.png";
            } else {
                document.getElementById("menu-toggle").src = "images/menuIcon.png";
            }
        });

    </script>
    <!-- Menu Toggle Script -->





@stop