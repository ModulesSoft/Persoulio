@if(Auth::check())
    <div class="mobile-nav_screen">
        <ul>
            @if(Auth::user()->level == getValueInfo('adminLevel'))
                <li><a href="{{route('manageFriendAvailability')}}">پیکربندی</a></li>
                <li><a href="{{route('manageEvents')}}">رویدادها</a></li>
                <li><a href="{{route('manageTags')}}">تگ ها</a></li>
                <li><a href="{{route('manageSurveys')}}">سوالات نظرسنجی</a></li>
                <li><a href="{{route('manageLikes')}}">مدیریت لیست علاقه مندی ها</a></li>
                <li><a href="{{route('daySentences')}}">جملات روز</a></li>
                <li><a href="{{route('certifier')}}">مسئول مدرک</a></li>
                <li><a href="{{route('advisers')}}">مشاوران</a></li>
                <li><a href="{{route('quizes')}}">آزمون ها</a></li>
                <li><a href="{{route('factors')}}">مولفه ها</a></li>
                <li><a href="{{route('createOffer')}}">ساخت تخفیف</a></li>
                <li><a href="{{route('requirement')}}">سیستم پیش نیازی</a></li>
                <li><a href="{{route('tips')}}">تیپ ها</a></li>
                <li><a href="{{route('adviserFields')}}">زمینه های کاری مشاور</a></li>
                <li><a href="{{route('adviserSpecs')}}">تخصص مشاور</a></li>
            @endif

            @if(Auth::user()->level == getValueInfo('certificateLevel') ||
                Auth::user()->level == getValueInfo('adminLevel'))
                <li><a href="{{route('workshops')}}">صدور مدرک</a></li>
            @endif
            @if(\App\models\ConfigModel::first()->friendAvailibility)
                <li><a href='{{route('inviteFriend')}}'>معرفی دوست</a></li>
                <li><a href='{{route('manageFriends')}}'>مدیریت دوست</a></li>
            @endif

            {{--@if(Auth::user()->level == getValueInfo('userLevel'))--}}
                <li><a href='{{route('likesList')}}'>ویرایش لیست علاقه مندی ها</a></li>
                <li><a href='{{route('result', ['quizId' => \App\models\Quiz::first()->id])}}'>نتایج آزمون</a></li>
            {{--@endif--}}
            <li><a href='{{route('setting')}}'>تنظیمات</a></li>
            <li><a href='{{route('logout')}}'>خروج</a></li>
                {{--<li><a href='{{route('managePlans')}}'>مدیریت برنامه ها</a></li>--}}
            <li><a href="{{route('profile')}}">پروفایل</a></li>
        </ul>
    </div>
@else
    <div class="mobile-nav_screen">
        <ul>
            <li><a href='{{route('signIn')}}'>ورود / ثبت نام</a></li>
        </ul>
    </div>
@endif