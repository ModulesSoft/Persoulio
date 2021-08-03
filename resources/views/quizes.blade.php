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
                    <table>
                        @foreach($quizes as $quiz)
                            <tr id="tr_{{$quiz->id}}">
                                <td style="cursor: pointer" onclick="document.location.href = '{{route('quizOverView', ['quizId' => $quiz->id])}}';"><center>{{$quiz->name}}</center></td>
                                <td><center><span>تعداد سوالات</span><span>&nbsp;</span><span>{{$quiz->qNo}}</span></center></td>
                                <td><center><span>قیمت</span><span>&nbsp;</span><span>{{$quiz->price}}</span></center></td>

                                <td>
                                    <center>
                                        <button onclick="deleteQuiz('{{$quiz->id}}')" class="btn btn-danger" data-toggle="tooltip" title="حذف">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        <button onclick="editQuiz('{{$quiz->id}}', '{{$quiz->name}}', '{{$quiz->price}}')" class="btn btn-primary" data-toggle="tooltip" title="ویرایش">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </button>
                                        <button onclick="addExcel('{{route('addQuizExcel', [$quiz->id])}}')" class="btn btn-warning" data-toggle="tooltip" title="افزودن اکسل سوالات">
                                            <span class="glyphicon glyphicon-save"></span>
                                        </button>
                                    </center>
                                </td>

                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>


            <div>
                <div class="col-xs-12">
                    <label for="quizName">نام آزمون جدید</label>
                    <input id="quizName" type="text">
                </div>

                <div class="col-xs-12">
                    <label for="price">قیمت آزمون</label>
                    <input id="price" name="price" type="number">
                </div>

                <div class="col-xs-12">
                    <button onclick="addQuiz()" class="btn btn-success">افزودن آزمون</button>
                </div>
            </div>

        </center>
    </div>


    <span id="excelPane" class="hidden myPopUp" style="z-index: 1000001 !important; top: 15% !important; max-height: 80% !important;">
        <div style="color: white">
            افزودن اکسل سوالات
        </div>

        <form id="excelFile" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <center class="col-xs-12" style="margin-top: 50px">

                <label style="color: white" for="excel">اکسل سوالات</label>
                <input id="excel" name="questions" type="file">

                <input type="submit" class="btn btn-success" style="font-size: 12px" value="ثبت">
                <span class="btn btn-danger" onclick="$('#excelPane').addClass('hidden'); $('.dark').addClass('hidden')">بازگشت</span>
            </center>
        </form>
    </span>


    <span id="editPane" class="hidden myPopUp" style="z-index: 1000001 !important; top: 15% !important; max-height: 80% !important;">
        <div style="color: white">
ویرایش آزمون
        </div>

        <center class="col-xs-12" style="margin-top: 50px">

            <div class="col-xs-12">
                <label style="color: white" for="quizNameE">نام جدید آزمون</label>
                <input id="quizNameE" name="questions" type="text">
            </div>

            <div class="col-xs-12">
                <label style="color: white" for="priceE">قیمت جدید آزمون</label>
                <input id="priceE" name="price" type="number">
            </div>

            <input type="submit" onclick="doEditQuiz()" class="btn btn-success" style="font-size: 12px" value="ثبت">
            <span class="btn btn-danger" onclick="$('#editPane').addClass('hidden'); $('.dark').addClass('hidden')">بازگشت</span>
        </center>
    </span>

    <script>

        function addExcel(url) {
            $("#excelFile").attr('action', url);
            $("#excelPane").removeClass('hidden');
            $(".dark").removeClass('hidden');
        }

        function deleteQuiz(id) {
            $.ajax({
                type: 'post',
                url: '{{route('deleteQuiz')}}',
                data: {
                    'quizId': id
                },
                success: function (response) {
                    if(response == "ok")
                        $("#tr_" + id).addClass('hidden');
                }
            });
        }

        function addQuiz() {

            var quizName = $("#quizName").val();

            if(quizName.length == 0) {
                alert("لطفا نامی برای آزمون جدید خود انتخاب نمایید");
                return;
            }

            var price = $("#price").val();
            if(price.length == 0)
                price = 0;

            $.ajax({
                type: 'post',
                url: '{{route('addQuiz')}}',
                data: {
                    'name': quizName,
                    'price': price
                },
                success: function (response) {
                    if(response == "ok")
                        document.location.href = '{{route('quizes')}}';
                }
            });

        }

        var selectedQId = -1;

        function doEditQuiz() {

            var quizName = $("#quizNameE").val();
            var price = $("#priceE").val();

            if(quizName.length == 0 || selectedQId == -1) {
                alert("لطفا نامی برای آزمون خود انتخاب نمایید");
                return;
            }

            if(price.length == 0)
                price = 0;

            $.ajax({
                type: 'post',
                url: '{{route('editQuiz')}}',
                data: {
                    'name': quizName,
                    'qId': selectedQId,
                    'price': price
                },
                success: function (response) {
                    if(response == "ok")
                        document.location.href = '{{route('quizes')}}';
                }
            });
        }

        function editQuiz(qId, name, price) {
            selectedQId = qId;
            $("#quizNameE").val(name);
            $("#priceE").val(price);
            $("#editPane").removeClass('hidden');
            $(".dark").removeClass('hidden');
        }

    </script>

@stop