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
                <table>
                    @foreach($factors as $factor)
                        <tr id="tr_{{$factor->id}}">
                            <td><center>{{$factor->name}}</center></td>
                            <td><center><span>آی دی: </span><span>{{$factor->id}}</span></center></td>
                            <td>
                                <center>
                                    <button onclick="deleteFactor('{{$factor->id}}')" class="btn btn-danger" data-toggle="tooltip" title="حذف">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <button onclick="editFactor('{{$factor->id}}', '{{$factor->name}}')" class="btn btn-primary" data-toggle="tooltip" title="ویرایش">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </button>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div>
                <div class="col-xs-12">
                    <label for="factorName">نام مولفه جدید</label>
                    <input id="factorName" type="text">
                </div>
                <div class="col-xs-12">
                    <button onclick="addFactor()" class="btn btn-success" data-toggle="tooltip" title="افزودن مولفه جدید">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </div>
            </div>

        </center>
    </div>

    <span id="editPane" class="hidden myPopUp" style="z-index: 1000001 !important; top: 15% !important; max-height: 80% !important;">
        <div style="color: white">
            ویرایش مولفه
        </div>

        <div class="col-xs-12">
            <label style="color: white" for="factorNameE">نام جدید مولفه</label>
            <input id="factorNameE" type="text">
        </div>

        <center class="col-xs-12" style="margin-top: 50px">
            <input type="submit" onclick="doEditFactor()" class="btn btn-success" style="font-size: 12px" value="ثبت">
            <span class="btn btn-danger" onclick="$('#editPane').addClass('hidden'); $('.dark').addClass('hidden')">بازگشت</span>
        </center>
    </span>

    <script>
        function deleteFactor(id) {
            $.ajax({
                type: 'post',
                url: '{{route('deleteFactor')}}',
                data: {
                    'factorId': id
                },
                success: function (response) {
                    if(response == "ok")
                        $("#tr_" + id).addClass('hidden');
                }
            });
        }

        var selectedId = -1;

        function editFactor(id, name) {
            selectedId = id;
            $("#factorNameE").val(name);
            $('.dark').removeClass('hidden');
            $("#editPane").removeClass('hidden');
        }

        function doEditFactor() {

            var factorName = $("#factorNameE").val();

            if(selectedId == -1 || factorName.length == 0) {
                alert("لطفا نامی برای مولفه مورد نظر خود انتخاب نمایید");
                return;
            }

            $.ajax({
                type: 'post',
                url: '{{route('editFactor')}}',
                data: {
                    'factorId': selectedId,
                    'name': factorName
                },
                success: function (response) {
                    if(response == "ok")
                        document.location.href = '{{route('factors')}}';
                }
            });
        }
        
        function addFactor() {
            
            var factorName = $("#factorName").val();
            
            if(factorName.length == 0) {
                alert("لطفا نامی برای مولفه جدید خود انتخاب نمایید");
                return;
            }
            
            $.ajax({
                type: 'post',
                url: '{{route('addFactor')}}',
                data: {
                    'name': factorName
                },
                success: function (response) {
                    if(response == "ok")
                        document.location.href = '{{route('factors')}}';
                }
            });
            
        }
    </script>
@stop