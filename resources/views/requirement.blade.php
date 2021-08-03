@extends('layout.myStructure')

@section('header')
    @parent

    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">

    <script>
        var deleteUrl = '{{route('deleteEvent')}}';
        var selfUrl = '{{route('manageEvents')}}';
    </script>

    <style>
        select {
            color: black;
        }
        td {
            padding: 7px;
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
                <form method="post" action="{{route('deleteRequirement')}}">
                    {{csrf_field()}}
                    <table>
                        @foreach($requirements as $itr)
                            <tr>
                                <td><center>{{$itr->srcName}}</center></td>
                                <td><center>پیش نیاز</center></td>
                                <td><center>{{$itr->destName}}</center></td>
                                <td><center>است</center></td>
                                <td>
                                    <center>
                                        <button name="requirementId" value="{{$itr->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </form>
            </div>

            <div class="col-xs-12">
                <input type="submit" class="btn btn-success" value="افزودن پیش نیازی" onclick="addRequirement()">
            </div>
        </div>
    </div>


    <span id="addRequirement" class="hidden myPopUp" style="z-index: 1000001 !important; top: 15% !important; max-height: 80% !important;">
            <div style="color: white">
                افزودن پیش نیازی
            </div>
            <div class="border">

                <div class="col-xs-12">
                    <p style="color: white">رویداد مبدا</p>

                    <center class="col-xs-12" style="margin-top: 5px; color: white">
                        <label for="eventDivSrc">رویداد مورد نظر</label>
                        <select id="eventDivSrc"></select>
                    </center>

                    <center class="col-xs-12" style="margin-top: 5px; color: white">
                        <label for="quizDivSrc">آزمون مورد نظر</label>
                        <select id="quizDivSrc"></select>
                    </center>
                </div>


                <div class="col-xs-12">
                    <p style="color: white">رویداد مقصد</p>

                    <center class="col-xs-12" style="margin-top: 5px; color: white">
                        <label for="eventDivDest">رویداد مورد نظر</label>
                        <select id="eventDivDest"></select>
                    </center>

                    <center class="col-xs-12" style="margin-top: 5px; color: white">
                        <label for="quizDivDest">آزمون مورد نظر</label>
                        <select id="quizDivDest"></select>
                    </center>
                </div>

            </div>

            <center class="col-xs-12" style="margin-top: 50px">
                <input type="submit" onclick="doAddRequirement()" class="btn btn-success" style="font-size: 12px" value="ثبت">
                <span class="btn btn-danger" onclick="$('#addRequirement').addClass('hidden'); $('.dark').addClass('hidden')">بازگشت</span>
            </center>
            <p style="color: white" id="errEdit"></p>
        </span>
    
    <script>
        
        function addRequirement() {

            $('#addRequirement').removeClass('hidden');
            $('.dark').removeClass('hidden');

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

                    $("#eventDivSrc").empty().append(newElement);
                    $("#eventDivDest").empty().append(newElement);
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

                    $("#quizDivSrc").empty().append(newElement2);
                    $("#quizDivDest").empty().append(newElement2);

                }
            });
        }

        function doAddRequirement() {

            eventIdSrc = $("#eventDivSrc").val();
            quizIdSrc = $("#quizDivSrc").val();

            eventIdDest = $("#eventDivDest").val();
            quizIdDest = $("#quizDivDest").val();

            if(eventIdSrc == -1 && quizIdSrc == -1) {
                alert("لطفا رویداد یا آزمون مبدا را مشخص نمایید");
                return;
            }

            if(eventIdDest == -1 && quizIdDest == -1) {
                alert("لطفا رویداد یا آزمون مقصد را مشخص نمایید");
                return;
            }

            var isQuizSrc = "false";
            var isQuizDest = "false";

            if(eventIdSrc == -1) {
                eventIdSrc = quizIdSrc;
                isQuizSrc = "true";
            }

            if(eventIdDest == -1) {
                eventIdDest = quizIdDest;
                isQuizDest = "true";
            }

            $.ajax({
                type: 'post',
                url: '{{route('doAddRequirement')}}',
                data: {
                    'eventIdSrc': eventIdSrc,
                    'eventIdDest': eventIdDest,
                    'isQuizSrc': isQuizSrc,
                    'isQuizDest': isQuizDest
                },
                success: function (response) {
                    if(response == "ok") {
                        document.location.href = '{{route('requirement')}}';
                    }
                    else {
                        alert("پیش نیازی تعریف شده در سامانه موجود است")
                    }
                }
            });

        }
        
    </script>
@stop