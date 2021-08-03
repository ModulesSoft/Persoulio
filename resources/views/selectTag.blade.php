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
        </div>
    </div>

    <script>

        var selectedId;

        $(document).ready(function(){
            getTags();
        });

        function getTags() {
            $.ajax({
                type: 'post',
                url: '{{route('getTags')}}',
                success: function (response) {
                    if(response.length > 0) {

                        response = JSON.parse(response);
                        newElement = "";

                        for(i = 0; i < response.length; i++) {
                            newElement += "<div class='col-xs-12'><a href='" + "{{route('root')}}" + "/events/" + response[i].id  + "' style='min-width: 200px' class='btn btn-primary'><span>" + response[i].name;
                            newElement += "</span>";
                            if(response[i].general)
                                newElement += "<span> عمومی </span>";
                            else
                                newElement += "<span> غیر عمومی </span>";

                            newElement += "<span> در " + response[i].mode + " </span>";

                            newElement += "</a></div>";
                        }

                        $("#tags").empty().append(newElement);
                    }
                }
            });
        }

    </script>

@stop