@extends('layout.myStructure')

@section('header')
    @parent

    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <style>
        .myInput2 {
            background-color: transparent !important;
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
            <div class="col-xs-12" id="surveys"></div>
            <div class="col-xs-12">
                <textarea id="text" maxlength="1000" placeholder="حداکثر 1000 کاراکتر"></textarea>
                <button onclick="addSurveyQuestion()" class="btn btn-primary"><span class="glyphicon
                glyphicon-plus"></span></button>
            </div>
        </div>
    </div>

    <script>

        var selectedId;

        $(document).ready(function(){
            getSurveyQuestions();
        });

        function addSurveyQuestion() {

            var text = $("#text_ifr").contents().find("#tinymce").html();

            if(text.length == 0) {
                alert("لطفا متن مورد نظر خود را وارد نمایید");
                return;
            }

            $.ajax({
                type: 'post',
                url: '{{route('addSurveyQuestion')}}',
                data: {
                    'text': text
                },
                success: function (response) {
                    if(response == "ok")
                        getSurveyQuestions();
                }
            });
        }

        function deleteSurveyQuestion(id) {

            $.ajax({
                type: 'post',
                url: '{{route('deleteSurveyQuestion')}}',
                data: {
                    'id': id
                },
                success: function (response) {
                    if(response == "ok")
                        $("#div_" + id).css('display', 'none');
                }
            });
        }

        function doEditSurveyQuestion() {

            var text = $("#editText_ifr").contents().find("#tinymce").html();

            if(text.length == 0) {
                alert("لطفا متن مورد نظر خود را وارد نمایید");
                return;
            }

            $.ajax({
                type: 'post',
                url: '{{route('editSurveyQuestion')}}',
                data: {
                    'id': selectedId,
                    'text': text
                },
                success: function (response) {
                    if(response == "ok") {
                        $("#editSurveyQuestion").addClass('hidden');
                        $(".dark").addClass('hidden');
                        getSurveyQuestions();
                    }
                }
            });
        }

        function editSurveyQuestion(id, text) {
            selectedId = id;
            $("#editText_ifr").contents().find("#tinymce").html(text);
            $("#editSurveyQuestion").removeClass('hidden');
            $(".dark").removeClass('hidden');
        }

        function getSurveyQuestions() {
            $.ajax({
                type: 'post',
                url: '{{route('getSurveyQuestions')}}',
                success: function (response) {
                    if(response.length > 0) {

                        response = JSON.parse(response);
                        newElement = "";

                        for(i = 0; i < response.length; i++) {
                            newElement += "<div id='div_" + response[i].id + "' class='col-xs-12'><span>" + response[i]
                                            .text;
                            newElement += "</span><button onclick='deleteSurveyQuestion(\"" + response[i].id + "\")' " +
                                    "class='btn btn-danger'><span class='glyphicon " + "glyphicon-remove'></span></button><span>&nbsp;</span><button onclick='editSurveyQuestion(\"" + response[i].id +
                                    "\", \"" + response[i].text + "\")' " +
                                    "class='btn btn-success'><span class='glyphicon " +
                                    "glyphicon-edit'></span></button></div>";
                        }

                        $("#surveys").empty().append(newElement);
                    }
                }
            });
        }

    </script>


    <span id="editSurveyQuestion" class="hidden myPopUp" style="z-index: 1000001 !important; top: 15% !important; max-height: 80% !important;">

    <div style="color: white">
        ویرایش سوال
    </div>

    <div class="border" style="color: white">

        <textarea id="editText" placeholder="حداکثر 1000 کاراکتر"
                  maxlength="1000" class="text"></textarea>
    </div>

    <center class="col-xs-12" style="margin-top: 50px">
        <input type="submit" onclick="doEditSurveyQuestion()" class="btn btn-success" style="font-size: 12px" value="ویرایش">
        <span class="btn btn-danger" onclick="$('#editSurveyQuestion').addClass('hidden'); $('.dark').addClass('hidden')
        ">بازگشت</span>
    </center>
</span>

@stop