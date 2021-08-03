@extends('layout.myStructure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{URL::asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/contentManager.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">

    
    <script>

        var selectedId;

        $(document).ready(function () {
            @if(!empty($err))
                $("#err").empty().append('{{$err}}');
                $("#addContent").removeClass('hidden');
            @endif
        });
        

        function editLike(id, oldName) {

            selectedId = id;

            $("#newName").val(oldName);
            $("#editLike").removeClass('hidden');

        }

        function deleteLike(id) {
            
            $.ajax({
                type: 'post',
                url: '{{route('deleteLike')}}',
                data: {
                    'id': id
                },
                success: function (response) {
                    if(response == "ok")
                        document.location.href = '{{route('manageLikes')}}';
                }
            });
        }

        function doEdit() {

            $.ajax({
                type: 'post',
                url: '{{route('editLike')}}',
                data: {
                    'id': selectedId,
                    'name': $("#newName").val()
                },
                success: function (response) {
                    if(response == "ok")
                        document.location.href = '{{route('manageLikes')}}';
                }
            });
        }
    </script>
@stop

@section('main')

    <div class="col-xs-12 persoulio-title">
        <h3>پرسولیو</h3>
    </div>

    @include('layout.menuBar')

    @include('layout.bigMenuBar')

    <div class="totalPane">
        @if(count($likes) == 0)
            <p>محتوایی در این بخش وجود ندارد</p>
        @endif

        <div class="content">
            @foreach($likes as $like)
                <div style="margin-top: 10px">
                    <span style="color: white; width: 100%">{{$like->name}}</span>
                    <button class="btn btn-danger" onclick="deleteLike('{{$like->id}}')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <button class="btn btn-success" onclick="editLike('{{$like->id}}', '{{$like->name}}')">
                        <span class="glyphicon glyphicon-edit"></span>
                    </button>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 20px">
            <button onclick="$('#addContent').removeClass('hidden')" class="myBtn">افزودن محتوای جدید</button>
        </div>
    </div>

@stop


<span id="addContent" class="hidden myPopUp">
    <div style="color: white">
        افزودن محتوای جدید
    </div>
    <form method="post" action="{{route('addLike')}}">
        {{csrf_field()}}
        <div class="border">
            <input style="color: white !important; font-size: 10px !important;" placeholder="نام محتوا" type="text" maxlength="100" name="likeName" class="myInput">
        </div>

        <center style="margin-top: 50px">
            <input type="submit" class="btn btn-success" style="font-size: 12px" value="ارسال" name="addContent">
            <span class="btn btn-danger" onclick="$('#addContent').addClass('hidden')">بازگشت</span>
        </center>
    </form>
    <p style="color: white" id="err"></p>
</span>

<span id="editLike" class="hidden myPopUp">
    <div style="color: white">
ویرایش محتوا
    </div>

    <div class="border">
        <input style="color: white !important; font-size: 10px !important;" placeholder="نام جدید محتوا" type="text" maxlength="100" id="newName" class="myInput">
    </div>

    <center style="margin-top: 50px">
        <input type="submit" class="btn btn-success" style="font-size: 12px" value="ارسال" onclick="doEdit()">
        <span class="btn btn-danger" onclick="$('#editLike').addClass('hidden')">بازگشت</span>
    </center>
    <p style="color: white" id="err"></p>
</span>