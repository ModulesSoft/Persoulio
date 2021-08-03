@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/quiz.css')}}">
@stop

@section('main')

    <div class="col-xs-12 persoulio-title">
        <h3>پرسولیو</h3>
    </div>

    <center class="col-xs-12 introduction" style="z-index: 100001 !important;">

        <img width="100px" height="100px" src="{{URL::asset('images/waitIcon.png')}}">


        <h5 style="font-size: 18px !important; padding: 30px; direction: rtl; line-height: 1.4; margin-right: 0 !important;">
            براى اينكه نتيجه خيلى خوبى از آزمون دريافت كنى، نيازه نظر كارشناسا و مشاوراى دانشگاهو بپرسيم. بزودى نتيجه ى آزمونتو مى تونى تو پروفايلت مشاهده كنى ... به ما سر بزن ...
        </h5>
    </center>

    <div class="col-xs-12" style="margin-top: 5%; z-index: 1000001 !important;">
        <button style="margin-top: 20px" class="myBtn" onclick="document.location.href = '{{route('logout')}}'">خروج</button>
    </div>

    <div class="dark2" style="height: 100vh"></div>
@stop