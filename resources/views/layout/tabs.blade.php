<?php $where= Route::currentRouteName();?>{{--getting current rout for buttons--}}
<div class=" sort_part mob" >
    <div class="col-md-4 col-xs-4 each_sort" style="border-left: 2px solid #f7f7f7 ;">
        <p @if($where=="events") style="color: #fcb630;font-size: 16px; @endif">مگ</p>
        {{--<P class="number_1">۳</P>--}}
    </div>
    <div class="col-md-4 col-xs-4 each_sort" style="border-left: 2px solid #f7f7f7 ;">
        <p @if($where=="universityInfo" || $where=="profile") style="color: #fcb630;font-size: 16px; @endif">تونل</p>
        {{--<P class="number_1">۲</P>--}}
    </div>
    <div class="col-md-4 col-xs-4 each_sort">
        <p @if($where=="tips") style="color: #fcb630;font-size: 16px; @endif">فان</p>
        {{--<P class="number_2">۴</P>--}}
    </div>
</div>

<style>
    @media screen and (max-width: 700px) {
        .mob {
            margin-top: 15%;
        }

    }
</style>