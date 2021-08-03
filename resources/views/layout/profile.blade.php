<?php


use App\models\UserPhoto;
use Illuminate\Support\Facades\URL;

$user = \Illuminate\Support\Facades\Auth::user();
$userPhoto = UserPhoto::whereUId($user->id)->first();

if ($userPhoto == null)
    $user->photo = URL::asset('images/profile.png');
else
    $user->photo = URL::asset('images/userPhotos/' . $userPhoto->photo);
?>
<div class="col-md-4 col-xs-12 right_side set_fixed">
    <div class="box little_height">
        <div class="box_top" style="background-image: url('{{\Illuminate\Support\Facades\URL::asset('images/pr_back.jpg')}}');"></div>
        <div class="box_mid" style="background-image: url({{$user->photo}});">
            {{--<p style="color: #dddddd;">تیپ شخصیتی</p>--}}
        </div>
        <h2 align="center" style="color: #32245f;font-size: 20px;margin-bottom: -60px">{{$user->firstName}} {{$user->lastName}}</h2>
        <div class="box_down hide_in_mobile">
            <div class="down_tile active" id="test">
                <p onclick="show_sub(this)">آزمون</p>
            </div>
            <div class="sub_m hiden" style="width: 100%;float: left;">
                <div class="down_tile">
                    <p onclick="document.location.href = '{{route('result', ['quizId' => \App\models\Quiz::first()->id])}}'">گزارش آزمون</p>
                </div>
                <div class="down_tile">
                    <p onclick="document.location.href = '{{route('likesList')}}'">تعیین علاقمندی‌ها</p>
                </div>
            </div>
            <div class="down_tile active">
                <p onclick="document.location.href = '{{route('setting')}}'">تنظیمات</p>
            </div>
            <div class="down_tile">
                <p onclick="document.location.href = '{{route('logout')}}'">خـــــــــروج</p>
            </div>
        </div>
    </div>
</div>