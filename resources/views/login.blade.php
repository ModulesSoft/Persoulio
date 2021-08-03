@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/login.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('main')

    <style>

        @media only screen and (max-width: 767px) {
            .btnWidthEntry {
                width: 55% !important;
                margin-right: 5%;
                float: right;
                min-width: 55%;
            }

            .btnWidthRegistry {
                width: 35% !important;
                float: right;
                ‍ min-width: 35%;
            }
        }


    </style>
    {{--<div class="off">--}}
    {{--<div style="cursor: pointer" class="col-xs-12 logo" onclick="document.location.href = '{{route('home')}}'">--}}
    {{--<p style="font-size: 80px; color: #1e0035; font-family: ghasem">پرسولیو</p>--}}
    {{--</div>--}}
    {{--<form class="col-xs-12 myForm" method="post" action="{{route('login')}}">--}}

    {{--<div class="col-xs-12 sign-in-inputs">--}}
    {{--<div class="col-xs-12" style="max-height: 10%">--}}
    {{--<div class="border">--}}
    {{--<input name="username" class="myInput firstInput" type="text" placeholder="شماره ی دانشجویی یا نام کاربری">--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="col-xs-12" style="max-height: 10%">--}}
    {{--<div class="border">--}}
    {{--<input name="password" class="myInput" type="password" placeholder="رمز عبور">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="col-xs-12 btn-group">--}}
    {{--<div class="col-xs-12">--}}
    {{--@if(!empty($err))--}}
    {{--<p style="color: white" id="err">{{$err}}</p>--}}
    {{--@endif--}}
    {{--<span style="background-color: #1e0035 !important; margin-top: 0 !important;" onclick="document.location.href = '{{route('signUp')}}'" class="btn btnWidthRegistry myBtn btn-primary">ثبت نام</span>--}}
    {{--<input type="submit" class="btn btnWidthEntry btn-success myBtn" style="margin-top: 0 !important;" value="ورود">--}}
    {{--</div>--}}

    {{--<div class="col-xs-12 warning" style="margin-top: 100px; height: 150px !important;">--}}
    {{--<a style="color: white; font-size: 20px; font-weight: bolder; font-weight: bolder" href="{{route('resetPas')}}">فراموش کردن رمزعبور</a>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</form>--}}
    {{--</div>--}}
    <div class="container-fluid">
        <form method="post" action="{{route('login')}}">
            {{csrf_field()}}
            <div class="top_part">
                <div class="top_part_2">
                    <h2>پرسولیو</h2>
                </div>
            </div>
            <div class="user">
                <input class="user_1" name="username" placeholder="شماره دانشجویی و یا نام کاربری"></input>
                <i class="material-icons user_logo"
                   style="margin-top: 2px;margin-right: 3px;font-size: 6vh;color: #ada6b8;">account_circle</i>
            </div>
            <div class="user">
                <input class="user_1 user_2" name="password" type="password" style="direction: rtl;font-size: 15px;"
                       placeholder="رمز عبور"></input>
                <i class="material-icons user_logo_2" style="font-size: 3.5vh;color: #847594;">lock_open</i>
            </div>
            <div class="but">
                @if(!empty($err))
                    <p style="color: white" id="err">{{$err}}</p>
                @endif
                <button class="but_1" onclick="document.location.href = '{{route('signUp')}}'" type="button">ثبت‌نام
                </button>
                <button class="but_2 " type="submit" value="ورود">ورود</button>
                <button class="forget" onclick="document.location.href = '{{route('resetPas')}}'" type="button">فراموشی
                    رمز عبور
                </button>

            </div>
            <div class="down">
                <button onclick="location.href='{{route('home')}}'" type="button">آنچه درباره پرسولیو باید بدانید
                </button>
                <p style="color: #e0a53f"><a href="http://www.instagram.com/persoulio/" class="fa fa-instagram"><a
                                href="http://www.instagram.com/persoulio/" style="
                        text-decoration: none;color: #e0a53f;">ورود به اینستاگرام</a></p>
                <style>/* for instagram link */
                    .fa {
                        padding: 10px;
                        font-size: 20px;
                        /*width: 100%;*/
                        /*height: 100%;*/
                        text-align: center;
                        text-decoration: none;
                        border-radius: 50%;
                    }

                    .fa:hover {
                        opacity: 0.7;
                        background: white;
                        text-decoration-line: none;
                    }

                    .fa-instagram {
                        /*background: #e0a53f;*/
                        color: #e0a53f;
                    }

                    fa-instagram:before {
                        content: "\f16d"
                    }
                </style>
            </div>
        </form>
    </div>
@stop

