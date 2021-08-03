@extends('layout.myStructure')

@section('header')
    @parent
    {{--<link rel="stylesheet" href="{{URL::asset('css/quiz.css')}}">--}}
    <link rel="stylesheet" href="{{URL::asset('css/qus.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">


    <style>
        body {
            overflow: auto !important;
        }

        /*.mainRow {*/
        /*background-image: none;*/
        /*position: relative !important;*/
        /*overflow: visible !important;*/
        /*}*/

    </style>
    <script src="{{URL::asset('js/jsNeededForQuiz.js')}}"></script>
    <script>
        var changeAnsDir = '{{route('changeAns')}}';
        var profileDir = '{{route('profile')}}';

        $(document).ready(function () {
            $("#percent").empty().append({{$answered}} +"%");
        });

    </script>
@stop

@section('background')
@stop

@section('main')

    <div class="container-fluid">
        <div class="top_part  navbar-fixed-top">
            <p>پرسولیو</p>
            <div class="percent">
                <h3 style="font-weight: bolder;color: #0f0f0f;float: left;" id="percent"></h3>
            </div>
            <!--<img class="menu_icon" src="images/menuIcon.png" id="menu-toggle" width="50px">-->
        </div>


        <Div>


            <?php $idx = 0; ?>
            <div class="row  " style="margin-top: 80px;">
                @foreach($questions as $question)
                    <div class="box">
                        <div class="col-md-12 col-xs-12" style="margin-bottom: 50px;">
                            <h2>سوال&nbsp;{{($idx + 1)}}</h2>
                            <h3>{{$question->description}}</h3>
                            <div id="q_{{$idx}}" class="answers">
                                @if($roqs[$idx]->result == 5)
                                    <div onclick="changeAns('{{$question->qoqId}}', 5, '{{$idx}}')"
                                         class="answer answer_1 active"></div>
                                @else
                                    <div id="answer_{{$idx}}_5"
                                         onclick="changeAns('{{$question->qoqId}}', 5, '{{$idx}}')"
                                         class="answer answer_1"></div>
                                @endif
                                @if($roqs[$idx]->result == 4)
                                    <div onclick="changeAns('{{$question->qoqId}}', 4, '{{$idx}}')"
                                         class="answer answer_2 active"></div>
                                @else
                                    <div id="answer_{{$idx}}_4"
                                         onclick="changeAns('{{$question->qoqId}}', 4, '{{$idx}}')"
                                         class="answer answer_2"></div>
                                @endif
                                @if($roqs[$idx]->result == 3)
                                    <div onclick="changeAns('{{$question->qoqId}}', 3, '{{$idx}}')"
                                         class="answer answer_3 active"></div>
                                @else
                                    <div id="answer_{{$idx}}_3"
                                         onclick="changeAns('{{$question->qoqId}}', 3, '{{$idx}}')"
                                         class="answer answer_3"></div>
                                @endif
                                @if($roqs[$idx]->result == 2)
                                    <div onclick="changeAns('{{$question->qoqId}}', 2, '{{$idx}}')"
                                         class="answer answer_4 active"></div>
                                @else
                                    <div id="answer_{{$idx}}_2"
                                         onclick="changeAns('{{$question->qoqId}}', 2, '{{$idx}}')"
                                         class="answer answer_4"></div>
                                @endif
                                @if($roqs[$idx]->result == 1)
                                    <div onclick="changeAns('{{$question->qoqId}}', 1, '{{$idx}}')"
                                         class="answer answer_5 active"></div>
                                @else
                                    <div id="answer_{{$idx}}_1"
                                         onclick="changeAns('{{$question->qoqId}}', 1, '{{$idx}}')"
                                         class="answer answer_5"></div>
                                @endif
                            </div>
                            <div align="center" style="margin-left: auto">
                                <p style="float: right" class="text-success">موافقم</p>
                                <p style="float: left" class="text-danger">مخالفم</p>
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-xs-12 questionDiv">--}}
                    {{--<h3>سوال&nbsp;{{($idx + 1)}}</h3>--}}
                    {{--<div id="q_div_{{$idx}}" class="col-xs-12 question">--}}
                    {{--<h2 style="text-align: justify; font-weight: bolder">--}}
                    {{--{{$question->description}}--}}
                    {{--</h2>--}}

                    {{--<div  class="col-xs-12 choices">--}}

                    {{--<div class="col-xs-3" style="padding: 0 !important">--}}
                    {{--@if($roqs[$idx]->result == 5)--}}
                    {{--<div class="choice_{{$idx}}"  onclick="changeAns('{{$question->qoqId}}', 5, '{{$idx}}')" style="background-color: #660007; border: 8px solid #660007; margin-left: 10px; border-radius: 50%; height: 45px; width: 45px; margin-right: 6px; float: left; cursor: pointer;"></div>--}}
                    {{--@else--}}
                    {{--<div class="choice_{{$idx}}"   onclick="changeAns('{{$question->qoqId}}', 5, '{{$idx}}')" style="border: 8px solid #660007; margin-left: 10px; border-radius: 50%; height: 45px; width: 45px; margin-right: 6px; float: left; cursor: pointer;"></div>--}}
                    {{--@endif--}}
                    {{--<p style="float: left; margin-top: 10px; font-weight: bolder; color: #660007; font-size: 14px">بسیار مخالف</p>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-2" style="padding: 0 !important">--}}
                    {{--@if($roqs[$idx]->result == 4)--}}
                    {{--<div id="choice_4_{{$question->qoqId}}" onclick="changeAns('{{$question->qoqId}}', 4, '{{$idx}}')" class="choice_{{$idx}}" style="background-color: #660007; border: 8px solid #660007; border-radius: 50%; height: 35px; width: 35px; margin-top: 5px; margin-right: 6px; float: left; cursor: pointer;"></div>--}}
                    {{--@else--}}
                    {{--<div id="choice_4_{{$question->qoqId}}" onclick="changeAns('{{$question->qoqId}}', 4, '{{$idx}}')" class="choice_{{$idx}}" style="border: 8px solid #660007; border-radius: 50%; height: 35px; width: 35px; margin-top: 5px; margin-right: 6px; float: left; cursor: pointer;"></div>--}}
                    {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-2" style="padding: 0 !important; ">--}}
                    {{--@if($roqs[$idx]->result == 3)--}}
                    {{--<div id="choice_3_{{$question->qoqId}}" onclick="changeAns('{{$question->qoqId}}', 3, '{{$idx}}')" class="choice_{{$idx}}" style="background-color: #4d4d4e; border: 7px solid #4d4d4e; border-radius: 50%; height: 30px; width: 30px; margin-top: 8px; margin-right: 6px; cursor: pointer;"></div>--}}
                    {{--@else--}}
                    {{--<div id="choice_3_{{$question->qoqId}}" class="choice_{{$idx}}" onclick="changeAns('{{$question->qoqId}}', 3, '{{$idx}}')" style="border: 7px solid #4d4d4e; border-radius: 50%; height: 30px; width: 30px; margin-top: 8px; margin-right: 6px; cursor: pointer;"></div>--}}
                    {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-2" style="padding: 0 !important">--}}
                    {{--@if($roqs[$idx]->result == 2)--}}
                    {{--<div class="choice_{{$idx}}" onclick="changeAns('{{$question->qoqId}}', 2, '{{$idx}}')" id="choice_2_{{$question->qoqId}}" style="background-color: #00461e; border: 8px solid #00461e; border-radius: 50%; height: 35px; width: 35px; margin-top: 5px; float: right; cursor: pointer;"></div>--}}
                    {{--@else--}}
                    {{--<div class="choice_{{$idx}}" id="choice_2_{{$question->qoqId}}" onclick="changeAns('{{$question->qoqId}}', 2, '{{$idx}}')" style="border: 8px solid #00461e; border-radius: 50%; height: 35px; width: 35px; margin-top: 5px; float: right; cursor: pointer;"></div>--}}
                    {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-3" style="padding: 0 !important">--}}
                    {{--@if($roqs[$idx]->result == 1)--}}
                    {{--<div class="choice_{{$idx}}" onclick="changeAns('{{$question->qoqId}}', 1, '{{$idx}}')" id="choice_1_{{$question->qoqId}}" style="background-color: #00461e; border: 8px solid #00461e; margin-right: 10px; border-radius: 50%; height: 45px; width: 45px; float: right; cursor: pointer;"></div>--}}
                    {{--@else--}}
                    {{--<div class="choice_{{$idx}}" id="choice_1_{{$question->qoqId}}" onclick="changeAns('{{$question->qoqId}}', 1, '{{$idx}}')" style="border: 8px solid #00461e; margin-right: 10px; border-radius: 50%; height: 45px; width: 45px; float: right; cursor: pointer;"></div>--}}
                    {{--@endif--}}
                    {{--<p style="float: right; margin-top: 10px; font-weight: bolder; color: #00461e; font-size: 14px">بسیار موافقم</p>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <?php $idx++; ?>
                @endforeach
            </div>
            <div class="col-xs-12">
                <button id="finish" {{--onclick="$('#confirmation').removeClass('hidden')"--}}
                        style="margin-bottom: 150px;background-color: #3b0069;width: 150px;color: #ffffff;height: 50px;border-radius: 50px;border: 0;"
                        class=" ">پایان
                </button>
            </div>
        </Div>
    </div>
    <span id="confirmation" class="hidden myPopUp">

    </span>

    <script>
        document.getElementById("finish").onclick = function () {
            $('#confirmation').removeClass('hidden');
            document.getElementById("confirmation").innerHTML ="";
            var answered = $("#percent").text();
            if (answered == "100%") {
                document.getElementById("confirmation").innerHTML =answered+
                        '<h4>' +
                        '                        آیا از اتمام ارزیابی اطمینان دارید؟' +
                        '</h4>' +
                        "<div style='margin-top: 50px'>" +

                        "<button onclick=document.location.href='{{route('endQuiz', ['quizId' => 1])}}'" +
                        " id='yes' class='btn btn-success'>" +
                        "بله</button>" +

                        "<button onclick=" +
                        "$('#confirmation').addClass('hidden')" +
                        " class='btn btn-danger'>" +
                        "خیر</button>" +

                        "</div>";
            } else {
                document.getElementById("confirmation").innerHTML = "<h4> همه سوالات باید پاسخ داده شوند!</h4>" +
                        '<div style="margin-top: 50px">' +
                        "<button onclick=" +
                        "$('#confirmation').addClass('hidden')" +
                        " class='btn btn-info'>" +
                        "باشه!</button>" +
                        '</div>';
            }
        };
    </script>
@stop