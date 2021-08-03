@extends('layout.myStructure')

@section('header')
    @parent

    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">

    <style>
        .myInput2 {
            background-color: transparent !important;
        }

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
            @if(count($contents) == 0)
                <p>محتوایی در این بخش وجود ندارد</p>
            @endif
            @foreach($contents as $content)
                <div class="content" onclick="document.location.href = '{{route('certificates', ['eventId' => $content->id])}}'" style="cursor: pointer">
                    <h3 style="color: white; width: 100%">{{$content->name}}</h3>
                    <p style="color: white">{!! html_entity_decode($content->description) !!}</p>
                    <p><span>مکان</span><span>&nbsp;</span><span>{{$content->place}}</span></p>
                    <p><span>استاد</span><span>&nbsp;</span><span>{{$content->launcher}}</span></p>
                    <p><span>طول دوره</span><span>&nbsp;</span><span>{{$content->duration}}</span><span>&nbsp;</span><span>دقیقه</span></p>
                    <p><span>سطح سختی</span><span>&nbsp;</span><span>{{$content->levelName}}</span></p>
                </div>
            @endforeach
        </div>

    </div>
@stop

