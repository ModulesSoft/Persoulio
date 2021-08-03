@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">

    <script>

        var changePhoneStatusDir = '{{route('changePhoneStatus')}}';
        var changeTelegramStatusDir = '{{route('changeTelegramStatus')}}';
        var changeInstagramStatusDir = '{{route('changeInstagramStatus')}}';
        var saveBioDir = '{{route('saveBio')}}';
        var sendTelegramIdDir = '{{route('sendTelegramId')}}';
        var sendInstagramIdDir = '{{route('sendInstagramId')}}';

        function changePhoneStatus() {

            status = ($("#phoneStatus").is(':checked')) ? "ok" : "nok";

            $.ajax({
                type: 'post',
                url: changePhoneStatusDir,
                data: {
                    'phoneStatus': status
                }
            });
        }

        function changeTelegramStatus() {

            status = ($("#telegramStatus").is(':checked')) ? "ok" : "nok";

            $.ajax({
                type: 'post',
                url: changeTelegramStatusDir,
                data: {
                    'telegramStatus': status
                },
                success: function (response) {

                    if(response == "new") {
                        $("#setTelegramId").removeClass('hidden');
                    }
                }
            });
        }
        
        function changeInstagramStatus() {

            status = ($("#instagramStatus").is(':checked')) ? "ok" : "nok";

            $.ajax({
                type: 'post',
                url: changeInstagramStatusDir,
                data: {
                    'instagramStatus': status
                },
                success: function (response) {

                    if(response == "new") {
                        $("#setInstagramId").removeClass('hidden');
                    }
                }
            });
        }

        function sendTelegramId() {

            if($("#telegramId").val() == "")
                return;

            $.ajax({
                type: 'post',
                url: sendTelegramIdDir,
                data: {
                    'telegramId': $("#telegramId").val()
                },
                success: function (response) {
                    if(response == "ok")
                        document.location.href = '{{route('setting')}}';
                    else {
                        $("#telegramErr").empty();
                        $("#telegramErr").append('نام کاربری تلکرام وارد شده در سامانه موجود است');
                        $("#setTelegramId").removeClass('hidden');
                        $('#telegramStatus').removeAttr('checked');
                    }
                }
            });
        }

        function sendInstagramId() {

            if($("#InstagramId").val() == "")
                return;

            $.ajax({
                type: 'post',
                url: sendInstagramIdDir,
                data: {
                    'instagramId': $("#instagramId").val()
                },
                success: function (response) {
                    if(response == "ok")
                        document.location.href = '{{route('setting')}}';
                    else {
                        $("#instagramErr").empty();
                        $("#instagramErr").append('نام کاربری اینستاگرام وارد شده در سامانه موجود است');
                        $("#setInstagramId").removeClass('hidden');
                        $('#instagramStatus').removeAttr('checked');
                    }
                }
            });
        }

        function saveBioAndState() {

            $.ajax({
                type: 'post',
                url: saveBioDir,
                data: {
                    'desc': $("#bioDesc").val(),
                    'state': $("#state").val()
                },
                success: function (response) {
                    if(response == "ok")
                        document.location.href = '{{route('setting')}}';
                }
            });
        }

        var x;

        $(document).ready(function () {

            x = parseInt($(".mainRow").css('height').split("px")[0]) + 150;
            $(".dark2").css('min-height', x + "px");
        });
        function notEmpty() {

            if($("#email").empty())
                alert("sjkndfjksnfd");
        }
    </script>

    <style>

        /*top part og the page header*/
        .top_part{
            font-family: ghasem;
            background-color: #32245f;
            height: 10vh;
            text-align: center;
            color: #f7f7f7;
            padding: 10px;
            font-size: 34px;
            z-index: 2222222222222222;
        }

    </style>

@stop

@section('main')

    <script>
        function changePhoto() {
            $("#fileName").empty().append($("#photo").val());
            $("#sendBtn").removeAttr('disabled').css('background-color', '#c80054');
        }
    </script>

    <style>
        body{
            color: #3b0069;
        }
    </style>

    <div class="top_part navbar-fixed-top">
        <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
        <img onclick="document.location.href = '{{route('profile')}}'" src="images/left.png" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">

        <img class="menu_icon" src="images/menuIcon.png" id="menu-toggle" width="50px">
    </div>

    <div class="col-xs-12" style="min-height: 100vh; z-index: 10001; margin-top: 13vh;margin-bottom: 90px;">

        <form method="post" enctype="multipart/form-data" action="{{route('submitPhoto')}}" id="photoForm" style="">
            {{csrf_field()}}
            <fieldset>
                <input id="photo" name="photo" type="file" accept="image/jpeg" onchange="changePhoto()" style="display: none">
                <label for="photo">
                    {{--<div class="container">--}}
                    <img class="round-image" src="{{$user->photo}}">
                    <p id="fileName"></p>
                    {{--<div style="position: absolute;background-color: #000077;opacity: .5;width: 170px;height: 65px;top: 11%;left:26%;border-bottom-left-radius: 78px;border-bottom-right-radius: 79px;color: white;cursor: pointer;"><p>ویرایش</p></div>--}}
                    <div class="centered" style="position: relative; margin-top: -22%;    background-color: #000077;opacity: .5;width: 170px;height: 65px;color: white;border-bottom-left-radius: 78px;border-bottom-right-radius: 79px;">ویرایش تصویر</div>
                    {{--</div>--}}
                </label>
                <Div>
                    <button id="sendBtn" class="myBtn2" style="background-color: rgb(101, 96, 101) !important; min-width: 25%" disabled>تایید</button>
                    <p>{{$err}}</p>
                </Div>
            </fieldset>
        </form>


        <form method="post" action="{{route('updateProfile')}}">
            {{csrf_field()}}
            <div class="col-xs-12" style="direction: rtl; z-index: 100001 !important;">

                <div class="col-xs-12">
                    <div class="border">
                        <label>نام کاربری</label>
                        <input  class="myInput" dir="auto"  value="{{$user->username}}" readonly>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="border">
                        <label>نام</label>

                        <input name="firstName" id="firstName" class="myInput" dir="auto" value="{{$user->firstName}}" maxlength="50">
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="border">
                        <label>نام خانوادگی</label>

                        <input  name="lastName" id="lastName" class="myInput" dir="auto"  value="{{$user->lastName}}" maxlength="50">
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="border">
                        <input name="educationalCode" class="myInput" dir="auto"  value="{{$user->educationalCode}}">
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="border">
                        <select name="field" id="field" class="myInput" dir="auto"  style="direction: rtl">
                                @foreach($fields as $field)
                                @if($user->fieldId == $field->id)
                                    <option style="color: black" selected value="{{$field->id}}">{{$field->name}}</option>
                                @else
                                    <option style="color: black" value="{{$field->id}}">{{$field->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="border">
                        <input name="phoneNum" id="phoneNum" class="myInput" dir="auto"  value="{{$user->phoneNum}}">
                    </div>
                </div>


                <div class="col-xs-12">
                    <div class="border">
                        @if(!empty($user->email))
                            <input name="email" id="email" maxlength="100" class="myInput" dir="auto"  value="{{$user->email}}">
                        @else
                            <input name="email" id="email" maxlength="100" class="myInput" dir="auto" onsubmit="notEmpty()" placeholder="ایمیل">
                        @endif
                    </div>
                </div>

                <div class="col-xs-12 col-md-4 col-md-offset-4" style="padding: 10px">
                    <input type="submit" class="" style="background-color: #3b0069;height: 50px; width: 100%; border-radius: 50px; border: none;color: white;" value="به روزرسانی">
                </div>

            </div>
        </form>

        <form method="post" action="{{route('changePas')}}">
            {{csrf_field()}}

            <div class="col-xs-12">
                <div class="border">
                    <label>رمز عبور فعلی</label>
                    <input name="currPas" class="myInput" dir="auto" >
                </div>
            </div>

            <div class="col-xs-12">
                <div class="border">
                    <label>رمز عبور جدید</label>
                    <input name="newPas" class="myInput" dir="auto" >
                </div>
            </div>

            <div class="col-xs-12">
                <div class="border">
                    <label>تکرار رمز عبور جدید</label>
                    <input name="confirmNewPas" class="myInput" dir="auto" >
                </div>
            </div>


            <div class="col-xs-12 col-md-4 col-md-offset-4" style="padding: 10px">
                <input type="submit" class="" style="background-color: #3b0069;height: 50px; width: 100%; border-radius: 50px; border: none;color: white;" value="تغییر رمز عبور">
            </div>

        </form>

        @if(\App\models\ConfigModel::first()->friendAvailibility)

            <div class="col-xs-12" style="min-height: 200px; margin-top: 5%">
                <div class="border" style="min-height: 200px">
                    <textarea id="bioDesc" class="myInput" dir="auto"  maxlength="1000" style="min-height: 200px; direction: rtl" placeholder="بیوگرافی (حداکثر 1000 کاراکتر)">{{$bio}}</textarea>
                </div>
            </div>

            <div class="col-xs-12 marginOnMobile">
                <div class="border">
                    <select id="state" class="myInput" dir="auto"  style="direction: rtl">
                        <option value="none">شهر خود را انتخاب کنید</option>
                        @foreach($states as $state)
                            @if($userState == $state->id)
                                <option style="color: black" selected value="{{$state->id}}">{{$state->name}}</option>
                            @else
                                <option style="color: black" value="{{$state->id}}">{{$state->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <button class="myBtn" style="min-width: 25%; margin-top: 10px" onclick="saveBioAndState()">ذخیره</button>
            </div>

            <div class="col-xs-12 marginOnMobile">
                <div class="col-xs-4 col-md-6" style="margin-top: -7px">
                    <label class="switch" style="float: right">
                        @if($status->phoneNum == 1)
                            <input id="phoneStatus" type="checkbox" checked onchange="changePhoneStatus()">
                        @else
                            <input id="phoneStatus" type="checkbox" onchange="changePhoneStatus()">
                        @endif
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="col-xs-8 col-md-6">
                    <span style="color: white; float: left">نمایش شماره تماس</span>
                </div>
            </div>

            <div class="col-xs-12 marginOnMobile">
                <div class="col-xs-4 col-md-6" style="margin-top: -7px">
                    <label class="switch" style="float: right">
                        @if($status->telegramId == 1)
                            <input id="telegramStatus" type="checkbox" checked onchange="changeTelegramStatus()">
                        @else
                            <input id="telegramStatus" type="checkbox" onchange="changeTelegramStatus()">
                        @endif
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="col-xs-8 col-md-6">
                    <span style="color: white; float: left">نمایش نام کاربری تلگرام</span>
                </div>
            </div>

            <div class="col-xs-12 marginOnMobile">
                <div class="col-xs-4 col-md-6" style="margin-top: -7px">
                    <label class="switch" style="float: right">
                        @if($status->instagramId == 1)
                            <input id="instagramStatus" type="checkbox" checked onchange="changeInstagramStatus()">
                        @else
                            <input id="instagramStatus" type="checkbox" onchange="changeInstagramStatus()">
                        @endif
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="col-xs-8 col-md-6">
                    <span style="color: white; float: left">نمایش نام کاربری اینستاگرام</span>
                </div>
            </div>
        @endif
    </div>


    <span id="setTelegramId" class="hidden myPopUp">
        <div>
            لطفا نام کاربری تلگرام خود را وارد نمایید
        </div>
        <div class="border">
            <input style="color: black !important; font-size: 14px !important;" placeholder="نام کاربری تلگرام" type="text" maxlength="40" id="telegramId" class="myInput" dir="auto" >
        </div>
        <div style="margin-top: 50px">
            <button onclick="sendTelegramId()" style="font-size: 12px" class="btn btn-success">ارسال</button>
            <button onclick="$('#telegramStatus').removeAttr('checked'); $('#setTelegramId').addClass('hidden')" style="font-size: 12px" class="btn btn-danger">بازگشت</button>
        </div>
        <p id="telegramErr"></p>
    </span>

    <span id="setInstagramId" class="hidden myPopUp">
        <div>
            لطفا نام کاربری اینستاگرام خود را وارد نمایید
        </div>
        <div class="border">
            <input style="color: black !important; font-size: 10px !important;" placeholder="نام کاربری اینستاگرام" type="text" maxlength="40" id="instagramId" class="myInput" dir="auto" >
        </div>
        <div style="margin-top: 50px">
            <button onclick="sendInstagramId()" style="font-size: 12px" class="btn btn-success">ارسال</button>
            <button onclick="$('#instagramStatus').removeAttr('checked'); $('#setInstagramId').addClass('hidden')" style="font-size: 12px" class="btn btn-danger">بازگشت</button>
        </div>
        <p id="instagramErr"></p>
    </span>

    <div class="dark2"></div>
@stop