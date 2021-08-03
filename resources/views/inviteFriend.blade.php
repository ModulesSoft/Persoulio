@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/filter.css')}}">
@stop

@section('main')

    <div class="top_part navbar-fixed-top">
        <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
        <img onclick="document.location.href = '{{route('profile')}}'" src="{{URL::asset('images/left.png')}}" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">
    </div>

    @if(isset($err) && $err != "")
        <div class="col-xs-12 error">
            <p>{{$err}}</p>
        </div>
    @else


        @include('layout.filter')

        <div class="col-xs-12" id="selectedFilters"></div>

        <div id="users"></div>
    @endif

    <span id="showMoreInfo" style="color: white; z-index: 10000000001!important;" class="hidden myPopUp bigMyPopUp">
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
            </div>
        </div>

        <p id="bio"></p>

        <div style="margin-top: 50px">
            <button onclick="follow('{{getValueInfo('rafigh')}}')" style="font-size: 12px" class="btn btn-default">رفیق</button>
            <button onclick="follow('{{getValueInfo('dost')}}')" style="font-size: 12px" class="btn btn-primary">دوست</button>
            <button onclick="follow('{{getValueInfo('ashna')}}')" style="font-size: 12px" class="btn btn-success">آشنا</button>
            <button onclick="reject()" style="font-size: 12px" class="btn btn-warning">رد</button>
            <button onclick="$('.dark').addClass('hidden'); $('#showMoreInfo').addClass('hidden')" style="font-size: 12px" class="btn btn-danger">بازگشت</button>
        </div>
    </span>
@stop