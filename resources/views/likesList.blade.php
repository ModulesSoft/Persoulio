@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/likes.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">

    <!-- drawer.css -->


    <script>

        function changeLike(likeId) {
            
            $.ajax({
                type: 'post',
                url: '{{route('changeLike')}}',
                data: {
                    'likeId': likeId
                }
            });
        }
    </script>
    <style>

    </style>
@stop

@section('main')

    <div class="container-fluid">
        <div class="top_part">
            <p style="cursor: pointer;" onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
            <img onclick="document.location.href = '{{route('profile')}}'" src="images/left.png" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">

            {{--<img class="menu_icon" src="images/menuIcon.png" id="menu-toggle" width="50px">--}}
        </div>
        <div class="col-md-12 col-xs-12">
            <h3>لطفا علاقه‌مندی‌هاتون رو اعلام‌کنین.</h3>
        </div>
        <div class="row" style="padding: 10px">
            @foreach($likes as $like)
                    @if($like->selected)
                    <div class="col-md-4 col-xs-6">

                        <div class="like_tiles active" id ="{{$like->id}}" onclick="add_active_class(this.id)">
                                <h2>{{$like->name}}</h2>
                            </div>
                    </div>
                    @else
                    <div class="col-md-4 col-xs-6">
                        <div class="like_tiles " id ="{{$like->id}}" onclick="add_active_class(this.id)">
                                <h2>{{$like->name}}</h2>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                <button class="next_but" onclick="document.location.href = '{{route('profile')}}'">ادامه</button>
            </div>
        </div>
    </div>



    <!-- Bootstrap core JavaScript -->
    <script src="{{URL::asset('js/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.js')}}"></script>

    <!-- Menu Toggle Script -->
    <script>
        function add_active_class(id) {
            $("#"+ id).toggleClass("active");
            changeLike(id);
        }

    </script>




































    {{--<div class="col-xs-12 persoulio-title">--}}
        {{--<h3>پرسولیو</h3>--}}
    {{--</div>--}}

    {{--@if(Quiz::find(1)->status == 1)--}}
        {{--@include('layout.menuBar')--}}

        {{--@include('layout.bigMenuBar')--}}
    {{--@endif--}}

    {{--<div class="totalPane col-xs-12">--}}
        {{--@if(count($likes) == 0)--}}
            {{--<p>محتوایی در این بخش وجود ندارد</p>--}}
        {{--@endif--}}

        {{--<div class="col-xs-12">--}}
            {{--@foreach($likes as $like)--}}
                {{--<div class="col-xs-12">--}}
                    {{--<div class="col-md-4"></div>--}}
                    {{--<div class="col-md-4">--}}
                        {{--<span style="text-align: start; padding: 20px; color: white; width: 100%">{{$like->name}}</span>--}}
                        {{--@if($like->selected)--}}
                            {{--<input type="checkbox" checked onchange="changeLike('{{$like->id}}')">--}}
                        {{--@else--}}
                            {{--<input type="checkbox" onchange="changeLike('{{$like->id}}')">--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4"></div>--}}
                {{--</div>--}}
            {{--@endforeach--}}
            {{--<div class="col-xs-12">--}}
                {{--<button class="myBtn" onclick="document.location.href = '{{route('profile')}}'">ادامه</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@stop