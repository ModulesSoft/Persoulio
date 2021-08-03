@extends('layout.myStructure')

@section('header')
    @parent
    {{--<link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">--}}
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">

    <script>

        $(document).ready(function () {

            @foreach($contents as $content)
                checkOverFlow('{{$content->id}}');
            @endforeach

        });

        function checkOverFlow(idx) {

            offsetHeight = $('#content_' + idx).prop('offsetHeight');
            scrollHeight = $('#content_' + idx).prop('scrollHeight');

            if (offsetHeight < scrollHeight)
                $('#showMore_' + idx).removeClass('hidden');
        }

        function showMore(id) {
            $('#content_' + id).css('max-height', '').css('height', '');
            $('#showMore_' + id).empty().append('کمتر').attr('onclick', 'showLess("' + id + '")');
        }

        function showLess(id) {
            $('#content_' + id).css('max-height', '50px').css('height', '50px');
            $('#showMore_' + id).empty().append('بیشتر').attr('onclick', 'showMore("' + id + '")');
        }
    </script>

@stop

@section('main')
    <img class="menu_icon" src="images/menuIcon.png" id="menu-toggle" width="50px">


    <div class="nav_slide">
        <div class="col-md-4 col-xs-12 add_padding ">
            <div class="box">

                <div class="box_mid2" style="background-image: url({{$user->photo}});">
                    <h2 style="color: #32245f;font-size: 24px;margin-top: 160px;">{{$user->firstName}}</h2>
                    <h3> {{$user->lastName}}</h3> {{--<p style="color: #dddddd;">تیپ شخصیتی</p>--}}
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

            @include('layout.menuBar')

            @include('layout.bigMenuBar')

            <div onclick="$('.mobile-nav').addClass('hidden');" id="totalContainer">

            </div>
        @else
            <div class="top_part navbar-fixed-top">
                <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
            </div>
        @endif


        <div id="wrapper">

            @include('layout.profile')

            <div class="col-md-4"></div>

            <div class="col-md-8 col-xs-12 add_padding add_marg">
                <div class="box" style="background-color: transparent;">
                    @include('layout.tabs')
                    {{--<div class="filter_part">--}}
                    {{--<button class="right_filter">برگزیده‌ها</button>--}}
                    {{--<button class="left_filter active ">همه</button>--}}
                    {{--</div>--}}
                    <div class="add_padding row">
                        @foreach($contents as $content)
                            {{--<p>{{$tip->name}}</p>--}}
                            <div class="col-md-6 col-xs-12">
                                <div class="news_part">
                                    <div class="news_header">
                                        <p style="font-size: 2.5vh;float: right;padding-top: 10px;padding-right: 20px;font-weight: bold;cursor: pointer;"
                                           onclick="document.location.href = '{{route('contentShowComplete', ['id' => $content->id])}}'">{{$content->title}}</p>
                                    </div>
                                    <div class="">
                                        <div class="news_pic"
                                             style="background-image: url('images/contentPhotos/{{$content->photo}}');">
                                        {{--<div style="border: solid #3b0069 1px;height: 200px; "></div>--}}
                                        <!--<img src="images/news.jpg">-->
                                        </div>
                                    </div>
                                    <div class="news_detail" style="margin-bottom: 10px;">
                                        <p>{{$content->text}}</p>
                                    </div>
                                    @if($mode == 2)
                                        <div id="days{{$content->id}}" style="display: none" class="bg-danger">
                                            <p>انتخاب زمان:</p>
                                            <form method="post" action="{{route('saveMyDates',[$content->id])}}"
                                                  enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="bg-warning" align="right">
                                                    <input type="hidden" name="cId" value="{{$content->id}}">
                                                    <input type="hidden" name="userId" value="{{$user->id}}">
                                                    <?php
                                                    $userSelectedDays = [];
                                                    foreach ($userDays as $userDay) {
                                                        if ($userDay->contentId == $content->id) {
                                                            $userSelectedDays[$content->id][0] = $userDay->day1;
                                                            $userSelectedDays[$content->id][1] = $userDay->day2;
                                                            $userSelectedDays[$content->id][2] = $userDay->day3;
                                                            $userSelectedDays[$content->id][3] = $userDay->day4;
                                                            $userSelectedDays[$content->id][4] = $userDay->day5;
                                                            $userSelectedDays[$content->id][5] = $userDay->day6;
                                                            $userSelectedDays[$content->id][6] = $userDay->day7;
                                                        }
                                                    }
                                                    ?>
                                                    @if($content->day1 !=null)
                                                        <label for="day1">{{$content->day1}}</label>
                                                        @if($content->id != 97)
                                                        <input type="checkbox" name="day1" id="day1"
                                                               @if(isset($userSelectedDays[$content->id]) && $userSelectedDays[$content->id][0] =='1') checked @endif>
                                                        @endif
                                                    @endif
                                                    <br>
                                                    @if($content->day2 !=null)
                                                        <label for="day2">{{$content->day2}}</label>
                                                        <input type="checkbox" name="day2" id="day2"
                                                               @if( isset($userSelectedDays[$content->id]) && $userSelectedDays[$content->id][1] =='1') checked @endif>
                                                        <br>
                                                    @endif
                                                    @if($content->day3 !=null)
                                                        <label for="day3">{{$content->day3}}</label>
                                                        <input type="checkbox" name="day3" id="day3"
                                                               @if( isset($userSelectedDays[$content->id]) && $userSelectedDays[$content->id][2] =='1') checked @endif>
                                                        <br>
                                                    @endif
                                                    @if($content->day4 !=null)
                                                        <label for="day4">{{$content->day4}}</label>
                                                        <input type="checkbox" name="day4" id="day4"
                                                               @if( isset($userSelectedDays[$content->id]) && $userSelectedDays[$content->id][3] =='1') checked @endif>
                                                        <br>
                                                    @endif
                                                    @if($content->day5 !=null)
                                                        <label for="day5">{{$content->day5}}</label>
                                                        <input type="checkbox" name="day5" id="day5"
                                                               @if( isset($userSelectedDays[$content->id]) && $userSelectedDays[$content->id][4] =='1') checked @endif>
                                                        <br>
                                                    @endif
                                                    @if($content->day6 !=null)
                                                        <label for="day6">{{$content->day6}}</label>
                                                        <input type="checkbox" name="day6" id="day6"
                                                               @if( isset($userSelectedDays[$content->id]) && $userSelectedDays[$content->id][5] =='1') checked @endif>
                                                        <br>
                                                    @endif
                                                    @if($content->day7 !=null)
                                                        <label for="day7">{{$content->day7}}</label>
                                                        <input type="checkbox" name="day7" id="day7"
                                                               @if( isset($userSelectedDays[$content->id]) && $userSelectedDays[$content->id][6] =='1') checked @endif>
                                                    @endif
                                                    <div class="read-more" class="pt-3 mt-2"
                                                         style="float: left">
                                                        <div class="btn btn-warning butto">
                                                            <a class="button" href="#p{{$content->id}}"
                                                               style="text-decoration-line: none;color: white; ">ثبت</a>
                                                        </div>
                                                        <button class="btn btn-danger button"
                                                                onclick="toggleDays('{{$content->id}}')"
                                                                type="button">
                                                            بستن
                                                        </button>
                                                    </div>
                                                </div>
                                                {{--popup--}}
                                                <div id="p{{$content->id}}" class="overlay" style="z-index: 9">
                                                    <div class="popup">
                                                        <div>
                                                            <strong style="font-size: 20px"
                                                                    class="text-danger">رزرو</strong><a class="close"
                                                                                                        href="#">&times;</a>
                                                        </div>
                                                        <div class="" align="right">
                                                            <br>
                                                            آیا از انتخاب خودت مطمئنی؟
                                                            <br>
                                                            *برای پاک کردن اسمت از لیست میتونی انتخاب هات رو خالی بذاری
                                                            و ثبت کنی.
                                                            <br>
                                                            *با این انتخاب، کارگاه مورد نظر در اولویت برگزاری در روزهایی
                                                            که انتخاب کردی قرار خواهد گرفت و اگه به حد نصاب برسه از
                                                            اولین نفراتی خواهی بود که از این کارگاه با خبر می شی
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-success" type="submit">بله</button>
                                                            <button class="btn btn-danger" type="button"
                                                                    onclick="document.location.href = '{{route('events')}}'">
                                                                خیر
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--popup--}}
                                            </form>
                                        </div>
                                        <div class="read-more" class="pt-3 mt-2" style="float: left">
                                            <button class="btn btn-info button" id="btn{{$content->id}}"
                                                    onclick="toggleDays('{{$content->id}}')">مایل به شرکت هستم
                                            </button>
                                        </div>
                                    @endif

                                    <div class="read-more" class="pt-3 mt-2" style="float: left"
                                         id="btn2{{$content->id}}"><a
                                                class="btn btn-success button"
                                                onclick="document.location.href = '{{route('contentShowComplete', ['id' => $content->id])}}'"
                                                target="_blank">بیشتر بخوانید</a></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>

        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
        }

        .overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 30%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
            font-family: Tahoma, Arial, sans-serif;
        }

        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .popup .close:hover {
            color: #06D85F;
        }

        .popup .content {
            max-height: 30%;
            overflow: auto;
        }

        @media screen and (max-width: 700px) {
            .box {
                width: 100%;
            }

            .popup {
                width: 70%;
            }
        }
    </style>



    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        function toggleDays(id) {
            var days = document.getElementById('days' + id);
            var btn = document.getElementById('btn' + id);
            var btn2 = document.getElementById('btn' + id);
            if (days.style.display === "none") {
                days.style.display = "block";
                btn.style.display = "none";
                btn2.style.display = "none";

            } else {
                days.style.display = "none";
                btn.style.display = "block";
                btn2.style.display = "block";
            }
        }

        function show_sub(e) {
            $(".sub_m").toggleClass("hiden");
            $("#test").toggleClass("active");
        }

        var $el, $ps, $up, totalHeight;

        $(".news_detail .button").click(function () {

            totalHeight = 0

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





















































    {{--<div class="totalPane">--}}
    {{--@if(count($contents) == 0)--}}
    {{--<p>محتوایی در این بخش وجود ندارد</p>--}}
    {{--@endif--}}

    {{--@foreach($contents as $content)--}}
    {{--<div class="col-xs-12">--}}
    {{--<div class="col-md-5"></div>--}}
    {{--<div class="content col-md-2">--}}
    {{--<h3 style="text-align: start; padding: 20px; color: white; width: 100%">{{$content->title}}</h3>--}}

    {{--@if($content->photo != "none")--}}
    {{--<img src="{{URL::asset('images/contentPhotos/' . $content->photo)}}" class="photo">--}}
    {{--@endif--}}
    {{--<div>--}}
    {{--<p id="content_{{$content->id}}" style="color: white; overflow: hidden; line-height: 20px; height: 50px; max-height: 50px; text-align: justify; padding-top: 10px; padding-left: 40px; padding-right: 40px">{{$content->text}}</p>--}}
    {{--<p class="hidden" onclick="showMore('{{$content->id}}')" style="font-size: 11px; float: right; cursor: pointer; padding-right: 40px" id="showMore_{{$content->id}}">بیشتر</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-5"></div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--</div>--}}

@stop