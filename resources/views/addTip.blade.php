@extends('layout.myStructure')

@section('header')
    @parent

    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">

    <script>
        var deleteUrl = '{{route('deleteEvent')}}';
        var selfUrl = '{{route('manageEvents')}}';
    </script>

@stop

@section('main')

    <div class="top_part navbar-fixed-top">
        <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
        <img onclick="document.location.href = '{{route('tips')}}'" src="{{URL::asset('images/left.png')}}" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">
    </div>

    <div class="container-fluid" style="margin-top: 100px">
        <div class="totalPane">
            <form method="post" action="{{$url}}">

                {{csrf_field()}}

                @if(!isset($consts))
                    <div class="col-xs-12">
                        <label for="name">شماره تیپ</label>
                        <input type="number" min="1" name="name" id="name">
                    </div>
                @else
                    <input type="text" value="{{$tipId}}" name="tipId" class="hidden">
                @endif

                <?php $i = 0; ?>

                @foreach($factors as $itr)
                    <div class="col-xs-12">
                        <span>عامل {{$itr->name}}</span>
                        <label for="min_{{$itr->id}}">کف نمره</label>
                        <input name="min_{{$itr->id}}" id="min_{{$itr->id}}" type="number" min="0" max="100" value="{{(isset($consts[$i]) ? $consts[$i]->floor : '')}}">
                        <label for="max_{{$itr->id}}">سقف نمره</label>
                        <input name="max_{{$itr->id}}" id="max_{{$itr->id}}" type="number" min="0" max="100" value="{{(isset($consts[$i]) ? $consts[$i++]->ceil : '')}}">
                    </div>
                @endforeach
    
                <div class="col-xs-12">
                    <input type="submit" value="تایید" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@stop