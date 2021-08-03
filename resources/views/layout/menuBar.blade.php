
<?php
use App\models\Bio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if(Auth::check()) {

    $user = Auth::user();
    $bio = Bio::whereUId($user->id)->first();

    if ($bio == null)
        $bio = "";
    else
        $bio = $bio->description;

    $tips = DB::select('select tip.name from tip, userTip WHERE tip.id = tipId and uId = ' . $user->id);

}
?>

<div class="mobile-menu" id="menuIcon">
    @if(Auth::user()->level == getValueInfo('adminLevel'))
    <img width="100%" height="100%" src="{{URL::asset('images/menuIcon.png')}}">
        @endif
</div>
<div class="top_part navbar-fixed-top">
    <p onclick="document.location.href = '{{route('profile')}}'">پرسولیو</p>
    {{--<img onclick="document.location.href = '{{route('profile')}}'" src="images/left.png" height="30px" style="position:absolute;left: 10px;top: 15px;cursor: pointer;">--}}

    {{--<img class="menu_icon" src="images/menuIcon.png" id="menu-toggle" width="50px">--}}
</div>
<div class="mobile-nav hidden">

    <div class="row" style="margin-top: 10%">
        @if(Auth::check())
            <div class="col-xs-12" style="height: 100px">
                <div onclick="document.location.href = '{{route('profile')}}'" class="col-xs-6">
                    <img width="100%" height="100%" src="{{$user->photo}}">
                </div>
                <div class="col-xs-6" style="overflow: auto">
                    <p>{{$user->firstName}}</p>
                    <p>{{$user->lastName}}</p>
                    @foreach($tips as $tip)
                        <p>{{$tip->name}}</p>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12" style="max-height: 100px; overflow: auto;">
                <p>{{$bio}}</p>
            </div>
            <div class="col-xs-12">
                @if(Auth::user()->level == getValueInfo('adminLevel'))
                    <button class="myBtn" onclick="document.location.href = '{{route('manageFriendAvailability')}}'" style="margin-top: 20px">پیکربندی</button>
                    <button class="myBtn" onclick="document.location.href = '{{route('manageEvents')}}'" style="margin-top: 20px">رویدادها</button>
                    <button class="myBtn" onclick="document.location.href = '{{route('manageLikes')}}'" style="margin-top: 20px">مدیریت لیست علاقه مندی ها</button>

                @endif
                @if(\App\models\ConfigModel::first()->friendAvailibility)
                    <button class="myBtn" onclick="document.location.href = '{{route('inviteFriend')}}'" style="margin-top: 20px">معرفی دوست</button>
                    <button class="myBtn" onclick="document.location.href = '{{route('manageFriends')}}'" style="margin-top: 20px">مدیریت دوست</button>
                @endif
                <button class="myBtn" onclick="document.location.href = '{{route('result', ['quizId' => \App\models\Quiz::first()->id])}}'" style="margin-top: 20px">نتایج آزمون</button>
                <button class="myBtn" onclick="document.location.href = '{{route('setting')}}'" style="margin-top: 20px">تنظیمات</button>
                <button class="myBtn" onclick="document.location.href = '{{route('logout')}}'" style="margin-top: 20px">خروج</button>
            </div>
        @else
            <div class="col-xs-12">
                <button class="myBtn" onclick="document.location.href = '{{route('signIn')}}'" style="margin-top: 20px">ورود/ثبت نام</button>
            </div>
        @endif
    </div>
</div>

<script>
    $("#menuIcon").click(function () {
        if($(".mobile-nav").hasClass('hidden')) {
//            $(".mainRow").css('overflow', 'hidden');
            $(".mobile-nav").removeClass('hidden');
        }
        else {
//            $(".mainRow").css('overflow', 'auto');
            $(".mobile-nav").addClass('hidden');
        }
    });
</script>