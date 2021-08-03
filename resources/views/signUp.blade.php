@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/signup.css')}}">
    <script src="{{URL::asset('js/jsNeededForSignUp.js')}}"></script>
    <script src="{{URL::asset('js/combobox.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"
            integrity="sha256-UiqIqgNXwR8ChFMaD8VrY0tBUIl/soqb7msaauJWZVc=" crossorigin="anonymous"></script>

    <script>

        var checkEducationalCodeDir = '{{route('checkEducationalCode')}}';
        var getActivationDir = '{{route('getActivation')}}';
        var sendActivationDir = '{{route('sendActivation')}}';
        var checkUserNameDir = '{{route('checkUserName')}}';
        var preQuiz = '{{route('preQuiz', ['quizId' => \App\models\Quiz::first()->id])}}';
        var educationalCode = "";
        var firstName = "";
        var lastName = "";


    </script>
    <style>
        /*.header {*/
        /*margin-top: 10%;*/
        /*color: white;*/
        /*}*/
        /*.header > center > p:first-child {*/
        /*border-bottom: 3px solid white;*/
        /*border-top: 3px solid white;*/
        /*padding: 10px;*/
        /*font-weight: bolder;*/
        /*font-size: 20px;*/
        /*width: 300px;*/
        /*}*/
        /*@media only screen and (min-width: 767px) {*/
        /*.header {*/
        /*margin-top: 100px;*/
        /*margin-bottom: 100px;*/
        /*}*/
        /*#header {*/
        /*width: 400px !important;*/
        /*}*/
        /*}*/

        /*.myOption {*/
        /*background-color: white;*/
        /*}*/
    </style>
@stop


@section('main')

    <div style="color: #c80054;font-weight: bolder;font-size: 20px;position: absolute;z-index: 100;width: 100vw;"
         id="errPass"></div>
    <div class="container-fluid">
        <div class=" ">
            <div class="top_part">
                <p onclick="document.location.href = '{{route('home')}}'">پرسولیو</p>
            </div>
            <center>
                {{--<p id="header">اطلاعات دانشجویی</p>--}}

            </center>
        </div>

        <div id="pass1" class="passes ">
            <div class="col-md-4 col-md-offset-4 col-xs-12 ">
                <div class="topic">
                    <h2>اطلاعات دانشجویی</h2>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-md-offset-4 sign-in-inputs">
                <form data-toggle="validator" role="form">
                    {{csrf_field()}}
                    <div class="form-group" style="height: 1px;">
                        <div class="col-xs-12" style="max-height: 10%">
                            <div class="border">
                                <input id="educationalCode" style="text-align: center;font-family: IRANSans;"
                                       {{--class="form-control"--}} style="border: none;" pattern="^[_0-9]{1,}$"
                                       maxlength="9" required onkeypress="validate(event)" class="myInput" dir="auto"
                                       type="tel" placeholder="شماره ی دانشجویی">
                            </div>
                        </div>
                    </div>

                    <!-- HTML code -->
                    <div class="border">
                        <!--<div class="myInput" dir="auto" >رشته تحصیلی</div>-->
                        <div class="combobox">
                            <span>▼</span>
                            <input id="fieldname" class="myInput" dir="auto"
                                   style="text-align: center;font-family: IRANSans !important;color: #000077 !important;height: 37px;font-size: 17px !important;"
                                   class="form-control" placeholder="رشته تحصیلی" type="text" name="comboboxfieldname"
                                   style="text-align-last: center; direction: rtl !important; float: left;">

                            <div class="dropdownlist" style="background-color: #fff;">
                                @foreach($fields as $field)
                                    <a class="myInput" dir="auto" value="{{$field->id}}" onclick="alert({{$field->id}}+'s');"
                                       style="color:#929292;">{{$field->name}}</a>
                                @endforeach
                            </div>
                            <input id="field" type="hidden">
                        </div>
                    </div>
                    <!-- JS code -->
                    <script type="text/javascript" charset="utf-8">

                        var no = new ComboBox('fieldname');
                        function test(input) {
                            alert(input+'');
                            document.getElementById('field').value=input;
                        }
                    </script>

                    <div class="   col-xs-12 " style="max-height: 10%">
                        <div class="border">
                            <select id="entryYear" style="text-align-last: center; direction: rtl !important;"
                                    class="myInput" dir="auto">
                                <option class="myOption" value="none">سال ورود</option>
                                @foreach($entryYears as $entryYear)
                                    <option class="myOption" value="{{$entryYear->id}}">{{$entryYear->name}}</option>
                                @endforeach
                            </select>
                            <div id="entryYearOption" class="hidden"
                                 style="height: 200px; width: 200px; background-color: red"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xs-12 col-md-12">
                <div class="next_but" onclick="checkEducationalCode()"></div>
            </div>
        </div>

        <div id="pass2" class="hidden passes">
            <div class="col-md-4 col-md-offset-4 col-xs-12 ">
                <div class="topic">
                    <h2>اطلاعات شخصی</h2>
                </div>
            </div>
            <div class="col-xs-12 sign-in-inputs">
                <div class="col-xs-12" style="max-height: 10%">
                    <div class="border">
                        <input id="firstName" class="myInput" dir="auto" type="text" placeholder="نام">
                    </div>
                </div>

                <div class="col-xs-12" style="max-height: 10%">
                    <div class="border">
                        <input id="lastName" class="myInput" dir="auto" type="text" placeholder="نام خانوادگی">
                    </div>
                </div>

                <div class="col-xs-12" style="max-height: 10%">
                    <div class="border">
                        <select id="sex" style="text-align-last: center; direction: rtl !important;" class="myInput"
                                dir="auto">
                            <option class="myOption" value="none">جنسیت</option>
                            <option class="myOption" value="0">خانم</option>
                            <option class="myOption" value="1">آقا</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="next_but" onclick="goToPass4()">
                    </div>
                </div>
                {{--<div class="col-xs-12 btn-group">--}}
                {{--<div class="col-xs-12">--}}
                {{--<button onclick="goToPass4()" class="btn btn-success myBtn">بعدی</button>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>

        <div id="pass3" class="hidden passes">
            <div class="topic">
                <h2>اطلاعات دانشجویی</h2>
            </div>
            <div class="col-xs-12">
                <div class="border">
                    <input id="username" class="myInput" dir="auto" type="text" placeholder="نام کاربری">
                </div>
            </div>

            <div class="col-xs-12">
                <div class="border">
                    <input id="password" class="myInput" dir="auto" type="password" placeholder="پسورد">
                </div>
            </div>

            <div class="col-xs-12">
                <div class="border">
                    <input id="passwordRepeat" class="myInput" dir="auto" type="password" placeholder="تکرار پسورد">
                </div>
            </div>

            <div class="col-xs-12 col-md-12">
                <div class="up_but" onclick="checkUserName()">
                </div>
            </div>

        </div>


        <div id="pass4" class="passes phone">
            <div class="col-md-4 col-md-offset-4 col-xs-12 ">
                <div class="topic_4">
                    <h2>فعال‌سازی حساب کاربری</h2>

                </div>
                <center>
                    <p style="color: #c80054; font-weight: bolder; font-size: 20px" id="errPass_1"></p>
                </center>
            </div>
            <div class="col-xs-12 sign-in-inputs">
                <div class="col-xs-12 col-md-4 col-md-offset-4" style="max-height: 10%">
                    <div class="border">
                        <input id="phoneNum" autocomplete="off" onkeyup="changeActivationStatus()"
                               onkeypress="validate(event)" class="myInput" dir="auto" type="text"
                               placeholder="شماره ی تلفن همراه">
                    </div>
                </div>

                <div class="col-xs-12 col-md-4 col-md-offset-4 hidden" id="resendActivationCodeDiv"
                     style="max-height: 10%">
                    <input class="btn code_but" id="resendActivationCode" type="submit" value="ارسال کد فعال سازی"
                           onclick="getActivation();">
                </div>

                <p id="reminderTimePane" class="hidden col-xs-12" style="padding-top: 5%;">
                    <span style="direction: rtl"> زمان باقی مانده برای ارسال مجدد کد فعال سازی: </span>
                    <span id="reminderTime"></span>
                </p>

                <div class="col-xs-12 hidden" id="activationCodeDiv" style="max-height: 10%">
                    <div class="border">
                        <input id="activationCode" onkeyup="sendActivation()" type="text" class="myInput" dir="auto"
                               placeholder="کد فعال سازی">
                    </div>
                </div>
            </div>

            <div class="col-xs-12 btn-group">
                <div class="col-xs-12">
                    <p style="color: white" id="errPass3"></p>
                </div>
            </div>
        </div>
        <div id="end_part" class="">
            <img src="images/success.png">
            <h4>به پرسولیو خوش آمدید</h4>
            {{--<center>--}}
            <div class="up_but" onclick="goToPreQuiz()"></div>
            {{--</center>--}}
        </div>
    </div>

    <form class="hidden" id="myForm" method="post" action="{{route('login')}}">
        {{csrf_field()}}
        <input type="text" name="username" id="usernameForm">
        <input type="password" name="password" id="passwordForm">
    </form>
@stop