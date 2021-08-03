@extends('layout.myStructure')

@section('header')
    @parent

    <script src = {{URL::asset("js/jalali.js")}}></script>
    <script src = {{URL::asset("js/calendar.js")}}></script>
    <script src = {{URL::asset("js/calendar-setup.js")}}></script>
    <script src = {{URL::asset("js/calendar-fa.js")}}></script>

    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/standalone.css')}}">
    <link rel="stylesheet" href = {{URL::asset("css/calendar-green.css") }}>

    <style>
        td{
            padding: 5px;
        }

        .calendar {
            z-index: 100000;
            position: fixed !important;
            left: 40% !important;
            margin-top: -20px;
        }

        .col-xs-12 {
            margin-top: 10px;
        }

        label {
            min-width: 200px;
        }

    </style>

@stop

@section('main')

    <div class="top_part navbar-fixed-top">
        <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
        <img onclick="document.location.href = '{{route('certificates', ['eventId' => $eventId])}}'" src="{{URL::asset('images/left.png')}}" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">
    </div>


    <div class="container-fluid">

        <div class="totalPane">

            <div class="row" style="margin-top: 100px">
                <form method="post" action="{{route('doPublishCertificate', ['eventId' => $eventId, 'uId' => $user->id])}}">
                    {{csrf_field()}}
                    <center class="col-xs-12">
                        <label for="cerCode">کد مدرک</label>
                        <input type="text" value="{{$user->cerCode}}" maxlength="50" name="cerCode" id="cerCode" required>
                    </center>
                    <center class="col-xs-12">
                        <label for="eventName">نام دوره</label>
                        <input disabled type="text" value="{{$user->event->name}}" id="eventName">
                    </center>

                    <center class="col-xs-12">
                        <label for="name">نام شرکت کننده</label>
                        <input disabled type="text" value="{{$user->firstName . " " . $user->lastName}}" id="name">
                    </center>

                    <center class="col-xs-12">
                        <label for="fatherName">نام پدر</label>
                        <input disabled type="text" value="{{$user->additionalInfo->fatherName}}" id="fatherName">
                    </center>

                    <center class="col-xs-12">
                        <label for="NID">کد ملی</label>
                        <input disabled type="text" value="{{$user->additionalInfo->NID}}" id="NID">
                    </center>

                    <center class="col-xs-12">
                        <label for="launcher">برگزار کننده</label>
                        <input disabled type="text" value="{{$user->event->launcher}}" id="launcher">
                    </center>

                    <center class="col-xs-12">
                        <label for="startDate">تاریخ شروع دوره</label>
                        <input disabled type="text" value="{{$user->startDate}}" id="startDate">
                    </center>

                    <center class="col-xs-12">
                        <label for="endDate">تاریخ پایان دوره</label>
                        <input disabled type="text" value="{{$user->endDate}}" id="endDate">
                    </center>

                    <center class="col-xs-12">
                        <label for="length">تعداد دقیقه آموزش</label>
                        <input disabled type="text" value="{{$user->eventLength}}" id="length">
                    </center>

                    <center class="col-xs-12" style="margin-top: 5px">
                        <label>
                            <span>تاریخ صدور گواهی</span>
                            <input class="glyphicon glyphicon-plus" type="button" style="border: none; width: 30px; height: 30px; background: url({{ URL::asset('images/calendar-flat.png') }}) repeat 0 0; background-size: 100% 100%;" id="date_btn">
                        </label>
                        <input type="text" style="max-width: 200px" value="{{$user->publishDate}}" name="publishDate" id="publishDate" readonly required>
                        <script>
                            Calendar.setup({
                                inputField: "publishDate",
                                button: "date_btn",
                                ifFormat: "%Y/%m/%d",
                                dateType: "jalali"
                            });
                        </script>
                    </center>

                    <center class="col-xs-12">
                        <input type="submit" class="btn btn-success" value="صدور مدرک">
                    </center>
                </form>
            </div>
        </div>
    </div>

@stop