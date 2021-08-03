@extends('layout.myStructure')

@section('header')
    @parent

    <style>
        td{
            padding: 5px;
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

            <div class="row" style="margin-top: 100px">

                @if(isset($err) && !empty($err))
                    <div class="col-xs-12">
                        <p style="color: black">{!! html_entity_decode($err) !!}</p>
                    </div>
                @else
                    @if(count($sentences) == 0)
                        <div class="col-xs-12">
                            <p style="color: black">محتوایی در این بخش وجود ندارد</p>
                        </div>
                    @else
                        <div class="col-xs-12">
                            <form method="post" action="{{route('deleteNotifSentence')}}">
                                {{csrf_field()}}
                                <table>
                                    @foreach($sentences as $sentence)
                                        <tr>
                                            <td><center>تیپ  {{$sentence->tipId}}</center></td>
                                            <td><center>{{$sentence->date}}</center></td>
                                            <td><center>{{$sentence->sentence}}</center></td>
                                            <td>
                                                <center>
                                                    <button name="sentenceId" value="{{$sentence->id}}" class="btn btn-danger" data-toggle="tooltop" title="حذف">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </button>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </form>
                        </div>
                    @endif
                @endif


                <div class="col-xs-12">
                    <form method="post" action="{{route('doUploadNotifSentences')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="col-xs-12">
                            <input type="file" name="sentences">
                        </div>

                        <div class="col-xs-12">
                            <input class="btn btn-success" type="submit" value="آپلود فایل جدید">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop