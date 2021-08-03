@extends('layout.myStructure')

@section('header')
    @parent

    <style>
        td {
            padding: 10px;
        }
    </style>

    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">
@stop


@section('main')

    <div class="top_part navbar-fixed-top">
        <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
        <img onclick="document.location.href = '{{route('profile')}}'" src="{{URL::asset('images/left.png')}}" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">
    </div>


    <div class="container-fluid">

        <div class="totalPane">
            <center style="margin-top: 100px">
                <table style="padding: 10px">
                    <tr>
                        <td><center>نام</center></td>
                        <td><center>نام کاربری</center></td>
                        <td><center>عملیات</center></td>
                    </tr>

                    @foreach($students as $itr)
                        <tr>
                            <td><center>{{$itr->user->firstName . ' ' . $itr->user->lastName}}</center></td>
                            <td><center>{{$itr->user->username}}</center></td>
                            <td>
                                <center>
                                    <button onclick="accept('{{$itr->user->id}}')" data-toggle="tooltip" title="تایید" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
                                    <button onclick="reject('{{$itr->user->id}}')" data-toggle="tooltip" title="رد" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </center>
        </div>
    </div>

    <script>

        function accept(uId) {

            $.ajax({
                type: 'post',
                url: '{{route('acceptStudent')}}',
                data: {
                    'uId': uId
                },
                success: function (response) {
                    if(response == "ok") {
                        document.location.href = '{{route('adviserQueue')}}'
                    }
                }
            });

        }

        function reject(uId) {

            $.ajax({
                type: 'post',
                url: '{{route('rejectStudent')}}',
                data: {
                    'uId': uId
                },
                success: function (response) {
                    if(response == "ok") {
                        document.location.href = '{{route('adviserQueue')}}'
                    }
                }
            });
        }

    </script>
@stop