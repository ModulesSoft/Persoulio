@extends('layout.myStructure')

@section('header')
    @parent
    {{--<link rel="stylesheet" href="{{URL::asset('css/quiz.css')}}">--}}


    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/alerts.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">
    <link rel="stylesheet" href="{{URL::asset('js/dist/css/swiper.min.css')}}">

    <style>

        .textSlider {
            width: 60%;
            height: 100%;
            position: relative;
            z-index: 10001;
        }

        .round-btn {
            border-radius: 50%;
            border: 2px solid white;
            width: 15px;
            height: 15px;
            float: right;
            margin-right: 4px;
        }

        .btn-container {
            position: absolute;
            left: 20%;
            z-index: 10001;
            top: 75%;
        }

        .btn-container > div {
            cursor: pointer;
            margin-right: 5px;
        }

        .startQuiz {
            margin-top: 10px !important;
        }

        #text {
            color: white;
            padding-right: 20px !important;
            padding-left: 20px !important;
            font-size: 20px;
        }

        @media only screen and (min-width: 767px) {
            .textSlider {
                width: 400px;
                margin-top: 30px;
                height: 200px;
            }
            .btn-container {
                left: 46% !important;
            }
            #text > p {
                width: 50%;
                margin-right: 25%;
            }
            #text {
                height: fit-content;
                overflow: hidden !important;
            }
            .confirmationCheckBox {
                width: 50px;
                float: right;
            }
            .confirmationText {
                float: right;
            }
            .margin35PercentOnScreen {
                margin-right: 35%;
            }
        }

        @media only screen and (max-width: 767px) {
            .confirmationCheckBox {
                width: 10%;
                float: right;
            }
            .confirmationText {
                 width: 90%;
                 float: right;
            }
        }

    </style>

    {{--<script>--}}

        {{--var text1 = "سلام" + "<br/>" +--}}
        {{--"نتايج آزمونی كه پيشروى شماست می تونه بر تصميمات مهم زنديگيتون تاثير بزرگى داشته باشه." + "<br/>" +--}}
                {{--"خواهش مى كنيم چند نكته اى رو كه در ادامه بهتون ارائه می شه، با دقت مطالعه كنيد. ";--}}

        {{--var text2 = "این پرسش نامه شامل ۶۰ سوال است. هر یک از جملات را با دقت بخوانید و پاسخی که بیشترین تطبیق را با فکر یا احساس شما دارد علامت بزنید. " +--}}
                {{--"<br/>" + "معمولا اولین پاسخی که به ذهنتان می رسد پاسخ درست تری نسبت به آن چیزی است که پس از فکر کردن، تصمیم می گیرید.";--}}

        {{--var text3 = "توجه داشته باشید که پاسخ درست یا غلط وجود ندارد. بنابراین سعی کنید پاسخی را انتخاب کنید که نشان دهنده احساس واقعی شما در حال حاضر باشد، نه آنچه که دوست دارید باشید.";--}}

        {{--var text4 = "بهتون اطمينان مي دهيم كه نتايج شما در اين آزمون كاملا محرمانه و فقط در اختيار متخصصين مركز مشاوره ى ماست و براى بهره مندی شما مورد استفاده قرار مى گيرد.";--}}
        {{--var currIdx;--}}

        {{--var pic1 = "{{URL::asset('images/warning_icon.png')}}";--}}
        {{--var pic2 = "{{URL::asset('images/checkicon.png')}}";--}}
        {{--var pic3 = "{{URL::asset('images/wrong_icon.png')}}";--}}
        {{--var pic4 = "{{URL::asset('images/lock_icon.png')}}";--}}
        {{--var x;--}}

        {{--$(document).ready(function () {--}}
            {{--currIdx = 0;--}}
            {{--$("#text").empty().append("<p>" + text1 + "</p>");--}}
            {{--$("#btn_0").css('background', 'white');--}}
            {{--$("#icon").attr('src', pic1);--}}
            {{--x = parseInt($(".mainRow").css('height').split("px")[0]) + 100;--}}
            {{--$(".dark2").css('min-height', x + "px");--}}
            {{--$(".btn-container").css('min-height', '100px').css('max-height', '100px').css('height', '100px');--}}

        {{--});--}}

        {{--function changeSlider(idx) {--}}

            {{--currIdx = idx;--}}

            {{--$(".round-btn").css('background', '');--}}
            {{--switch(idx) {--}}
                {{--case 0:--}}
                    {{--$("#text").empty().append("<p>" + text1 + "</p>");--}}
                    {{--$("#btn_0").css('background', 'white');--}}
                    {{--$("#startQuiz").addClass('hidden');--}}
                    {{--$("#icon").attr('src', pic1);--}}
                    {{--$("#start").css("visibility", 'hidden');--}}
                    {{--$(".btn-container").css('min-height', '100px').css('max-height', '100px').css('height', '100px');--}}
                    {{--$(".dark2").css('min-height', x + "px");--}}
                    {{--break;--}}
                {{--case 1:--}}
                    {{--$("#text").empty().append("<p>" + text2 + "</p>");--}}
                    {{--$("#btn_1").css('background', 'white');--}}
                    {{--$("#startQuiz").addClass('hidden');--}}
                    {{--$("#icon").attr('src', pic2);--}}
                    {{--$("#start").css("visibility", 'hidden');--}}
                    {{--$(".dark2").css('min-height', (x + 100) + "px");--}}
                    {{--$(".btn-container").css('min-height', '200px').css('max-height', '200px').css('height', '200px');--}}
                    {{--break;--}}
                {{--case 2:--}}
                    {{--$("#text").empty().append("<p>" + text3 + "</p>");--}}
                    {{--$("#btn_2").css('background', 'white');--}}
                    {{--$("#startQuiz").addClass('hidden');--}}
                    {{--$("#icon").attr('src', pic3);--}}
                    {{--$("#start").css("visibility", 'hidden');--}}
                    {{--$(".dark2").css('min-height', x + "px");--}}
                    {{--$(".btn-container").css('min-height', '100px').css('max-height', '100px').css('height', '100px');--}}
                    {{--break;--}}
                {{--case 3:--}}
                    {{--$("#text").empty().append("<p>" + text4 + "</p>");--}}
                    {{--$("#btn_3").css('background', 'white');--}}
                    {{--$("#startQuiz").removeClass('hidden');--}}
                    {{--$("#icon").attr('src', pic4);--}}
                    {{--$("#start").css("visibility", '');--}}
                    {{--$(".dark2").css('min-height', (x + 100) + "px");--}}
                    {{--$(".btn-container").css('min-height', '200px').css('max-height', '200px').css('height', '200px');--}}
                    {{--break;--}}
            {{--}--}}
        {{--}--}}
        {{----}}
    {{--</script>--}}

    <script>

        window.addEventListener('load', function(){

            var touchsurface = document.getElementById('touchsurface'),
                    startX,
                    startY,
                    dist,
                    threshold = 50, //required min distance traveled to be considered swipe
                    allowedTime = 200, // maximum time allowed to travel that distance
                    elapsedTime,
                    startTime;

            function handleswipe(isRightSwipe, isLeftSwipe){

                if (isRightSwipe) {
                    if(currIdx + 1 < 4)
                        changeSlider(currIdx + 1);
                }
                else if(isLeftSwipe) {
                    if(currIdx - 1 >= 0)
                        changeSlider(currIdx - 1);
                }
            }

            touchsurface.addEventListener('touchstart', function(e){

                var touchobj = e.changedTouches[0];
                dist = 0;
                startX = touchobj.pageX;
                startY = touchobj.pageY;
                startTime = new Date().getTime(); // record time when finger first makes contact with surface
//                e.preventDefault();
            }, false);

            touchsurface.addEventListener('touchmove', function(e){
//                e.preventDefault(); // prevent scrolling when inside DIV
            }, false);

            touchsurface.addEventListener('touchend', function(e){
                var touchobj = e.changedTouches[0];
                dist = touchobj.pageX - startX; // get total dist traveled by finger while in contact with surface
                elapsedTime = new Date().getTime() - startTime; // get time elapsed
                // check that elapsed time is within specified, horizontal dist traveled >= threshold, and vertical dist traveled <= 100

                var swipeRightBol = (elapsedTime <= allowedTime && -dist >= threshold && Math.abs(touchobj.pageY - startY) <= 100);
                var swipeLeftBol = (elapsedTime <= allowedTime && dist >= threshold && Math.abs(touchobj.pageY - startY) <= 100);

                handleswipe(swipeRightBol, swipeLeftBol);
//                e.preventDefault();
            }, false);

        }, false); // end window.onload

        function changeConfirmStatus() {

            if($("#confirm").prop('checked') == true) {
                $("#start").removeAttr('disabled').css('background-color', '#c80054');

            }
            else {
                $("#start").attr('disabled', 'disabled').css('background-color', 'rgb(101, 96, 101)');
            }
        }
    </script>

    <style>
        html, body {
            position: relative;
            height: 100%;
        }
        body {
            background: #eee;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color:#000;
            margin: 0;
            padding: 0;
            height: 100vh;
        }
        .container-fluid{
            height: 100vh;
            padding: 0;
        }
        .swiper-container {
            width: 100%;
            height: 90vh;
        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            padding: 20vw;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .mobile_on{
            display: none;
        }
        .slide_1{
            background-color:#e0b8e8;
            background-size: 100% 100%;
        }
        .slide_2{
            background-color:#e6e6e6;
            background-size: 100% 100%;
        }
        .slide_3{
            background-color:#b1e0ad;
            background-size: 100% 100%;
        }
        .slide_4{
            background-color:#e2d7bc;
            background-size: 100% 100%;
        }
        .slide_5{
            background-color:#b9cccf;
            background-size: 100% 100%;
        }
        .slide_6{
            background-color:#9de0de;
            background-size: 100% 100%;
        }
        .top_part{
            font-family: ghasem;
            background-color: #32245f;
            height: 10vh;
            text-align: center;
            color: #f7f7f7;
            padding: 10px;
            padding-top: 1vh;
            font-size: 34px;
        }
        .swiper-pagination-bullet{
            width: 15px;
            height: 15px;
        }
        .inter{
            background-color: #ff931e;
            height: 5%;
            width: 10%;
            padding: 5px;
            border-radius: 10px;
        }
        .box_top{
            top: 60px;
            position: absolute;
        }
        @media screen and (max-width: 768px) {
            .mobile_off {
                display: none;
            }

            .mobile_on {
                display: block;
            }

            .swiper-pagination-bullet {
                width: 12px;
                height: 12px;
            }
            .swiper-slide{
                position: relative;
            }
            .swiper-slide img{
                visibility: hidden;
            }
            .box_top{
                top: 20px;
                position: absolute;
            }

            .box_mid p{
                font-size: 2.5vh;
            }
            .box_mid{
                font-size: 4vw;
            }
            .top_part {
                font-family: ghasem;
                background-color: #32245f;
                height: 10vh;
                text-align: center;
                color: #f7f7f7;
                padding: 10px;
                padding-top: 1vh;
                font-size: 20px;
            }

            .mobieL-off {
                visibility: hidden;
            }

            .swiper-container {
                height: 80vh;
            }

        }
        @media screen and (max-width: 768px) and (max-height: 420px){

        }


    </style>
@stop

@section('main')

    <div class="container-fluid">
        <div class="top_part">
            <p onclick="document.location.href = '{{route('home')}}'">پرسولیو</p>
            {{--<p style="position: absolute;float: left;z-index: 100;left: 30px;top:4vh;font-family: IRANSans;font-size: 14px;cursor: pointer;" class="inter" onclick="document.location.href = '{{route('login')}}'">ورود</p>--}}
        </div>
        <div class="swiper-container">
            <div class="swiper-wrapper">

                <div class="swiper-slide slide_1">
                    <div class="box_top">
                        <i class="material-icons mobile_off" style="font-size: 15vh;">warning</i>
                        <i class="material-icons mobile_on" style="font-size: 15vw;">warning</i>
                    </div>
                    <div class="box_mid">
                    <p>سلام<br/>نتايج آزمونی كه پيشروى شماست می تونه بر تصميمات مهم زنديگيتون تاثير بزرگى داشته باشه.</br>خواهش مى كنيم چند نكته اى رو كه در ادامه بهتون ارائه می شه، با دقت مطالعه كنيد. </p>
                    </div>
                </div>
                <div class="swiper-slide slide_2">
                    <div class="box_top">
                        <i class="material-icons mobile_off" style="font-size: 15vh;"  >check_circle</i>
                        <i class="material-icons mobile_on" style="font-size: 15vw;" >check_circle</i>
                    </div>
                    <div class="box_mid">
                    <p>این پرسش نامه شامل ۶۰ سوال است. هر یک از جملات را با دقت بخوانید و پاسخی که بیشترین تطبیق را با فکر یا احساس شما دارد علامت بزنید.‌</br>معمولا اولین پاسخی که به ذهنتان می رسد پاسخ درست تری نسبت به آن چیزی است که پس از فکر کردن، تصمیم می گیرید.</p>
                    </div>
                </div>
                <div class="swiper-slide slide_3">
                    <div class="box_top">
                    <i class="material-icons mobile_off" style="font-size: 15vh;">highlight_off</i>
                    <i class="material-icons mobile_on" style="font-size: 15vw;">highlight_off</i>
                    </div>
                    <div class="box_mid">
                    <p>توجه داشته باشید که پاسخ درست یا غلط وجود ندارد. بنابراین سعی کنید پاسخی را انتخاب کنید که نشان دهنده احساس واقعی شما در حال حاضر باشد، نه آنچه که دوست دارید باشید.</p>

                    </div>
                </div>
                <div class="swiper-slide slide_4">
                    <div class="box_top">
                        <i class="material-icons mobile_off" style="font-size: 15vh;">lock_outline</i>
                        <i class="material-icons mobile_on" style="font-size: 15vw;">lock_outline</i>
                    </div>
                    <div class="box_mid">
                        <p>بهتون اطمينان مي دهيم كه نتايج شما در اين آزمون كاملا محرمانه و فقط در اختيار متخصصين مركز مشاوره ى ماست و براى بهره مندی شما مورد استفاده قرار مى گيرد.</p>
                        <div style="text-align: center;">
                            <i class="material-icons done mobile_off" style="font-size: 5vh;">done</i>
                            <i class="material-icons done mobile_on" style="font-size: 5vw;">done</i>
                            <p style="margin-top: 30px;font-size: 2vh;margin-right:3vh;" onclick="show_start()">توضيحات آزمون را كاملا مطالعه كردم و شرايط آن را مي پذيرم</p>
                            <button id="start" class="hide" style="width: 80px !important; background-color: #32245f; margin-top: 1.5vh; border-radius: 30px; padding: 10px; min-width: 85%; color: white; border: none" onclick="document.location.href = '{{route('doQuiz', ['quizId' => $quizId])}}'">شروع</button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination" style="bottom: 5vh;"></div>
            <div class="mobieL-off">
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>


    <!-- Swiper JS -->
    <script src="{{URL::asset('js/dist/js/swiper.min.js')}}"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: true,
            },
            slidesPerView: 1,
            spaceBetween: 30,
            keyboard: {
                enabled: true,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            history: {
                key: 'slide',
            },
        });
    </script>


    {{--<div class="container-fluid">--}}
        {{--<div class="top_part">--}}
            {{--<p>پرسولیو</p>--}}
            {{--<!--<img class="menu_icon" src="images/menuIcon.png" id="menu-toggle" width="50px">-->--}}
        {{--</div>--}}
        {{--<div class="box">--}}
            {{--<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" >--}}
                {{--<ol class="carousel-indicators">--}}
                    {{--<li data-target="#carousel" style="color: #32245f;" data-slide-to="0" class="active"></li>--}}
                    {{--<li data-target="#carousel" data-slide-to="1"></li>--}}
                    {{--<li data-target="#carousel" data-slide-to="2"></li>--}}
                    {{--<li data-target="#carousel" data-slide-to="3"></li>--}}
                {{--</ol>--}}
                {{--<!-- Carousel items -->--}}
                {{--<div class="carousel-inner">--}}
                    {{--<div class="active item">--}}
                        {{--<div class="box_top">--}}
                                {{--<i class="material-icons" style="font-size: 150px;">warning</i>--}}
                        {{--</div>--}}
                        {{--<div class="box_mid">--}}
                            {{--<p>سلام<br/>نتايج آزمونی كه پيشروى شماست می تونه بر تصميمات مهم زنديگيتون تاثير بزرگى داشته باشه.</br>خواهش مى كنيم چند نكته اى رو كه در ادامه بهتون ارائه می شه، با دقت مطالعه كنيد. </p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="item">--}}
                        {{--<div class="box_top">--}}
                            {{--<i class="material-icons"  style="font-size: 150px;">check_circle</i>--}}
                        {{--</div>--}}
                        {{--<div class="box_mid">--}}
                            {{--<p>این پرسش نامه شامل ۶۰ سوال است. هر یک از جملات را با دقت بخوانید و پاسخی که بیشترین تطبیق را با فکر یا احساس شما دارد علامت بزنید.‌</br>معمولا اولین پاسخی که به ذهنتان می رسد پاسخ درست تری نسبت به آن چیزی است که پس از فکر کردن، تصمیم می گیرید.</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="item">--}}
                        {{--<div class="box_top">--}}
                            {{--<i class="material-icons" style="font-size: 150px;">highlight_off</i>--}}
                        {{--</div>--}}
                        {{--<div class="box_mid">--}}
                            {{--<p>توجه داشته باشید که پاسخ درست یا غلط وجود ندارد. بنابراین سعی کنید پاسخی را انتخاب کنید که نشان دهنده احساس واقعی شما در حال حاضر باشد، نه آنچه که دوست دارید باشید.</p>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="item">--}}
                        {{--<div class="box_top">--}}
                            {{--<i class="material-icons" style="font-size: 150px;">lock_outline</i>--}}
                        {{--</div>--}}
                        {{--<div class="box_mid">--}}
                            {{--<p>بهتون اطمينان مي دهيم كه نتايج شما در اين آزمون كاملا محرمانه و فقط در اختيار متخصصين مركز مشاوره ى ماست و براى بهره مندی شما مورد استفاده قرار مى گيرد.</p>--}}
                            {{--<div style="text-align: right;">--}}
                                {{--<i class="material-icons done">done</i>--}}
                                {{--<p style="margin-top: 30px;font-size: 20px;" onclick="show_start()">توضيحات آزمون را كاملا مطالعه كردم و شرايط آن را مي پذيرم</p>--}}
                                {{--<button id="start" class="hide" style="width: 200px !important; background-color: #32245f; margin-top: 30px; border-radius: 30px; padding: 10px; min-width: 85%; color: white; border: none" onclick="document.location.href = '{{route('doQuiz')}}'">شروع</button>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- Carousel nav -->--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<!-- Bootstrap core JavaScript -->--}}
    {{--<script src="{{URL::asset('js/jquery/jquery.min.js')}}"></script>--}}
    {{--<script src="{{URL::asset('js/bootstrap.js')}}"></script>--}}

    <script>
        $('.carousel').carousel({
            interval: 0
        });
        $(".done").click(function(e) {
            $(".done").toggleClass("active");
            $("#start").toggleClass('hide');
        });
    </script>
































    {{--<style>--}}

        {{--@media only screen and (max-width: 767px) {--}}
            {{--.marginOnMobile20Percent {--}}
                {{--margin-top: 20% !important;--}}
            {{--}--}}
        {{--}--}}

    {{--</style>--}}

    {{--<div class="col-xs-12 persoulio-title" style="z-index: 1000000001">--}}
        {{--<h3>پرسولیو</h3>--}}
    {{--</div>--}}
    {{--<center class="col-xs-12 marginOnMobile20Percent">--}}
        {{--<center class="col-xs-12 textSlider" style="width: 100%">--}}
            {{--<div class="col-xs-12">--}}
                {{--<img width="60px" height="60px" id="icon">--}}
            {{--</div>--}}

            {{--<div class="col-xs-12" id="text" style="direction: rtl; text-align: justify; overflow: auto; max-height: 60%; margin-top: 25px !important;"></div>--}}


            {{--<center class="col-xs-12 startQuiz hidden" id="startQuiz" style="z-index: 10001">--}}
                {{--<div class="col-xs-12">--}}
                    {{--<div class="confirmationCheckBox margin35PercentOnScreen">--}}
                        {{--<input type="checkbox" style="width: 20px; height: 20px;" id="confirm" onchange="changeConfirmStatus()">--}}
                    {{--</div>--}}
                    {{--<div class="confirmationText">--}}
                        {{--<label style="color: white; direction: rtl" for="confirm">توضيحات آزمون را كاملا مطاعه كردم و شرايط آن را مي پذيرم.</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</center>--}}

            {{--<div class="btn-container" style="top: 110%; display: block;">--}}
                {{--<div style="height: 15px; float: left; margin-left: 30%">--}}
                    {{--<div id="btn_3" onclick="changeSlider(3)" class="round-btn"></div>--}}
                    {{--<div id="btn_2" onclick="changeSlider(2)" class="round-btn"></div>--}}
                    {{--<div id="btn_1" onclick="changeSlider(1)" class="round-btn"></div>--}}
                    {{--<div id="btn_0" onclick="changeSlider(0)" class="round-btn"></div>--}}
                {{--</div>--}}
                {{--<div>--}}
                    {{--<button style="width: 200px !important; background-color: rgb(101, 96, 101); margin-top: 30px; visibility: hidden; border-radius: 30px; padding: 10px; min-width: 85%; color: white; border: none" id="start" disabled onclick="document.location.href = '{{route('doQuiz')}}'">شروع</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</center>--}}
    {{--</center>--}}

    {{--<div class="dark2"></div>--}}
@stop