@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <script src="{{URL::asset('js/jsNeededForConfig.js')}}"></script>
    <script>
        var friendAvailibilityDir = '{{route('setFriendAvailibility')}}';
        var quizStatusDir = '{{route('setQuizStatus')}}';
        var changeExchangeRateDir = '{{route('changeExchangeRate')}}';
        var homeDir = '{{route('profile')}}';
    </script>
@stop

@section('main')

    <div class="col-xs-12 persoulio-title">
        <h3>پرسولیو</h3>
    </div>

    @include('layout.menuBar')

    @include('layout.bigMenuBar')

    <div class="col-xs-12" style="margin-top: 100px">
        <div class="col-xs-8 col-md-6">
            <span style="float: left">نمایش دوست یابی</span>
        </div>
        <div class="col-xs-4 col-md-6" style="margin-top: -7px">
            <label class="switch" style="float: right">
                @if($config->friendAvailibility == 1)
                    <input id="friendAvailibility" type="checkbox" checked onchange="changeFriendAvailibility()">
                @else
                    <input id="friendAvailibility" type="checkbox" onchange="changeFriendAvailibility()">
                @endif
                <span class="slider round"></span>
            </label>
        </div>
    </div>

    <div class="col-xs-12" style="margin-top: 10px">
        <div class="col-xs-8 col-md-6">
            <span style="float: left">نرخ تبدیل امتیاز به پول</span>
        </div>
        <div class="col-xs-4 col-md-6" style="margin-top: -7px">
            <input id="exchangeRate" type="text" style="float: right" value="{{$config->exchangeRate}}">
        </div>
    </div>

    <div class="col-xs-12" style="margin-top: 10px">
        <input type="submit" value="تایید" class="btn btn-success" onclick="changeExchangeRate($('#exchangeRate').val())">
    </div>



    {{--<div class="col-xs-12" style="margin-top: 20px">--}}
        {{--<div class="col-xs-4 col-md-6" style="margin-top: -7px">--}}
            {{--<label class="switch" style="float: right">--}}
                {{--@if($quizStatus == 1)--}}
                    {{--<input id="quizStatus" type="checkbox" checked onchange="changeQuizStatus()">--}}
                {{--@else--}}
                    {{--<input id="quizStatus" type="checkbox" onchange="changeQuizStatus()">--}}
                {{--@endif--}}
                {{--<span class="slider round"></span>--}}
            {{--</label>--}}
        {{--</div>--}}
        {{--<div class="col-xs-8 col-md-6">--}}
            {{--<span style="color: white; float: left">اتمام ارزیابی</span>--}}
        {{--</div>--}}
    {{--</div>--}}
@stop