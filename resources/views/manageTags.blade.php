@extends('layout.myStructure')

@section('header')
    @parent

    <script src = {{URL::asset("js/jalali.js")}}></script>
    <script src = {{URL::asset("js/calendar.js")}}></script>
    <script src = {{URL::asset("js/calendar-setup.js")}}></script>
    <script src = {{URL::asset("js/calendar-fa.js")}}></script>

    <script src="{{URL::asset('js/jquery.timepicker.min.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('css/clockpicker.css')}}">
    <script src="{{URL::asset('js/clockpicker.js')}}"></script>

    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/standalone.css')}}">
    <link rel="stylesheet" href = {{URL::asset("css/calendar-green.css") }}>

    <script>
        var deleteUrl = '{{route('deleteEvent')}}';
        var selfUrl = '{{route('manageEvents')}}';
    </script>

    <style>
        .myInput2 {
            background-color: transparent !important;
        }

        select {
            color: black;
        }

        .calendar {
            z-index: 100000;
            position: fixed !important;
            left: 40% !important;
            margin-top: -20px;
        }

        .clockpicker-popover {
            top: 174px !important;
            left: 40% !important;
            width: 30% !important;
            right: auto !important;
        }

        .clockpicker-popover {
            z-index: 100000;
            direction: ltr;
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
            <div class="col-xs-12" id="tags"></div>
            <div class="col-xs-12">
                <select id="mode">
                    <option value="1">تونل</option>
                    <option value="2">مگ</option>
                    <option value="3">فان</option>
                </select>
                <input type="text" maxlength="100" id="name" placeholder="نام تگ">
                <div>
                    <label for="general">نمایش عمومی</label>
                    <input id="general" type="checkbox">
                </div>
                <button onclick="addTag()" class="btn btn-primary"><span class="glyphicon
                glyphicon-plus"></span></button>
            </div>
        </div>
    </div>

    <script>

        var selectedId;

        $(document).ready(function(){
            getTags();
        });

        function addTag() {

            var text = $("#name").val();

            if(text.length == 0) {
                alert("لطفا نام تگ مورد نظر خود را وارد نمایید");
                return;
            }

            var checked = ($("#general").prop('checked')) ? "true" : "false";

            $.ajax({
                type: 'post',
                url: '{{route('addTag')}}',
                data: {
                    'name': text,
                    'mode': $("#mode").val(),
                    'general': checked
                },
                success: function (response) {
                    if(response == "ok")
                        getTags();
                }
            });
        }

        function deleteTag(id) {

            $.ajax({
                type: 'post',
                url: '{{route('deleteTag')}}',
                data: {
                    'id': id
                },
                success: function (response) {
                    if(response == "ok")
                        $("#div_" + id).css('display', 'none');
                }
            });
        }

        function doEditTag() {

            var text = $("#editName").val();

            if(text.length == 0) {
                alert("لطفا نام تگ مورد نظر خود را وارد نمایید");
                return;
            }

            $.ajax({
                type: 'post',
                url: '{{route('editTag')}}',
                data: {
                    'id': selectedId,
                    'text': text
                },
                success: function (response) {
                    if(response == "ok") {
                        $("#editTag").addClass('hidden');
                        $(".dark").addClass('hidden');
                        getTags();
                    }
                }
            });
        }

        function editTag(id, text) {
            selectedId = id;
            $("#editName").val(text);
            $("#editTag").removeClass('hidden');
            $(".dark").removeClass('hidden');
        }

        function getTags() {
            $.ajax({
                type: 'post',
                url: '{{route('getTags')}}',
                success: function (response) {
                    if(response.length > 0) {

                        response = JSON.parse(response);
                        newElement = "";

                        for(i = 0; i < response.length; i++) {
                            newElement += "<div id='div_" + response[i].id + "' class='col-xs-12'><span>" + response[i].name;
                            newElement += "</span>";
                            if(response[i].general)
                                newElement += "<span> عمومی </span>";
                            else
                                newElement += "<span> غیر عمومی </span>";

                            newElement += "<span> در " + response[i].mode + " </span>";

                            newElement += "<button onclick='deleteTag(\"" + response[i].id + "\")' " +
                                    "class='btn btn-danger'><span class='glyphicon " + "glyphicon-remove'></span></button><span>&nbsp;</span><button onclick='editTag(\"" + response[i].id +
                                    "\", \"" + response[i].name + "\")' " +
                                    "class='btn btn-success'><span class='glyphicon " +
                                    "glyphicon-edit'></span></button></div>";
                        }

                        $("#tags").empty().append(newElement);
                    }
                }
            });
        }

    </script>


    <span id="editTag" class="hidden myPopUp" style="z-index: 1000001 !important; top: 15% !important; max-height: 80% !important;">

    <div style="color: white">
        ویرایش تگ
    </div>

    <div class="border">
        <input type="text" maxlength="100" id="editName">
    </div>

    <center class="col-xs-12" style="margin-top: 50px">
        <input type="submit" onclick="doEditTag()" class="btn btn-success" style="font-size: 12px" value="ویرایش">
        <span class="btn btn-danger" onclick="$('#editTag').addClass('hidden'); $('.dark').addClass('hidden')
        ">بازگشت</span>
    </center>
</span>

@stop