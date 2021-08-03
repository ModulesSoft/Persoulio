@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/news.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

@stop

@section('main')

    {{--<div class="col-xs-12 persoulio-title">--}}
    {{--<h3>پرسولیو</h3>--}}
    {{--</div>--}}

    {{--@include('layout.menuBar')--}}

    {{--@include('layout.bigMenuBar')--}}

    {{--<div class="totalPane">--}}

    {{--        {{$content->title . " " . $content->text . " " . $content->photo}}--}}

    {{--        <p>{{$content->text}}</p>--}}

    {{--<img src="{{URL::asset('images/contentPhotos/' . $content->photo)}}">    </div>--}}

    <div class="container-fluid">
        <div class="top_part">
            <p style="cursor: pointer;" onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
            <img onclick="document.location.href = '{{ URL::previous() }}'" src="../images/left.png" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">
        </div>
        <div style="border-style:double; margin: 0 1% 5% 1%;">
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-12" align="center">
                    {{--<div class="right_news">--}}
                    {{--<!--<img src=>-->--}}
                    {{--<div class="right_news_img" style="background-image: url('{{URL::asset('images/contentPhotos/' . $content->photo)}}')"></div>--}}
                    {{--</div>--}}
                    {{--<div class="pb-2" style="padding-bottom: 10%">--}}
                    <img class="img-responsive img-rounded" style="border: solid;border-width: thick;width: 800px"
                         src="{{URL::asset('images/contentPhotos/' . $content->photo)}}"/>
                    {{--</div>--}}
                    {{--<div class="right_news_img" style="background-image: url('{{URL::asset('images/contentPhotos/' . $content->photo)}}')"></div>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="news_detail">
                        <h3>{{$content->title}}</h3>

                        <p style="margin-left: -5%">{!! html_entity_decode($content->text) !!}}</p>
                        {{--<div style="text-align: right;">--}}
                        {{--<i class="material-icons done">done</i>--}}
                        {{--<p style="margin-top: 30px;">به این خبر اهمیت می‌دم!</p>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
        <p>اشتراک گذاری در:</p>
        <!-- Telegram -->
        <a href="tg://msg?url=www.persoulio.com&text={{$content->title."\n"}}{{strip_tags($content->text) }}" target="_blank" class="share-btn twitter">
            <i class="fa fa-twitter"><img src="{{URL::asset('images/Telegram-48.png')}}"></i>
        </a>
        <!-- instagram -->
        <a href="https://api.instagram.com/oembed?url=www.persoulio.com&text={{$content->title."\n"}}{{strip_tags($content->text) }}" target="_blank" class="share-btn google-plus">
            <i class="fa fa-google-plus"><img src="{{URL::asset('images/Instagram-48.png')}}"></i>
        </a>

        <style>
            /** Social Button CSS **/

            .share-btn {
                display: inline-block;
                /*float: left;*/
                /*position: fixed;*/
                z-index: 20;
                color: #ffffff;
                border: none;
                padding: 0.4em;
                width: 2em;
                box-shadow: 2px 2px 0 0 cornsilk;
                outline: none;
                text-align: center;
                margin: 2%;
                border-radius: 20px;
                padding-left: 4em;
            }

            .share-btn:hover {
                background-color: #f0ad4e;
                color: #f0ad4e;
            }

            .share-btn.twitter     { background: #55acee; }
            .share-btn.google-plus { background: #dd4b39; }
            .share-btn.facebook    { background: #3B5998; }
            .share-btn.stumbleupon { background: #EB4823; }
            .share-btn.reddit      { background: #ff5700; }
            .share-btn.linkedin    { background: #4875B4; }
            .share-btn.email       { background: #444444; }
        </style>

    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="{{\Illuminate\Support\Facades\URL::asset('js/jquery/jquery.min.js')}}"></script>
    <script src="{{\Illuminate\Support\Facades\URL::asset('js/bootstrap.js')}}"></script>

    <script>
        $('.carousel').carousel({
            interval: 0
        });
        $(".done").click(function (e) {
            $(".done").toggleClass("active");
        });
    </script>

@stop