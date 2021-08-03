@extends('layout.myStructure')

@section('header')
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/resetpass.css')}}">

    @parent
@stop

@section('main')
    <div class="container-fluid">
        <div style="cursor: pointer" class="col-xs-12 logo" onclick="document.location.href = '{{route('profile')}}'">
            <p style="font-size: 80px; color: #1e0035; font-family: ghasem">پرسولیو</p>
        </div>

        <form method="post" action="{{route('resetPas')}}" style="margin-top: 10%;">
            {{csrf_field()}}
            <div class="col-xs-12 sign-in-inputs">
                <div class="col-xs-12" style="max-height: 10%">
                    <div class="border">
                        <input name="username" class="myInput firstInput" type="text" placeholder="شماره ی دانشجویی یا نام کاربری">
                    </div>
                </div>

                <div class="col-xs-12" style="max-height: 10%">
                    <div class="border">
                        <input name="phoneNum" class="myInput" type="tel" placeholder="شماره موبایل">
                    </div>
                </div>
            </div>

            <div class="col-xs-12 btn-group">
                <div class="col-xs-12 col-md-offset-4 col-md-4">
                    @if(!empty($err))
                        @if($err == "err")
                            <p style="color: white" id="err">نام کاربری و یا شماره همراه وارد شده نامعتبر است</p>
                        @elseif($err == "success")
                            <p style="color: white" id="err">رمزعبور جدید برای شما پیامک شد.
                            (شماره جلوی % را وارد کنید)</p>
                        @endif
                    @endif
                    <input style="border-radius:20px" type="submit" class="btn but_2" value="بازیابی رمزعبور">
                </div>
            </div>

        </form>
    </div>
@stop

