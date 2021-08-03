@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">

    <script>

        var getMyRequestsStatusDir = '{{route('getMyRequestsStatus')}}';
        var selectedUId;
        var cancelRequestDir = '{{route('cancelRequest')}}';
        var getRequestsDir = '{{route('getRequests')}}';
        var acceptRequestDir = '{{route('acceptRequest')}}';
        var rejectRequestDir = '{{route('rejectRequest')}}';
        var getBlocksDir = '{{route('getBlocks')}}';
        var unBlockDir = '{{route('unBlock')}}';
        var getAcceptedDir = '{{route('getAccepted')}}';
        var blockDir = '{{route('reject')}}';

        $(document).ready(function () {
            getMyRequestsStatus();
        });

        function getRequests() {

            $(".titleDiv").css('background-color', 'transparent');
            $("#requestsDiv").css('background-color', 'rgba(30, 0, 53, 0.6)');

            $.ajax({
                type: 'post',
                url: getRequestsDir,
                success: function (response) {

                    $("#usersContainer").empty();

                    if(response.length == 0)
                        return;

                    response = JSON.parse(response);
                    newElement = "";

                    for(i = 0; i < response.length; i++) {

                        newElement += "<div class='col-xs-3' onclick='showMoreInfo(\"" + response[i].srcId + "\", \"" + response[i].state + "\", \"" + response[i].field + "\", \"" + response[i].bio + "\", \"" + response[i].firstName + "\", \"" + response[i].lastName + "\", \"" + response[i].photo + "\", \"requests\");' style='height: 100px'>";
                        newElement += "<img class='friendPhoto' width='100%' height='100%' src='" + response[i].photo + "'>";
                        newElement += "<p><span>" + response[i].firstName + "</span><span>&nbsp;</span><span>" + response[i].lastName + "</span></p>";
                        newElement += "<p><span>درخواست به عنوان: </span><span>" + response[i].mode + "</span></p>";
                        newElement += "</div>";
                    }

                    $("#usersContainer").append(newElement);

                }
            });
        }

        function getRequestsWithMode(mode) {

            $(".titleDiv").css('background-color', 'transparent');
            $("#requestsDiv").css('background-color', 'rgba(30, 0, 53, 0.6)');

            $.ajax({
                type: 'post',
                url: getRequestsDir,
                data: {
                    'mode': mode
                },
                success: function (response) {

                    $("#usersContainer").empty();

                    if(response.length == 0)
                        return;

                    response = JSON.parse(response);
                    newElement = "";

                    for(i = 0; i < response.length; i++) {

                        newElement += "<div class='col-xs-3' onclick='showMoreInfo(\"" + response[i].srcId + "\", \"" + response[i].state + "\", \"" + response[i].field + "\", \"" + response[i].bio + "\", \"" + response[i].firstName + "\", \"" + response[i].lastName + "\", \"" + response[i].photo + "\", \"requests\");' style='height: 100px'>";
                        newElement += "<img class='friendPhoto' width='100%' height='100%' src='" + response[i].photo + "'>";
                        newElement += "<p><span>" + response[i].firstName + "</span><span>&nbsp;</span><span>" + response[i].lastName + "</span></p>";
                        newElement += "<p><span>درخواست به عنوان: </span><span>" + response[i].mode + "</span></p>";
                        newElement += "</div>";
                    }

                    $("#usersContainer").append(newElement);

                }
            });
        }

        function getMyRequestsStatusWithMode(mode) {

            $(".titleDiv").css('background-color', 'transparent');
            $("#myRequestsDiv").css('background-color', 'rgba(30, 0, 53, 0.6)');

            $.ajax({
                type: 'post',
                url: getMyRequestsStatusDir,
                data: {
                    'mode': mode
                },
                success: function (response) {

                    $("#usersContainer").empty();

                    if(response.length == 0)
                        return;

                    response = JSON.parse(response);
                    newElement = "";

                    for(i = 0; i < response.length; i++) {

                        newElement += "<div class='col-xs-4' onclick='showMoreInfo(\"" + response[i].destId + "\", \"" + response[i].state + "\", \"" + response[i].field + "\", \"" + response[i].bio + "\", \"" + response[i].firstName + "\", \"" + response[i].lastName + "\", \"" + response[i].photo + "\", \"myRequest\");' style='height: 100px'>";
                        newElement += "<img class='friendPhoto' width='100%' height='80%' src='" + response[i].photo + "'>";
                        newElement += "<p><span>" + response[i].firstName + "</span><span>&nbsp;</span><span>" + response[i].lastName + "</span></p>";
                        newElement += "<p><span>درخواست به عنوان: </span><span>" + response[i].mode + "</span></p>";
                        newElement += "</div>";
                    }

                    $("#usersContainer").append(newElement);

                }
            });

        }

        function getMyRequestsStatus() {

            $(".titleDiv").css('background-color', 'transparent');
            $("#myRequestsDiv").css('background-color', 'rgba(30, 0, 53, 0.6)');

            $.ajax({
                type: 'post',
                url: getMyRequestsStatusDir,
                success: function (response) {

                    $("#usersContainer").empty();

                    if(response.length == 0)
                        return;

                    response = JSON.parse(response);
                    newElement = "";

                    for(i = 0; i < response.length; i++) {

                        newElement += "<div class='col-xs-4' onclick='showMoreInfo(\"" + response[i].destId + "\", \"" + response[i].state + "\", \"" + response[i].field + "\", \"" + response[i].bio + "\", \"" + response[i].firstName + "\", \"" + response[i].lastName + "\", \"" + response[i].photo + "\", \"myRequest\");' style='height: 100px'>";
                        newElement += "<img class='friendPhoto' width='100%' height='80%' src='" + response[i].photo + "'>";
                        newElement += "<p><span>" + response[i].firstName + "</span><span>&nbsp;</span><span>" + response[i].lastName + "</span></p>";
                        newElement += "<p><span>درخواست به عنوان: </span><span>" + response[i].mode + "</span></p>";
                        newElement += "</div>";
                    }

                    $("#usersContainer").append(newElement);

                }
            });

        }

        function showMoreInfo(uId, state, field, bio, firstName, lastName, photo, mode, showMe) {

            $("#firstName").empty().append(firstName);
            $("#lastName").empty().append(lastName);
            $("#bio").empty().append(bio);
            $("#photo").attr('src', photo);
            $("#field").empty().append(field);
            $("#state").empty().append(state);

            if(showMe != null && showMe.length != 0)
                $("#showMe").empty().append(showMe);

            selectedUId = uId;

            $(".dark").removeClass('hidden');

            newElement = "";

            if(mode == "myRequest")
                newElement += "<button onclick='cancelRequest()' style='font-size: 12px' class='btn btn-success'>لغو درخواست</button>";

            else if(mode == "requests") {
                newElement += "<button onclick='acceptRequest()' style='font-size: 12px' class='btn btn-success'>قبول درخواست</button>";
                newElement += "<button onclick='rejectRequest()' style='font-size: 12px' class='btn btn-success'>رد درخواست</button>";
            }
            else if(mode == "block") {
                newElement += "<button onclick='unBlock()' style='font-size: 12px' class='btn btn-success'>unblock</button>";
            }
            else if(mode == "accept") {
                newElement += "<button onclick='block()' style='font-size: 12px' class='btn btn-success'>block</button>";
            }

            newElement += "<button onclick='$(\".dark\").addClass(\"hidden\"); $(\"#showMoreInfo\").addClass(\"hidden\")' style='font-size: 12px' class='btn btn-danger'>بازگشت</button>";

            $("#btns").empty().append(newElement);
            $("#showMoreInfo").removeClass('hidden');
        }

        function acceptRequest() {

            $.ajax({
                type: 'post',
                url: acceptRequestDir,
                data: {
                    'uId': selectedUId
                },
                success: function (response) {

                    $(".dark").addClass('hidden');
                    $("#showMoreInfo").addClass('hidden');

                    if(response == "ok")
                        getRequests();

                }
            });
        }
        
        function rejectRequest() {
            $.ajax({
                type: 'post',
                url: rejectRequestDir,
                data: {
                    'uId': selectedUId
                },
                success: function (response) {

                    $(".dark").addClass('hidden');
                    $("#showMoreInfo").addClass('hidden');

                    if(response == "ok")
                        getRequests();

                }
            });
        }
        
        function block() {

            $.ajax({
                type: 'post',
                url: blockDir,
                data: {
                    'uId': selectedUId
                },
                success: function (response) {

                    $(".dark").addClass('hidden');
                    $('#showMoreInfo').addClass('hidden');

                    if(response == "ok")
                        getAccepted();
                }
            })
            
        }
        
        function getAccepted() {

            $(".titleDiv").css('background-color', 'transparent');
            $("#acceptsDiv").css('background-color', 'rgba(30, 0, 53, 0.6)');

            $.ajax({
                type: 'post',
                url: getAcceptedDir,
                success: function (response) {

                    $("#usersContainer").empty();

                    if(response.length == 0)
                        return;

                    response = JSON.parse(response);
                    newElement = "";

                    for(i = 0; i < response.length; i++) {

                        newElement += "<div class='col-xs-3' onclick='showMoreInfo(\"" + response[i].targetId + "\", \"" + response[i].state + "\", \"" + response[i].field + "\", \"" + response[i].bio + "\", \"" + response[i].firstName + "\", \"" + response[i].lastName + "\", \"" + response[i].photo + "\", \"accept\", \"" + response[i].showMe + "\");' style='height: 100px'>";
                        newElement += "<img class='friendPhoto' width='100%' height='100%' src='" + response[i].photo + "'>";
                        newElement += "<p><span>" + response[i].firstName + "</span><span>&nbsp;</span><span>" + response[i].lastName + "</span></p>";
                        newElement += "<p><span> به عنوان: </span><span>" + response[i].mode + "</span></p>";
                        newElement += "</div>";
                    }

                    $("#usersContainer").append(newElement);

                }
            });
        }

        function getAcceptedWithMode(mode) {

            $(".titleDiv").css('background-color', 'transparent');
            $("#acceptsDiv").css('background-color', 'rgba(30, 0, 53, 0.6)');

            $.ajax({
                type: 'post',
                url: getAcceptedDir,
                data: {
                    'mode': mode
                },
                success: function (response) {

                    $("#usersContainer").empty();

                    if(response.length == 0)
                        return;

                    response = JSON.parse(response);
                    newElement = "";

                    for(i = 0; i < response.length; i++) {

                        newElement += "<div class='col-xs-3' onclick='showMoreInfo(\"" + response[i].targetId + "\", \"" + response[i].state + "\", \"" + response[i].field + "\", \"" + response[i].bio + "\", \"" + response[i].firstName + "\", \"" + response[i].lastName + "\", \"" + response[i].photo + "\", \"accept\", \"" + response[i].showMe + "\");' style='height: 100px'>";
                        newElement += "<img class='friendPhoto' width='100%' height='100%' src='" + response[i].photo + "'>";
                        newElement += "<p><span>" + response[i].firstName + "</span><span>&nbsp;</span><span>" + response[i].lastName + "</span></p>";
                        newElement += "</div>";
                    }

                    $("#usersContainer").append(newElement);

                }
            });
        }

        function unBlock() {
            $.ajax({
                type: 'post',
                url: unBlockDir,
                data: {
                    'destId': selectedUId
                },
                success: function (response) {

                    $(".dark").addClass('hidden');
                    $("#showMoreInfo").addClass('hidden');

                    if(response == "ok")
                        getBlocks();

                }
            })
        }
        
        function getBlocks() {

            $(".titleDiv").css('background-color', 'transparent');
            $("#blocksDiv").css('background-color', 'rgba(30, 0, 53, 0.6)');

            $.ajax({
                type: 'post',
                url: getBlocksDir,
                success: function (response) {

                    $("#usersContainer").empty();

                    if(response.length == 0)
                        return;

                    response = JSON.parse(response);
                    newElement = "";

                    for(i = 0; i < response.length; i++) {

                        newElement += "<div class='col-xs-3' onclick='showMoreInfo(\"" + response[i].destId + "\", \"" + response[i].state + "\", \"" + response[i].field + "\", \"" + response[i].bio + "\", \"" + response[i].firstName + "\", \"" + response[i].lastName + "\", \"" + response[i].photo + "\", \"block\");' style='height: 100px'>";
                        newElement += "<img class='friendPhoto' width='100%' height='100%' src='" + response[i].photo + "'>";
                        newElement += "<p><span>" + response[i].firstName + "</span><span>&nbsp;</span><span>" + response[i].lastName + "</span></p>";
                        newElement += "</div>";
                    }

                    $("#usersContainer").append(newElement);

                }
            });
        }

        function cancelRequest() {

            $.ajax({
                type: 'post',
                url: cancelRequestDir,
                data: {
                    'destId': selectedUId
                },
                success: function (response) {
                    if(response == "ok") {
                        $(".dark").addClass('hidden');
                        $("#showMoreInfo").addClass('hidden');
                        getMyRequestsStatus();
                    }
                }
            })
        }
        
    </script>
@stop

@section('main')

    <div class="top_part navbar-fixed-top">
        <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
        <img onclick="document.location.href = '{{route('profile')}}'" src="{{URL::asset('images/left.png')}}" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">
    </div>

    <div class="col-xs-12 utilityBar" style="margin-top: 100px !important;">
        <div class="col-xs-3 titleDiv" style="color: white; padding: 12px !important;" id="requestsDiv" onclick="getRequests()">
            درخواست داده ها
        </div>
        <div class="col-xs-3 titleDiv" id="myRequestsDiv" onclick="getMyRequestsStatusWithMode(1)">
    در خواست دادم ها
        </div>
        <div class="col-xs-3 titleDiv" id="acceptsDiv" onclick="getAccepted()">
            قبول شده ها
        </div>
        <div class="col-xs-3 titleDiv" id="blocksDiv" onclick="getBlocks()">
بلاک شده ها
        </div>
    </div>

    <div class="col-xs-12" style="margin-top: 5%" id="usersContainer">
    </div>


    <span id="showMoreInfo" style="z-index: 10000000001!important; color: white" class="hidden myPopUp bigMyPopUp">
        <div>
            اطلاعات بیشتر
        </div>

        <div class="col-xs-12">
            <div class="col-xs-4">
                <img width="100%" id="photo">
            </div>
            <div class="col-xs-8">
                <p><span id="firstName"></span><span>&nbsp;</span><span id="lastName"></span></p>
                <p id="field"></p>
                <p id="state"></p>
                <p id="showMe"></p>
            </div>
        </div>

        <p id="bio"></p>

        <div style="margin-top: 50px" id="btns"></div>
    </span>
@stop