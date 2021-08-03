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
        .totalPane p {
            color: black !important;
        }
        td {
            padding: 7px;
        }
    </style>

@stop

@section('main')

    <div class="top_part navbar-fixed-top">
        <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
        <img onclick="document.location.href = '{{route('tips')}}'" src="{{URL::asset('images/left.png')}}" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">
    </div>


    <div class="container-fluid" style="margin-top: 100px">
        <div class="totalPane">
            <div class="col-xs-12">
                <table>
                    @foreach($details as $itr)
                        <tr>
                            <td>عامل {{$itr->factorId}}</td>
                            <td>کف نمره {{$itr->floor}}</td>
                            <td>سقف نمره {{$itr->ceil}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="col-xs-12">
                <button onclick="deleteTip()" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                <a href="{{route('editTip', ['tipId' => $tipId])}}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></a>
            </div>

        </div>
    </div>

    <script>

        function deleteTip() {

            $.ajax({
                type: 'post',
                url: '{{route('deleteTip')}}',
                data: {
                    'tipId': '{{$tipId}}'
                },
                success: function (response) {
                    if(response == "ok")
                        document.location.href = '{{route('tips')}}';
                }
            })

        }

    </script>

@stop