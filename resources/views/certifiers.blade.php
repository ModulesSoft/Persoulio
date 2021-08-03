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
                    @if(count($users) == 0)
                        <div class="col-xs-12">
                            <p style="color: black">محتوایی در این بخش وجود ندارد</p>
                        </div>
                    @else
                        <div class="col-xs-12">
                            <form method="post" action="{{route('toggleUserStatus')}}">
                                {{csrf_field()}}
                                <table>
                                    @foreach($users as $user)
                                        <tr>
                                            <td><center>{{$user->firstName . " " . $user->lastName}}</center></td>
                                            @if(isset($user->pic))
                                                <td><center><img width="50px" src="{{$user->pic}}"></center></td>
                                            @endif
                                            <td><center><span onclick="uploadPic('{{$user->id}}')" class="btn btn-warning">آپلود عکس</span></center></td>
                                            <td>
                                                <center>
                                                    @if($user->status)
                                                        <button name="uId" value="{{$user->id}}" class="btn btn-danger">غیر فعال کردن کاربر</button>
                                                    @else
                                                        <button name="uId" value="{{$user->id}}" class="btn btn-success">غیر فعال کردن کاربر</button>
                                                    @endif
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
                    <form method="post" action="{{$url}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="col-xs-12">
                            <input type="file" name="group">
                        </div>

                        <div class="col-xs-12">
                            <input class="btn btn-success" type="submit" value="آپلود فایل جدید">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <span id="uploadPane" class="hidden myPopUp" style="z-index: 1000001 !important; top: 15% !important; max-height: 80% !important;">
            <div style="color: white">
                آپلود عکس
            </div>

        
            <form method="post" action="{{route('setAdviserPic')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input name="uId" type="hidden" id="uId">
    
                <div class="col-xs-12">
                    <input name="pic" type="file" accept="image/jpeg">
                </div>
    
                <center class="col-xs-12" style="margin-top: 50px">
                    <input type="submit" class="btn btn-success" style="font-size: 12px" value="ثبت">
                    <span class="btn btn-danger" onclick="$('#uploadPane').addClass('hidden'); $('.dark').addClass('hidden')">بازگشت</span>
                </center>
            </form>
        </span>

    <script>
        function uploadPic(uId) {
            $("#uId").val(uId);
            $("#uploadPane").removeClass('hidden');
            $(".dark").removeClass('hidden');
        }
    </script>
@stop