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
        <img onclick="document.location.href = '{{route('quizes')}}'" src="{{URL::asset('images/left.png')}}" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">
    </div>


    <div class="container-fluid">

        <center class="totalPane">

            <div class="col-xs-12" style="margin-top: 100px">
                <form method="post" action="{{route('deleteQOQ')}}">
                    {{csrf_field()}}
                    <table>
                        <tr>
                            <td><center>شماره سوال</center></td>
                            <td><center>صورت سوال</center></td>
                            @for($i = 1; $i <= count($qoqs[0]->choices); $i++)
                                <td><center>گزینه {{$i}}</center></td>
                                <td><center>عامل گزینه {{$i}}</center></td>
                                <td><center>امتیاز عامل گزینه {{$i}}</center></td>
                            @endfor
                            <td><center>عملیات</center></td>
                        </tr>
                        @foreach($qoqs as $qoq)
                            <tr>
                                <td><center>{{$qoq->qNo}}</center></td>
                                <td><center>{{$qoq->question}}</center></td>
                                @foreach($qoq->choices as $choice)
                                    <td><center>{{$choice->ans}}</center></td>
                                    <td><center>{{$choice->field}}</center></td>
                                    <td><center>{{$choice->mark}}</center></td>
                                @endforeach
                                <td>
                                    <center>
                                        <button class="btn btn-danger" name="qoqId" value="{{$qoq->id}}">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </form>
            </div>
        </center>
    </div>
@stop