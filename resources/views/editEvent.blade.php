@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">

    <script>

        $(document).ready(function () {
            @if(!empty($err))
                $("#err").empty().append('{{$err}}');
            @endif
        });
    </script>
@stop

@section('main')

    <div class="col-xs-12 persoulio-title">
        <h3>پرسولیو</h3>
    </div>

    @include('layout.menuBar')

    @include('layout.bigMenuBar')

@stop

<span class="myPopUp" style="top: 15% !important; max-height: 60% !important;">
    <div style="color: white">
        ویرایش محتوا
    </div>

    <form method="post" action="{{route('editEvent', ['id' => $id])}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="border">
            <input style="color: white !important; font-size: 10px !important;" value="{{$title}}" type="text"
                   maxlength="1000" name="title" class="myInput">
            <input style="text-align: center !important; text-align-last: center !important; color: white !important; font-size: 10px !important;"
                   type="file" name="photo" class="myInput">
            <textarea id="ckeditor" style="color: white !important; font-size: 10px !important;z-index: 9;" maxlength="1000" name="text"
                      class="myInput">{{$text}}</textarea>

        </div>

        <center style="color: white" class="col-xs-12">
            <div class="col-xs-12">
                <div class="col-xs-12">
                    <h4>تیپ مورد نظر</h4>
                </div>
                @foreach($allTips as $tip)
                    <div class="col-xs-3">
                        <label for="tipId_{{$tip->id}}">{{$tip->name}}</label>
                        @if($tip->selected)
                            <input id="tipId_{{$tip->id}}" type="checkbox" name="tipId[]" value="{{$tip->id}}" checked>
                        @else
                            <input id="tipId_{{$tip->id}}" type="checkbox" name="tipId[]" value="{{$tip->id}}">
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="col-xs-12">
                <div class="col-xs-12">
                    <h4>علاقه مورد نظر</h4>
                </div>
                @foreach($likes as $tip)
                    <div class="col-xs-6">
                    <label for="tipId_{{$tip->id}}">{{$tip->name}}</label>
                        @if($tip->selected)
                            <input id="tipId_{{$tip->id}}" type="checkbox" name="likeId[]" value="{{$tip->id}}" checked>
                        @else
                            <input id="tipId_{{$tip->id}}" type="checkbox" name="likeId[]" value="{{$tip->id}}">
                        @endif
                </div>
                @endforeach
            </div>
            <div class="col-xs-12">
                            <div class="bg-primary">
                            <label for="day1">شنبه:</label>
                            <input id="day1" name="day1" type="text" class="myInput" style="color: black" value="{{$days['day1']}}">
                            <label for="day2">یکشنبه:</label>
                            <input id="day2" name="day2" type="text" class="myInput" style="color: black" value="{{$days['day2']}}">
                            <label for="day3">دوشنبه:</label>
                            <input id="day3" name="day3" type="text" class="myInput" style="color: black" value="{{$days['day3']}}">
                            <label for="day4">سه شنبه:</label>
                            <input id="day4" name="day4" type="text" class="myInput" style="color: black" value="{{$days['day4']}}">
                            <label for="day5">چهارشنبه:</label>
                            <input id="day5" name="day5" type="text" class="myInput" style="color: black" value="{{$days['day5']}}">
                            <label for="day6">پنجشنبه:</label>
                            <input id="day6" name="day6" type="text" class="myInput" style="color: black" value="{{$days['day6']}}">
                            <label for="day7">جمعه:</label>
                            <input id="day7" name="day7" type="text" class="myInput" style="color: black" value="{{$days['day7']}}">
                            </div>
                        </div>
    </center>

        <center style="margin-top: 50px">
            <input type="submit" class="btn btn-success" style="font-size: 12px" value="ویرایش">
            <span class="btn btn-danger" onclick="document.location.href = '{{route('manageEvents')}}'">بازگشت</span>
        </center>
    </form>

    <p style="color: white" id="err"></p>

<script>
        CKEDITOR.replace('ckeditor');
        CKEDITOR.inline();
</script>

</span>