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

            <div class="col-xs-12">
                <a href="{{route('addTip')}}" class="btn btn-success">افزودن تیپ جدید</a>
            </div>

            @foreach($tips as $itr)
                <div class="col-xs-12">
                    <a style="min-width: 100px" class="btn btn-primary" href="{{route('showTipDetail', ['tipId' => $itr->id])}}">{{$itr->name}}</a>
                </div>
            @endforeach
        </div>
    </div>

@stop