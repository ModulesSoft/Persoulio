@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">
    {{--<script src="ckeditor/ckeditor.js"></script>--}}
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

    <form method="post" action="{{route('editTipContent', ['id' => $id])}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="border">
            <input style="color: white !important; font-size: 10px !important;" value="{{$title}}" type="text" maxlength="1000" name="title" class="myInput">
            <input style="text-align: center !important; text-align-last: center !important; color: white !important; font-size: 10px !important;" type="file" name="photo" class="myInput">
            <textarea id="ckeditor" name="text" >{{$text}}</textarea>
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
    </center>
        <center style="margin-top: 50px">
            <input type="submit" class="btn btn-success" style="font-size: 12px" value="ویرایش">
            <span class="btn btn-danger" onclick="document.location.href = '{{route('manageTipContents')}}'">بازگشت</span>
        </center>
    </form>

    <p style="color: white" id="err"></p>
</span>

{{--<script>--}}
    {{--CKEDITOR.replace('ckedit');--}}
    {{--CKEDITOR.inline();--}}
{{--</script>--}}