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

        <center class="totalPane">

            <div class="col-xs-12" style="margin-top: 100px">
                @if(isset($err) && !empty($err))
                    <p style="color: black">{{$err}}</p>
                @else
                    @if(count($items) == 0)
                        <p style="color: black">محتوایی در این قسمت وجود ندارد</p>
                    @else
                        <table>
                            @foreach($items as $item)
                                <tr id="tr_{{$item->id}}">
                                    <td><center>{{$item->name}}</center></td>
                                    <td>
                                        <center>
                                            <button onclick="deleteItem('{{$item->id}}')" class="btn btn-danger" data-toggle="tooltip" title="حذف">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                            <button onclick="editItem('{{$item->id}}', '{{$item->name}}')" class="btn btn-primary" data-toggle="tooltip" title="ویرایش">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </button>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    <form method="post" action="{{$addItemUrl}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="col-xs-12">
                            <label for="factorName">فایل اکسل جدید</label>
                            <input id="factorName" name="group" type="file">
                        </div>
                        <div class="col-xs-12">
                            <input type="submit" value="افزودن فایل اکسل" class="btn btn-success">
                        </div>
                    </form>
                @endif
            </div>


        </center>
    </div>


    @if(!isset($err))

        <span id="editPane" class="hidden myPopUp" style="z-index: 1000001 !important; top: 15% !important; max-height: 80% !important;">
            <div style="color: white">
                ویرایش آیتم
            </div>

            <div class="col-xs-12">
                <label style="color: white" for="factorNameE">نام جدید آیتم</label>
                <input id="factorNameE" type="text">
            </div>

            <center class="col-xs-12" style="margin-top: 50px">
                <input type="submit" onclick="doEditItem()" class="btn btn-success" style="font-size: 12px" value="ثبت">
                <span class="btn btn-danger" onclick="$('#editPane').addClass('hidden'); $('.dark').addClass('hidden')">بازگشت</span>
            </center>
        </span>

        <script>
            function deleteItem(id) {
                $.ajax({
                    type: 'post',
                    url: '{{$removeUrl}}',
                    data: {
                        'itemId': id
                    },
                    success: function (response) {
                        if(response == "ok")
                            $("#tr_" + id).addClass('hidden');
                    }
                });
            }

            var selectedId = -1;

            function editItem(id, name) {
                selectedId = id;
                $("#factorNameE").val(name);
                $('.dark').removeClass('hidden');
                $("#editPane").removeClass('hidden');
            }

            function doEditItem() {

                var factorName = $("#factorNameE").val();

                if(selectedId == -1 || factorName.length == 0) {
                    alert("لطفا نامی برای آیتم مورد نظر خود انتخاب نمایید");
                    return;
                }

                $.ajax({
                    type: 'post',
                    url: '{{$editUrl}}',
                    data: {
                        'itemId': selectedId,
                        'name': factorName
                    },
                    success: function (response) {
                        if(response == "ok")
                            document.location.href = '{{$selfUrl}}';
                    }
                });
            }
        </script>
    @endif
@stop