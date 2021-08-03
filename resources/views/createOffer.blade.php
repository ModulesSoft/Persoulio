@extends('layout.myStructure')

@section('header')
    @parent

    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">
    <script src = {{URL::asset("js/jalali.js")}}></script>
    <script src = {{URL::asset("js/calendar.js")}}></script>
    <script src = {{URL::asset("js/calendar-setup.js")}}></script>
    <script src = {{URL::asset("js/calendar-fa.js")}}></script>
    <link rel="stylesheet" href="{{URL::asset('css/standalone.css')}}">
    <link rel="stylesheet" href = {{URL::asset("css/calendar-green.css") }}>

    <style>
        select {
            color: black;
        }

    </style>

@stop

@section('main')

    <div class="top_part navbar-fixed-top">
        <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
        <img onclick="document.location.href = '{{route('profile')}}'" src="{{URL::asset('images/left.png')}}" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">
    </div>


    <div class="container-fluid" style="margin-top: 100px">
        <div class="totalPane">
            <div class="col-xs-12">
                <div class="col-xs-3">
                    <span>نوع تخفیف</span>

                    <label for="static">مقداری</label>
                    <input type="radio" value="1" name="offerKind" id="static">

                    <label for="dynamic">درصدی</label>
                    <input type="radio" value="2" name="offerKind" id="dynamic">
                </div>

                <div class="col-xs-3">
                    <label for="amount">مقدار تخفیف</label>
                    <input type="text" id="amount">
                </div>

                <div class="col-xs-3">
                    <select onchange="changeSex(this.value)">
                        <option value="-1">جنسیت</option>
                        <option value="0">خانم</option>
                        <option value="1">آقا</option>
                    </select>
                </div>

                <div class="col-xs-3">
                    <label for="point">امتیاز</label>
                    <input id="point" type="text">
                    <button class="btn btn-success" onclick="changePoint()">اعمال</button>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="col-xs-6">
                    <select onchange="changeEntryYear(this.value)" style="text-align-last: center; direction: rtl !important;" dir="auto">
                        <option value="-1">سال ورود</option>
                        @foreach($entryYears as $entryYear)
                            <option value="{{$entryYear->id}}">{{$entryYear->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xs-6">
                    <select onchange="changeField(this.value)">
                        <option value="-1">رشته تحصیلی</option>
                        @foreach($fields as $field)
                            <option value="{{$field->id}}">{{$field->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12">

                <div class="col-xs-2">
                    <span>تاریخ تولد</span>
                </div>

                <div class="col-xs-4">
                    <span>از</span>
                    <label>
                        <input class="glyphicon glyphicon-plus" type="button" style="border: none; width: 30px; height: 30px; background: url({{ URL::asset('images/calendar-flat.png') }}) repeat 0 0; background-size: 100% 100%;" id="date_btn">
                    </label>
                    <input type="text" style="margin-top: -5px; max-width: 200px" class="form-detail" id="date_input" readonly>
                    <script>
                        Calendar.setup({
                            inputField: "date_input",
                            button: "date_btn",
                            ifFormat: "%Y/%m/%d",
                            dateType: "jalali"
                        });
                    </script>
                </div>

                <div class="col-xs-4">
                    <span>تا</span>
                    <label>
                        <input class="glyphicon glyphicon-plus" type="button" style="border: none; width: 30px; height: 30px; background: url({{ URL::asset('images/calendar-flat.png') }}) repeat 0 0; background-size: 100% 100%;" id="date_btn_end">
                    </label>
                    <input type="text" style="margin-top: -5px; max-width: 200px" class="form-detail" id="date_input_end" readonly>
                    <script>
                        Calendar.setup({
                            inputField: "date_input_end",
                            button: "date_btn_end",
                            ifFormat: "%Y/%m/%d",
                            dateType: "jalali"
                        });
                    </script>
                </div>

                <div class="col-xs-2">
                    <button class="btn btn-success" onclick="changeBirthDay()">اعمال تاریخ</button>
                </div>

            </div>

            <div class="col-xs-12">
                <div class="col-xs-3">
                    <button onclick="addAnd()">و</button>
                </div>

                <div class="col-xs-3">
                    <button onclick="addOr()">یا</button>
                </div>

                <div class="col-xs-3">
                    <button onclick="closeP()">(</button>
                </div>

                <div class="col-xs-3">
                    <button onclick="openP()">)</button>
                </div>

            </div>

            <div class="col-xs-12">
                <span>تاریخ انقضا</span>
                <label>
                    <input class="glyphicon glyphicon-plus" type="button" style="border: none; width: 30px; height: 30px; background: url({{ URL::asset('images/calendar-flat.png') }}) repeat 0 0; background-size: 100% 100%;" id="date_btn_expire">
                </label>
                <input type="text" style="margin-top: -5px; max-width: 200px" class="form-detail" id="date_input_expire" readonly>
                <script>
                    Calendar.setup({
                        inputField: "date_input_expire",
                        button: "date_btn_expire",
                        ifFormat: "%Y/%m/%d",
                        dateType: "jalali"
                    });
                </script>
            </div>

            <div class="col-xs-12">
                <div id="query" style="min-width: 400px; height: 200px; overflow-y: auto; border-radius: 7px; padding: 7px; border: 3px solid black">
                </div>
            </div>

            <center class="col-xs-12">
                <button onclick="sendQuery()" class="btn btn-primary">تایید</button>
                <p style="color: black" id="msg"></p>
            </center>

            <center class="col-xs-12">
                <a class="btn btn-info" href="{{route('createOfferOnEvent')}}">تخفیف بر روی رویداد ها و کوییز ها</a>
            </center>
        </div>
    </div>

    <script>

        var whereClause = "";
        var fromClause = "users";
        var selectClause;
        var query;
        var open = 0;
        var andOr = true;

        $(document).ready(function(){

            updateQuery();
        });

        function changeSex(val) {

            if(val == -1)
                return;

            if(andOr) {
                whereClause += "sex = " + val + " ";
                andOr = false;
                updateQuery();
            }
            else
                alert("باید در این مرحله از و/یا استفاده کنید");
        }

        function changeEntryYear(val) {

            if(val == -1)
                return;

            if(andOr) {
                whereClause += "entryYearId = " + val + " ";
                andOr = false;
                updateQuery();
            }
            else
                alert("باید در این مرحله از و/یا استفاده کنید");
        }
        
        function changeBirthDay() {

            if(andOr) {
                var start = $("#date_input").val();
                var end = $("#date_input_end").val();

                if (start.length == 0 || end.length == 0) {
                    alert("لطفا هر دو تاریخ از و تا را مشخص نمایید");
                    return;
                }

                tmp = start.split("/");
                start = tmp[0] + tmp[1] + tmp[2];

                tmp = end.split("/");
                end = tmp[0] + tmp[1] + tmp[2];

                if(start >= end) {
                    alert("تاریخ شروع باید کوچک تر مساوی تاریخ پایان باشد");
                    return;
                }

                whereClause += "(birthDay >= " + start + " and birthDay <= " + end + ") ";
                andOr = false;
                updateQuery();
            }
            else
                alert("باید در این مرحله از و/یا استفاده کنید");
        }

        function changeField(val) {

            if(val == -1)
                return;

            if(andOr) {
                whereClause += "fieldId = " + val + " ";
                andOr = false;
                updateQuery();
            }
            else
                alert("باید در این مرحله از و/یا استفاده کنید");
        }

        function changePoint() {

            var val = $("#point").val();

            if(andOr) {
                fromClause = "users, userRate";
                whereClause += "userRate.rate >= " + val + " ";
                andOr = false;
                updateQuery();
            }
            else
                alert("باید در این مرحله از و/یا استفاده کنید");
        }

        function addAnd() {
            if(!andOr) {
                whereClause += "and ";
                andOr = true;
                updateQuery();
            }
            else
                alert("باید در این مرحله از clause ها استفاده کنید");
        }

        function addOr() {
            if(!andOr) {
                whereClause += "or ";
                andOr = true;
                updateQuery();
            }
            else
                alert("باید در این مرحله از clause ها استفاده کنید");
        }

        function openP() {
            if(andOr) {
                open++;
                whereClause += "( ";
                updateQuery();
            }
            else
                alert("باید در این مرحله از و/یا استفاده کنید");
        }

        function closeP() {

            if(!andOr) {
                if (open == 0) {
                    alert("ابتدا باید پرانتزی باز کنید");
                    return;
                }
                open--;
                whereClause += ") ";
                updateQuery();
            }
            else
                alert("باید در این مرحله از clause ها استفاده کنید");
        }

        function updateQuery() {
            selectClause = "select users.id from " + fromClause + " where ";
            query = selectClause + whereClause;

            elem = "<p style='direction: ltr; color: black'>" + query + "</p>";
            $("#query").empty().append(elem);
        }

        function sendQuery() {

            if(andOr && whereClause.length != 0) {
                alert("باید در این مرحله از clause ها استفاده کنید");
                return;
            }

            if(open > 0) {
                alert("لطفا همه ی پرانتز های باز را ببندید");
                return;
            }

            var amount = $("#amount").val();
            if(amount.length == 0 || amount == 0) {
                alert("لطفا مقدار تخفیف را مشخص فرمایید");
                return;
            }

            var offerKind = $("input[name='offerKind']:checked").val();
            if(offerKind == null || offerKind.length == 0 || offerKind == "undefined") {
                alert("لطفا نوع تخفیف خود را مشخص فرمایید");
                return;
            }

            if(whereClause.length == 0) {
                whereClause = " 1 = 1";
                andOr = false;
                updateQuery();
            }

            $("#msg").empty().append("در حال انجام عملیات");


            var expireTime = $("#date_input_expire").val();
            if(expireTime.length == 0)
                expireTime = "none";

            $.ajax({
                type: 'post',
                url: '{{route('doCreateOffer')}}',
                data: {
                    'query': query,
                    'offerKind': offerKind,
                    'amount': amount,
                    'expireTime': expireTime
                },
                success: function (response) {
                    if(response == "ok")
                        document.location.href = '{{route('profile')}}';
                    else {
                        alert('متن وارد شده نامعتبر است');
                        $("#msg").empty();
                    }
                }
            });

        }

    </script>

@stop