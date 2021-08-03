<template>
    <!--<div style="color: #c80054;font-weight: bolder;font-size: 20px;position: absolute;z-index: 100;width: 100vw;"-->
         <!--id="errPass"></div>-->
    <div class="container-fluid">
        <div class=" ">
            <div class="top_part">
                <router-link to="/">پرسولیو</router-link>
            </div>
            <center>
                <p id="header">اطلاعات دانشجویی</p>

            </center>
        </div>

        <div v-if="pass1" class="passes ">
            <div class="col-md-4 col-md-offset-4 col-xs-12 ">
                <div class="topic">
                    <h2>اطلاعات دانشجویی</h2>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-md-offset-4 sign-in-inputs">
                <form data-toggle="validator" role="form">

                    <div class="form-group" style="height: 1px;">
                        <div class="col-xs-12" style="max-height: 10%">
                            <div class="border">
                                <input id="educationalCode" style="text-align: center;font-family: IRANSans;"
                                       {{--class="form-control" --}} style="border: none;" pattern="^[_0-9]{1,}$"
                                       maxlength="9" required class="myInput" dir="auto"
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
                                <a class="myInput" dir="auto" value="{{$field->id}}"
                                   onclick="alert({{$field->id}}+'s');"
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
                            alert(input + '');
                            document.getElementById('field').value = input;
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
                <div class="next_but" @click="checkEducationalCode()"></div>
            </div>
        </div>

        <div v-if="pass2" class="hidden passes">
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
                {{--
                <div class="col-xs-12 btn-group">--}}
                    {{--
                    <div class="col-xs-12">--}}
                        {{--
                        <button onclick="goToPass4()" class="btn btn-success myBtn">بعدی</button>
                        --}}
                        {{--
                    </div>
                    --}}
                    {{--
                </div>
                --}}
            </div>
        </div>

        <div v-if="pass3" class="hidden passes">
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


        <div v-if="pass4" class="passes phone">
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
        <div v-if="end_part" class="">
            <img src="images/success.png">
            <h4>به پرسولیو خوش آمدید</h4>
            {{--
            <center>--}}
                <div class="up_but" onclick="goToPreQuiz()"></div>
                {{--
            </center>
            --}}
        </div>
    </div>
</template>

<script>
    export default {
        name: "SignUp",
        data(){
            return{
                pass1 : true,
                pass2 : false,
                pass3 : false,
                pass4 : false,
                end_part : false
            }
        }
    }
</script>

<style scoped>
    @font-face {
        font-family: ghasem;
        src: url('../../fonts/AGhasem.ttf');
    }

    @font-face {
        font-family: IRANSans;
        src: url('../../fonts/IRANSansWeb.ttf');
    }

    body {
        font-family: IRANSans;
        /*overflow-y: hidden;*/
        overflow-x: hidden;
        /*background-image: url("../images/back.jpg");*/
        /*background-size: cover;*/
        color: #32245f;
    }

    /*over ride part*/
    .container-fluid {
        padding: 0px;
        overflow-y: hidden;
        height: 100vh;
        position: relative;

    }

    .row {
        padding: 0px;
    }

    .add_padding {
        padding: 15px;
    }

    /*top part og the page header*/
    .top_part {
        font-family: ghasem;
        background-color: #32245f;
        height: 10vh;
        width: 100vw;
        text-align: center;
        color: #f7f7f7;
        padding: 10px;
        font-size: 5vh;
        margin-bottom: 5vh;
        cursor: pointer;
    }

    .topic {
        width: 90%;
        margin: auto;
        margin-bottom: 70px;
        border-top: solid #d4d4d4 1px;
        border-bottom: solid #d4d4d4 1px;
        font-size: 14px;
        text-align: center;
        color: #d4d4d4;

    }

    .topic h2 {
        font-size: 14px;
        padding: 10px;
        margin: 0;
    }

    .passes {
        height: 70vh;
        overflow-y: hidden;
    }

    .next_but {
        background-image: url("../../assets/right.png");
        background-size: 100% 100%;
        height: 50px;
        width: 50px;
        margin: auto;
        margin-top: 10vh;
        cursor: pointer;
    }

    .up_but {
        background-image: url("../../assets/up.png");
        background-size: 100% 100%;
        height: 50px;
        width: 50px;
        margin: auto;
        margin-top: 10%;
        cursor: pointer;
    }

    .phone {
        background-color: #afb0b4;
        position: absolute;
        z-index: 100;
        bottom: 0;
        width: 100vw;
        height: 85vh;
        overflow-y: hidden;
        margin-bottom: -75vh;
        padding-top: 15vh;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
        overflow-x: hidden;

    }

    .phone.toggled {
        margin-bottom: 0;
        padding-top: 12vh;

    }

    .topic_4 {
        width: 70%;
        margin: auto;
        border-top: solid #d4d4d4 1px;
        border-bottom: solid #d4d4d4 1px;
        font-size: 14px;
        color: #ffffff;
    }

    .topic_4 h2 {
        font-size: 14px;
    }

    .code_but {
        background-color: #fcb630;
        margin-top: 10px;
        border-radius: 50px;
        height: 50px;
        border: none;
        border: solid #ffffff 1px;
        color: white;
        padding: 10px 20px 10px 20px;
    }

    #end_part {
        background-color: #3b0069;
        height: 80vh;
        position: absolute;
        width: 100vw;
        bottom: 0;
        z-index: 100;
        color: white;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
        margin-bottom: -75vh;
        padding-top: 5vh;
        overflow-y: hidden;
        overflow-x: hidden;
    }

    #end_part.toggled {
        margin-bottom: 0;

    }

    @media screen and (max-width: 768px) {
        .container-fluid {
            height: 88vh;
        }

        .top_part {
            margin-bottom: 5%;
        }

        .topic {
            margin-bottom: 1px;
        }

        .next_but {
            margin-top: 1vh;
        }
    }

    /*yousef*/
    div.combobox {
        height: 50px;
        margin-top: 70px;
    }

    div.combobox {
        position: relative;
        zoom: 1
    }

    div.combobox div.dropdownlist {
        display: none;
        border: solid 1px #000;
        background-color: #fff;
        height: 160px;
        overflow: auto;
        position: absolute;
        top: 3em;
        right: 0px;
        z-index: 10000000;
    }

    div.combobox div.dropdownlist a {
        display: block;
        text-decoration: none;
        color: #000;
        padding: 1px;
        cursor: default;
    }

    div.combobox div.dropdownlist a.light {
        color: #fff;
        background-color: #007
    }

    div.combobox div.dropdownlist, input {
        font-family: Tahoma;
    }

    div.combobox input {
        float: left;
        border: solid 1px #ccc;
        height: 1em
    }

    div.combobox span {
        border: solid 1px #ccc;
        background: #fff;
        width: 16px;
        height: 1em;
        float: left;
        text-align: left;
        border: none;
        cursor: default
    }
</style>