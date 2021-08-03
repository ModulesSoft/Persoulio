@extends('layout.myStructure')

@section('header')
    @parent

    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">


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
                <center class="col-xs-12" style="margin-top: 5px">
                    <label for="eventDiv">رویداد مورد نظر</label>
                    <select id="eventDiv"></select>
                </center>

                <center class="col-xs-12" style="margin-top: 5px">
                    <label for="quizDiv">آزمون مورد نظر</label>
                    <select id="quizDiv"></select>
                </center>

                <center class="col-xs-12">
                    <label for="amount">مقدار تخفیف</label>
                    <input type="number" min="0" id="amount">
                </center>

                <center class="col-xs-12">
                    <input type="submit" value="تایید" class="btn btn-success" onclick="doAddCreateOffer()">
                </center>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            addRequirement();
        });

        function addRequirement() {

            $.ajax({
                type: 'post',
                url: 'getEventsName',
                success: function (response) {

                    response = JSON.parse(response);
                    newElement = "<option value='-1'>رویداد مورد نظر</option>";

                    for(i = 0; i < response.length; i++) {
                        newElement += "<option value='" + response[i].id +"'>";
                        newElement += "<span> " + response[i].name + " </span><span>&nbsp;</span>";
                        newElement += "<span>" + response[i].mode + "</span><span>&nbsp;</span>";
                        newElement += "<span>" + response[i].subMode + "</span><span>&nbsp;</span>";
                        newElement += "</option>";
                    }

                    $("#eventDiv").empty().append(newElement);
                }
            });

            $.ajax({
                type: 'post',
                url: 'getQuizesName',
                success: function (response) {

                    response = JSON.parse(response);
                    newElement2 = "<option value='-1'>آزمون مورد نظر</option>";

                    for(i = 0; i < response.length; i++) {
                        newElement2 += "<option value='" + response[i].id +"'>";
                        newElement2 += "<span> " + response[i].name + " </span>";
                        newElement2 += "</option>";
                    }

                    $("#quizDiv").empty().append(newElement2);

                }
            });
        }

        function doAddCreateOffer() {

            var eventId = $("#eventDiv").val();
            var quizId = $("#quizDiv").val();

            if(eventId == -1 && quizId == -1) {
                alert("لطفا رویداد یا آزمون را مشخص نمایید");
                return;
            }

            var amount = $("#amount").val();
            if(amount.length == 0) {
                alert("لطفا مقدار تخفیف را مشخص نمایید");
                return;
            }

            var isQuiz = "false";

            if(eventId == -1) {
                eventId = quizId;
                isQuiz = "true";
            }


            $.ajax({
                type: 'post',
                url: '{{route('doCreateOfferOnEvent')}}',
                data: {
                    'eventId': eventId,
                    'isQuiz': isQuiz,
                    'amount': amount
                },
                success: function (response) {
                    if(response == "ok") {
                        document.location.href = '{{route('profile')}}';
                    }
                }
            });
        }
    </script>

@stop