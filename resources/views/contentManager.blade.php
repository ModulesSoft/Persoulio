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
        <img onclick="document.location.href = '{{route('manageEvents')}}'" src="{{URL::asset('images/left.png')}}" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">
    </div>

    <div class="container-fluid" style="margin-top: 100px">

        <div class="totalPane">
            @if(count($contents) == 0)
                <p>محتوایی در این بخش وجود ندارد</p>
            @endif
            @foreach($contents as $content)
                <div class="content">
                    <h3 style="color: white; width: 100%">{{$content->name}}</h3>
                    <p style="color: white">{!! html_entity_decode($content->description) !!}</p>
                    <p><span>هزینه</span><span>&nbsp;</span><span>{{$content->price}}</span><span>&nbsp;</span><span>تومان</span></p>
                    @if($content->mode == getValueInfo('mag'))
                        <p><span>چکیده</span><span>&nbsp;</span><span>{{$content->place}}</span></p>
                    @else
                        <p><span>مکان</span><span>&nbsp;</span><span>{{$content->place}}</span></p>
                        <p><span>استاد</span><span>&nbsp;</span><span>{{$content->launcher}}</span></p>
                        <p><span>طول دوره</span><span>&nbsp;</span><span>{{$content->duration}}</span><span>&nbsp;</span><span>دقیقه</span></p>
                        <p><span>سطح سختی</span><span>&nbsp;</span><span>{{$content->levelName}}</span></p>
                    @endif

                    <p><span>امتیاز</span><span>&nbsp;</span><span>{{$content->point}}</span></p>

                    <p><span>تیپ ها: </span><span>{{$content->tips}}</span></p>
                    <p><span>علاقه ها: </span><span>{{$content->likes}}</span></p>
                    <p><span>تاریخ ها: </span><span>{{$content->days}}</span></p>

                    @if($content->best)
                        <p>برترین</p>
                    @endif

                    <button class="btn btn-danger" onclick="deleteContent('{{$content->id}}')" data-toggle="tooltip"
                            title="حذف دوره">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <button class="btn btn-success" onclick="myEditContent('{{$content->id}}')" id="edit{{$content->id}}" data-toggle="tooltip" title="ویرایش دوره">
                        <span class="glyphicon glyphicon-edit"></span>
                    </button>
                    <button class="btn btn-warning" onclick="manageDate('{{$content->id}}')" data-toggle="tooltip"
                            title="مدیریت تاریخ های برگزاری">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </button>
                    <button class="btn btn-default" onclick="manageImages('{{$content->id}}')" data-toggle="tooltip" title="مدیریت تصاویر">
                        <span class="glyphicon glyphicon-camera"></span>
                    </button>

                    @if($content->mode == getValueInfo('mag'))
                        <button class="btn btn-default" onclick="togglePublish('{{$content->id}}')" data-toggle="tooltip" title="مدیریت تصاویر" style="margin: 10px">
                            <span>تغییر وضعیت نمایش</span><span>&nbsp;</span><span>وضعیت کنونی:</span>
                            <span>
                                @if($content->duration == 1)
                                    منتشر شده
                                @else
                                    منتشر نشده
                                @endif
                            </span>
                        </button>
                    @else
                        <button class="btn btn-primary" onclick="reLaunchContent('{{$content->id}}')" data-toggle="tooltip"
                                title="برگزاری مجدد دوره">
                            <span class="glyphicon glyphicon-refresh"></span>
                        </button>
                    @endif

                </div>
            @endforeach

            {{ $contents->links() }}

            <div style="margin-top: 20px">
                <button onclick="changeMode('mode', 'subMode'); $('#addContent').removeClass('hidden'); $('.dark').removeClass('hidden')" class="myBtn">افزودن محتوای جدید</button>
            </div>
        </div>

        <script src="{{URL::asset('ckeditor/ckeditor.js')}}"></script>
        <script src="{{URL::asset('js/jsNeededForContentManager.js')}}"></script>

        <script>

            $(document).ready(function () {

                $("input:file[id='newIMG']").on('change', prepareUpload);
                $('#submitBtn').on('click', addImage);

                $('input.timepicker').timepicker({
                    timeFormat: 'hh:mm:ss',
                    interval: 5,
                    minTime: '00:00',
                    maxTime: '11:55',
                    defaultTime: '07:00',
                    startTime: '00:00',
                    dynamic: true,
                    dropdown: true,
                    scrollbar: true
                });

                $('.clockpicker').clockpicker();

                @if(!empty($err))
                    $("#err").empty().append('{{$err}}');
                $("#addContent").removeClass('hidden');
                $(".dark").removeClass('hidden');
                @endif
            });

            var name, price, place, launcher, description, duration, mode, subMode, point, level, selectedEventId = -1;
            var best = "nok";
            var allTips = {!! json_encode($AllTips) !!};
            var factors = {!! json_encode($factors) !!};
            var allLikes = {!! json_encode($likes) !!};
            var contents = {!! json_encode($contentsJS) !!};
            var file;

            function prepareUpload(event)  {
                file = event.target.files;
            }

            function changeAll(name, id) {
                if($("#" + id).prop('checked'))
                    $("input:checkbox[name='" + name + "']").prop("checked", true);
                else
                    $("input:checkbox[name='" + name + "']").prop("checked", false);
            }

            function addEvent() {

                var tips = [], likes = [];

                name = $("#name").val();
                price = $("#price").val();
                mode = $("#mode").val();

                if(mode == '{{getValueInfo('mag')}}') {
                    place = $("#introduction").val();
                    duration = "0";
                    level = 1;
                    launcher = "";
                }
                else {
                    place = $("#place").val();
                    duration = $("#duration").val();
                    level = $("#level").val();
                    launcher = $("#launcher").val();
                    if(launcher.length == 0) {
                        alert("لطفا تمامی موارد الزامی را پر نمایید");
                        return;
                    }
                }

                description = $("#ckeditor_ifr").contents().find("#tinymce").html();
                subMode = $("#subMode").val();
                point = $("#point").val();


                if($("#best").prop('checked'))
                    best = "ok";

                if(name.length == 0 || price.length == 0 || place.length == 0 || point.length == 0 ||
                        description.length == 0 || duration.length == 0) {
                    alert("لطفا تمامی موارد الزامی را پر نمایید");
                    return;
                }

                $.each($("input[name='tipId']:checked"), function(){
                    tips.push($(this).val());
                });

                if(tips.length == 0) {
                    alert("لطفا تیپ شخصیتی مورد نظر خود را وارد نمایید");
                    return;
                }

                $.each($("input[name='likeId']:checked"), function(){
                    likes.push($(this).val());
                });

                if(likes.length == 0) {
                    alert("لطفا لیست علاقه مندی خود را وارد نمایید");
                    return;
                }

                $.ajax({
                    type: 'post',
                    url: '{{route('addEvent')}}',
                    data: {
                        'name': name,
                        'price': price,
                        'place': place,
                        'launcher': launcher,
                        'description': description,
                        'duration': duration,
                        'mode': mode,
                        'subMode': subMode,
                        'likes': likes,
                        'tips': tips,
                        'point': point,
                        'level': level,
                        'best': best
                    },
                    success: function (response) {
                        if(response == "ok")
                            document.location.href = '{{route('manageEvents')}}';
                    }
                });

            }

            function reLaunchContent(id) {
                $.ajax({
                    type: 'post',
                    url: '{{route('reLaunchContent')}}',
                    data: {
                        'id': id
                    },
                    success: function (response) {
                        if(response == 'ok')
                            alert('دوره به روز شد');
                    }
                });
            }

            function togglePublish(id) {
                $.ajax({
                    type: 'post',
                    url: '{{route('togglePublish')}}',
                    data: {
                        'id': id
                    },
                    success: function (response) {
                        if(response == 'ok')
                            document.location.href = '{{route('manageEvents')}}';
                        else if(response == "nok2") {
                            alert('برای این کار باید دقیقا دو تاریخ به مگ مورد نظر اختصاص داده شود');
                        }
                    }
                });
            }

            function removeDate(id) {

                $.ajax({
                    type: 'post',
                    url: '{{route('removeDate')}}',
                    data: {
                        'id': id
                    },
                    success: function (response) {
                        if(response == "ok")
                            $("#date_" + id).addClass('hidden');
                    }
                });
            }

            function removeImage(id) {

                $.ajax({
                    type: 'post',
                    url: '{{route('removeImage')}}',
                    data: {
                        'id': id
                    },
                    success: function (response) {
                        if(response == "ok")
                            $("#IMG_" + id).addClass('hidden');
                    }
                });
            }

            function manageDate(id) {

                selectedEventId = id;

                $.ajax({
                    type: 'post',
                    url: '{{route('getEventDates')}}',
                    data: {
                        'id': id
                    },
                    success: function (response) {

                        if(response.length > 0) {
                            response = JSON.parse(response);
                            newElement = "";
                            for(i = 0; i < response.length; i++) {
                                newElement += "<div id='date_" + response[i].id +"' style='margin: 6px'><span style='color: white'>" + response[i].date + "</span><span> - </span><span style='color: white'>" + response[i].startTime + "</span>";
                                newElement += "<button onclick='removeDate(\"" + response[i].id + "\")' class='btn btn-danger'>";
                                newElement += "<span class='glyphicon glyphicon-remove'><span";
                                newElement += "</button></div>";
                            }

                            $("#dates").empty().append(newElement);
                        }
                        $("#manageDate").removeClass('hidden');
                        $(".dark").removeClass('hidden');
                    }
                });
            }

            function manageImages(id) {

                selectedEventId = id;

                $.ajax({
                    type: 'post',
                    url: '{{route('getEventImages')}}',
                    data: {
                        'id': id
                    },
                    success: function (response) {

                        if(response.length > 0) {
                            response = JSON.parse(response);
                            newElement = "";
                            for(i = 0; i < response.length; i++) {
                                newElement += "<div class='col-xs-12' id='IMG_" + response[i].id +"' style='margin: 6px'><img class='col-xs-12' style='max-width: 100%' src='" + response[i].pic + "'>";
                                newElement += "<button onclick='removeImage(\"" + response[i].id + "\")' class='btn btn-danger'>";
                                newElement += "<span class='glyphicon glyphicon-remove'><span";
                                newElement += "</button></div>";
                            }

                            $("#images").empty().append(newElement);
                        }
                        $("#manageImage").removeClass('hidden');
                        $(".dark").removeClass('hidden');
                    }
                });
            }

            function addDate() {

                date = $("#date_input").val();

                if(date.length == 0) {
                    alert("لطفا تاریخ مورد نظر خود را وارد نمایید");
                    return;
                }

                sTime = $("#sTime").val();

                if(sTime.length == 0) {
                    alert("لطفا زمان شروع مورد نظر خود را وارد نمایید");
                    return;
                }

                $.ajax({
                    type: 'post',
                    url: '{{route('addDate')}}',
                    data: {
                        'eventId': selectedEventId,
                        'date': date,
                        'sTime': sTime
                    },
                    success: function (response) {
                        if(response == "ok")
                            manageDate(selectedEventId);
                        else if(response == "nok2")
                            alert("بیش از دو تاریخ نمی تواند به یک مگ اختصاص یابد");
                    }
                });
            }

            function doEdit() {

                var tips = [], likes = [];

                name = $("#nameE").val();
                price = $("#priceE").val();
                mode = $("#modeE").val();

                if(mode == '{{getValueInfo('mag')}}') {
                    place = $("#introductionE").val();
                    duration = "0";
                    level = 1;
                    launcher = "";
                }
                else {
                    level = $("#levelE").val();
                    duration = $("#durationE").val();
                    launcher = $("#launcherE").val();
                    place = $("#placeE").val();
                    if(launcher.length == 0) {
                        alert("لطفا تمامی موارد الزامی را پر نمایید");
                        return;
                    }
                }

                description = $("#ckeditorE_ifr").contents().find("#tinymce").html();
                subMode = $("#subModeE").val();
                point = $("#pointE").val();

                if($("#bestE").prop('checked'))
                    best = "ok";

                if(name.length == 0 || price.length == 0 || place.length == 0 || point.length == 0 ||
                        description.length == 0 || duration.length == 0) {
                    alert("لطفا تمامی موارد الزامی را پر نمایید");
                    return;
                }

                $.each($("input[name='tipIdE']:checked"), function(){
                    tips.push($(this).val());
                });

                if(tips.length == 0) {
                    alert("لطفا تیپ شخصیتی مورد نظر خود را وارد نمایید");
                    return;
                }

                $.each($("input[name='likeIdE']:checked"), function(){
                    likes.push($(this).val());
                });

                if(likes.length == 0) {
                    alert("لطفا لیست علاقه مندی خود را وارد نمایید");
                    return;
                }

                $.ajax({
                    type: 'post',
                    url: '{{route('editEvent')}}',
                    data: {
                        'name': name,
                        'price': price,
                        'place': place,
                        'launcher': launcher,
                        'description': description,
                        'duration': duration,
                        'mode': mode,
                        'subMode': subMode,
                        'likes': likes,
                        'tips': tips,
                        'id': selectedEventId,
                        'point': point,
                        'level': level,
                        'best': best
                    },
                    success: function (response) {
                        if(response == "ok")
                            document.location.href = '{{route('manageEvents')}}';
                    }
                });
            }

            function myEditContent(id) {

                selectedEventId = id;

                $.ajax({
                    type: 'post',
                    url: '{{route('getTipsAndLikes')}}',
                    data: {
                        'id': id
                    },
                    success: function (response) {

                        if(response.length > 0) {
                            response = JSON.parse(response);
                            newElement = "";

                            for(i = 0; i < factors.length; i++) {
                                newElement += '<div class="col-xs-12">';
                                newElement += '<div class="col-xs-2">';
                                newElement += '<label for="factorIdE_' + factors[i].id + '">' + factors[i].name + '</label>';
                                newElement += '<input id="factorIdE_' + factors[i].id + '" type="checkbox" name="factorIdE" value="' + factors[i].id + '">';
                                newElement += '</div><div class="col-xs-5"><label for="floorE_' + factors[i].id + '">کف</label>';
                                newElement += '<input style="color: black; max-width: 100px" type="number" min="0" id="input_floorE_' + factors[i].id + '">';
                                newElement += '</div><div class="col-xs-5"><label for="ceilE_' + factors[i].id + '">سقف</label>';
                                newElement += '<input style="color: black; max-width: 100px" type="number" min="0" id="input_ceilE_' + factors[i].id + '">';
                                newElement += '</div></div>';
                            }

                            newElement += '<center><input type="submit" onclick="filterE()" class="btn btn-success" value="اعمال فیلتر" style="margin: 10px">';
                            newElement += '</center>';

                            for(i = 0; i < allTips.length; i++) {
                                newElement += '<div class="col-xs-3 tipCheckBoxE"';
                                for(j = 0; j < allTips[i].constraints.length; j++) {
                                    newElement += 'ceil_' + allTips[i].constraints[j].factorId + '=' + allTips[i].constraints[j].ceil;
                                    newElement += ' floor_' + allTips[i].constraints[j].factorId + '=' + allTips[i].constraints[j].floor;
                                }
                                newElement += '>';
                                newElement += '<label for="tipIdE_' + allTips[i].id + '">' + allTips[i].name + '</label>';
                                for(j = 0; j < response.tips.length; j++) {
                                    if(allTips[i].id == response.tips[j].tipId) {
                                        newElement += '<input checked id="tipIdE_' + allTips[i].id +'" type="checkbox" name="tipIdE" value="' + allTips[i].id + '">';
                                        break;
                                    }
                                }

                                if(j == response.tips.length)
                                    newElement += '<input id="tipIdE_' + allTips[i].id +'" type="checkbox" name="tipIdE" value="' + allTips[i].id + '">';

                                newElement += "</div>";
                            }

                            newElement += "<div class='col-xs-3'><label for='allTipE'>همه</label><input id='allTipE' name='all' " +
                                    "type='checkbox' onchange='changeAll(\"tipIdE\", \"allTipE\")'></div>";

                            $("#editTipsPane").empty().append(newElement);
                            newElement = "";

                            for(i = 0; i < allLikes.length; i++) {
                                newElement += '<div class="col-xs-6">';
                                newElement += '<label for="likeIdE_' + allLikes[i].id + '">' + allLikes[i].name + '</label>';
                                for(j = 0; j < response.likes.length; j++) {
                                    if(allLikes[i].id == response.likes[j].likeId) {
                                        newElement += '<input checked id="likeIdE_' + allLikes[i].id +'" type="checkbox" name="likeIdE" value="' + allLikes[i].id + '">';
                                        break;
                                    }
                                }

                                if(j == response.likes.length)
                                    newElement += '<input id="likeIdE_' + allLikes[i].id +'" type="checkbox" name="likeIdE" value="' + allLikes[i].id + '">';

                                newElement += "</div>";
                            }

                            newElement += "<div class='col-xs-6'><label for='allLikeE'>همه</label><input id='allLikeE' name='all' " +
                                    "type='checkbox' onchange='changeAll(\"likeIdE\", \"allLikeE\")'></div>";

                            $("#editLikesPane").empty().append(newElement);
                        }

                        for(i = 0; i < contents.length; i++) {
                            if(contents[i].id == id) {
                                $("#nameE").val(contents[i].name);
                                $("#priceE").val(contents[i].price);
                                $("#placeE").val(contents[i].place);
                                $("#launcherE").val(contents[i].launcher);
                                $("#durationE").val(contents[i].duration);
                                $("#modeE").val(contents[i].mode);
                                $("#pointE").val(contents[i].point);
                                $("#levelE").val(contents[i].level);

                                if(contents[i].best)
                                    $("#bestE").prop('checked', 'checked');

                                $("#ckeditorE_ifr").contents().find("#tinymce").html(contents[i].description);
                                changeMode2('modeE', 'subModeE', contents[i].subMode);
                                break;
                            }
                        }

                        $("#editContent").removeClass('hidden');
                        $(".dark").removeClass('hidden');

                    }
                });


            }

            function addImage(event) {

                event.stopPropagation();
                event.preventDefault();

                var data = new FormData();
                $.each(file, function(key, value) {
                    data.append(key, value);
                });

                $.ajax({
                    type: 'POST',
                    url: '{{route('root')}}' + '/addImage/' + selectedEventId,
                    data: data,
                    cache: false,
                    processData: false, // Don't process the files
                    contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                    success: function (response) {
                        if(response == "ok")
                            manageImages(selectedEventId);
                    }
                });
            }

            function changeMode(id, id2) {

                var mode = $("#" + id).val();

                $.ajax({
                    type: 'post',
                    url: '{{route('getTags')}}',
                    data: {
                        'mode': mode
                    },
                    success: function (response) {

                        newElement = "";

                        if(mode == '{{getValueInfo('mag')}}') {
                            $("#introduction").removeClass('hidden');
                            $("#place").addClass('hidden');
                            $("#launcher").addClass('hidden');
                            $("#levelDiv").addClass('hidden');
                            $("#duration").addClass('hidden');
                        }
                        else {
                            $("#introduction").addClass('hidden');
                            $("#place").removeClass('hidden');
                            $("#launcher").removeClass('hidden');
                            $("#levelDiv").removeClass('hidden');
                            $("#duration").removeClass('hidden');
                        }

                        response = JSON.parse(response);
                        for(i = 0; i < response.length; i++) {
                            newElement += "<option value='" + response[i].id + "'>" + response[i].name + "</option>";
                        }

                        $("#" + id2).empty().append(newElement);

                        if(mode == 3)
                            $(".best").removeClass('hidden');
                        else
                            $(".best").addClass('hidden');

                    }
                });
            }

            function changeMode2(id, id2, val) {

                var mode = $("#" + id).val();

                $.ajax({
                    type: 'post',
                    url: '{{route('getTags')}}',
                    data: {
                        'mode': mode
                    },
                    success: function (response) {

                        newElement = "";
                        response = JSON.parse(response);

                        if(mode == '{{getValueInfo('mag')}}') {
                            $("#introductionE").removeClass('hidden');
                            $("#placeE").addClass('hidden');
                            $("#launcherE").addClass('hidden');
                            $("#levelDivE").addClass('hidden');
                            $("#durationE").addClass('hidden');
                        }
                        else {
                            $("#introductionE").addClass('hidden');
                            $("#placeE").removeClass('hidden');
                            $("#launcherE").removeClass('hidden');
                            $("#levelDivE").removeClass('hidden');
                            $("#durationE").removeClass('hidden');
                        }

                        for(i = 0; i < response.length; i++) {
                            if(val == response[i].id)
                                newElement += "<option selected value='" + response[i].id + "'>" + response[i].name +
                                        "</option>";
                            else
                                newElement += "<option value='" + response[i].id + "'>" + response[i].name + "</option>";
                        }

                        $("#" + id2).empty().append(newElement);

                        if(mode == 3)
                            $(".best").removeClass('hidden');
                        else
                            $(".best").addClass('hidden');
                    }
                });
            }
        </script>


        <span id="manageDate" class="hidden myPopUp" style="z-index: 1000001 !important; top: 15% !important; max-height: 80% !important;">
            <div style="color: white">
                مدیریت تاریخ های برگزاری
            </div>
            <div class="border">
                <div id="dates" style="max-height: 300px; overflow: auto"></div>

                <center class="col-xs-12" style="margin-top: 5px">
                    <label>
                        <input class="glyphicon glyphicon-plus" type="button" style="border: none; width: 30px; height: 30px; background: url({{ URL::asset('images/calendar-flat.png') }}) repeat 0 0; background-size: 100% 100%;" id="date_btn">
                    </label>
                    <input type="text" style="max-width: 200px" class="form-detail" id="date_input" readonly>
                    <script>
                        Calendar.setup({
                            inputField: "date_input",
                            button: "date_btn",
                            ifFormat: "%Y/%m/%d",
                            dateType: "jalali"
                        });
                    </script>
                </center>

                <center class="col-xs-12" style="margin-top: 5px">
                    <label>
                        <span style="color: white">ساعت شروع</span>
                    </label>
                    <div class="clockpicker">
                        <input type="text" id="sTime" style="direction: ltr" class="form-detail form-control" value="09:30">
                    </div>
                </center>
            </div>

            <center class="col-xs-12" style="margin-top: 50px">
                <input type="submit" onclick="addDate()" class="btn btn-success" style="font-size: 12px" value="ثبت">
                <span class="btn btn-danger" onclick="$('#manageDate').addClass('hidden'); $('.dark').addClass('hidden')
                ">بازگشت</span>
            </center>
            <p style="color: white" id="errEdit"></p>
        </span>

        <span id="manageImage" class="hidden myPopUp" style="z-index: 1000001 !important; top: 15% !important; max-height: 80% !important;">
            <div style="color: white">
                مدیریت تصاویر
            </div>
            <div class="col-xs-12" style="color: white;">

                <div class="col-xs-12" id="images" style="max-height: 300px; overflow: auto"></div>

                <center class="col-xs-12" style="margin-top: 5px">
                    <label for="newIMG">تصویر جدید</label>
                    <input id="newIMG" type="file" accept="image/jpeg">
                </center>
            </div>

            <center class="col-xs-12" style="margin-top: 50px">
                <input type="submit" id="submitBtn" class="btn btn-success" style="font-size: 12px" value="ثبت">
                <span class="btn btn-danger" onclick="$('#manageImage').addClass('hidden'); $('.dark').addClass('hidden')
                ">بازگشت</span>
            </center>
            <p style="color: white" id="errEdit"></p>
        </span>

        <span id="editContent" class="hidden myPopUp" style="z-index: 1000001 !important; top: 15% !important; max-height: 80% !important;">

            <div style="color: white">
                ویرایش محتوا
            </div>

            <div class="border" style="color: white">

                <div>
                    <label for="modeE">بخش مورد نظر</label>
                    <select id="modeE" onchange="changeMode('modeE', 'subModeE')" style="color: black !important;">
                        <option value="1">تونل</option>
                        <option value="2">مگ</option>
                        <option value="3">فان</option>
                    </select>
                </div>

                <div>
                    <label for="subModeE">زیربخش مورد نظر</label>
                    <select style="color: black" id="subModeE"></select>
                </div>

                <div id="levelDivE">
                    <label for="levelE">سطح کلاس</label>
                    <select id="levelE">
                        <option value="{{getValueInfo('simple')}}">ساده</option>
                        <option value="{{getValueInfo('avg')}}">متوسط</option>
                        <option value="{{getValueInfo('advance')}}">پیشرفته</option>
                    </select>
                </div>

                <input style="font-size: 10px !important;" placeholder="نام" type="text"
                       maxlength="300" id="nameE" class="myInput2">
                <input style="font-size: 10px !important;" placeholder="هزینه" type="number"
                       min="0" id="priceE" class="myInput2">
                <input style="font-size: 10px !important;" placeholder="مکان" type="text"
                       maxlength="1000" id="placeE" class="myInput2">
                <input style="color: black; width: 200px; height: 300px" placeholder="خلاصه مطلب" id="introductionE" type="text" maxlength="1000" class="hidden">
                <input style="font-size: 10px !important;" placeholder="استاد" type="text"
                       maxlength="100" id="launcherE" class="myInput2">
                <textarea id="ckeditorE" placeholder="توضیحات"
                          maxlength="1000" class="text"></textarea>
                <input style="font-size: 10px !important;" placeholder="مدت دوره (به دقیقه)" type="number"
                       min="1" id="durationE" class="myInput2">

                <input style="font-size: 10px !important;" placeholder="امتیاز" type="number" min="0"
                       max="10000" id="pointE" class="myInput2">

                <div class="best hidden">
                    <label for="bestE">برترین</label>
                    <input type="checkbox" id="bestE">
                </div>

                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <h4>تیپ مورد نظر</h4>
                    </div>
                    <div class="col-xs-12" id="editTipsPane"></div>
                </div>

                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <h4>علاقه مورد نظر</h4>
                    </div>
                    <div class="col-xs-12" id="editLikesPane"></div>
                </div>
            </div>

            <center class="col-xs-12" style="margin-top: 50px">
                <input type="submit" onclick="doEdit()" class="btn btn-success" style="font-size: 12px" value="ویرایش">
                <span class="btn btn-danger" onclick="$('#editContent').addClass('hidden'); $('.dark').addClass('hidden')
                ">بازگشت</span>
            </center>

            <p style="color: white" id="errEdit"></p>
        </span>

        <span id="addContent" class="hidden myPopUp" style="z-index: 1000001 !important;; top: 15% !important; max-height: 80% !important;">

            <div style="color: white">
                افزودن محتوای جدید
            </div>

            <center style="color: white" class="col-xs-12">

                <div>
                    <label for="mode">بخش مورد نظر</label>
                    <select id="mode" onchange="changeMode('mode', 'subMode')" style="color: black !important;">
                        <option value="1">تونل</option>
                        <option value="2">مگ</option>
                        <option value="3">فان</option>
                    </select>
                </div>

                <div>
                    <label for="subMode">زیربخش مورد نظر</label>
                    <select style="color: black" id="subMode"></select>
                </div>

                <div id="levelDiv">
                    <label for="level">سطح کلاس</label>
                    <select id="level">
                        <option value="{{getValueInfo('simple')}}">ساده</option>
                        <option value="{{getValueInfo('avg')}}">متوسط</option>
                        <option value="{{getValueInfo('advance')}}">پیشرفته</option>
                    </select>
                </div>

                <input style="font-size: 10px !important;" placeholder="نام" type="text"
                       maxlength="300" id="name" class="myInput2">
                <input style="font-size: 10px !important;" placeholder="هزینه" type="number"
                       min="0" id="price" class="myInput2">
                <input style="font-size: 10px !important;" placeholder="مکان" type="text" maxlength="1000" id="place" class="myInput2">
                <input style="color: black; width: 200px; height: 300px" placeholder="خلاصه مطلب" id="introduction" type="text" maxlength="1000" class="hidden">
                <input style="font-size: 10px !important;" placeholder="استاد" type="text"
                       maxlength="100" id="launcher" class="myInput2">
                <textarea id="ckeditor" placeholder="توضیحات" maxlength="1000" class="text"></textarea>
                <input style="font-size: 10px !important;" placeholder="مدت دوره (به دقیقه)" type="number"
                       min="1" id="duration" class="myInput2">
                <input style="font-size: 10px !important;" placeholder="امتیاز" type="number" min="0"
                       max="10000" id="point" class="myInput2">

                <div class="best hidden">
                    <label for="best">برترین</label>
                    <input type="checkbox" id="best">
                </div>

                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <h4>تیپ مورد نظر</h4>
                        @foreach($factors as $itr)
                            <div class="col-xs-12">
                                <div class="col-xs-2">
                                    <label for="factorId_{{$itr->id}}">{{$itr->name}}</label>
                                    <input id="factorId_{{$itr->id}}" type="checkbox" name="factorId" value="{{$itr->id}}">
                                </div>
                                <div class="col-xs-5">
                                    <label for="floor_{{$itr->id}}">کف</label>
                                    <input style="color: black; max-width: 100px" type="number" min="0" id="input_floor_{{$itr->id}}">
                                </div>
                                <div class="col-xs-5">
                                    <label for="ceil_{{$itr->id}}">سقف</label>
                                    <input style="color: black; max-width: 100px" type="number" min="0" id="input_ceil_{{$itr->id}}">
                                </div>
                            </div>
                        @endforeach
                        <center>
                            <input type="submit" onclick="filter()" class="btn btn-success" value="اعمال فیلتر" style="margin: 10px">
                        </center>
                    </div>
                    @foreach($AllTips as $tip)
                        <div class="col-xs-3 tipCheckBox"
                            @foreach($tip->constraints as $itr)
                                {{ "ceil_" . $itr->factorId . '=' . $itr->ceil . ' floor_' . $itr->factorId . '=' . $itr->floor}}
                            @endforeach
                        >
                            <label for="tipId_{{$tip->id}}">{{$tip->name}}</label>
                            <input id="tipId_{{$tip->id}}" type="checkbox" name="tipId" value="{{$tip->id}}">
                        </div>
                    @endforeach

                    <div class='col-xs-3'>
                        <label for='allTip'>همه</label>
                        <input id='allTip' name='all' type='checkbox' onchange='changeAll("tipId", "allTip")'>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <h4>علاقه مورد نظر</h4>
                    </div>
                    @foreach($likes as $tip)
                        <div class="col-xs-6">
                        <label for="likeId_{{$tip->id}}">{{$tip->name}}</label>
                        <input id="likeId_{{$tip->id}}" type="checkbox" name="likeId" value="{{$tip->id}}">
                    </div>
                    @endforeach

                    <div class='col-xs-6'>
                        <label for='allLike'>همه</label>
                        <input id='allLike' name='all' type='checkbox' onchange='changeAll("likeId", "allLike")'>
                    </div>
                </div>
            </center>

            <center style="margin-top: 50px">
                <input type="submit" class="btn btn-success" style="font-size: 12px" value="ارسال" onclick="addEvent()">
                <span class="btn btn-danger" onclick="$('#addContent').addClass('hidden'); $('.dark').addClass('hidden')">بازگشت</span>
            </center>

            <p style="color: white" id="err"></p>
        </span>
    </div>
@stop

